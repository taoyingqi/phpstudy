<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/2/10 0010
 * Time: 11:56
 */
namespace app\admin\controller;

use think\Db;
use think\Controller;
use think\Request;

class Index extends Base
{

    public function index()
    {
       $user = $_SESSION['admin']['name'];//给予admin用户超级权限

        if($user == 'admin')
        {
            $perm = Db::name('permission')->select();
        }
        else
        {
            $p = $_SESSION['perm_ids'];
            $perm_ids = explode(',',$p);
            $perm = Db::name('permission')->where('id','in',$perm_ids)->select();
        }

        foreach($perm as $key=>$value)
        {
            if($value['pid'] == 0 )
            {
                $one[$value['sort']] = $value;
                unset($perm[$key]);
            }
        }
        if(isset($one))
        {
            foreach($one as $k => $v)
            {
                $two = [];
                foreach($perm as $k1 => $v1)
                {
                    if($v['id'] == $v1['pid'] && $v1['display'] == 'Y')
                    {
                        $two[$v1['sort']] = $v1;
                    }
                }
                if(empty($two))
                {
                    unset($one[$k]);
                }
                else
                {
                    ksort($two);
                    $one[$k]['child'] = $two;
                }

            }
        }
//        echo '<pre>';
//        print_r($one);exit;

        $admin = $_SESSION['admin'];
        $this->assign('admin',$admin);
        $this->assign('perm',$one);
        return $this->fetch();

    }

    public function show()
    {
        echo "<h3><span style='color:#00b6ff'>欢迎来到逸信国际期货中心！</span></h3>";
    }

    public function info()
    {
        //获取平台总数 业务总数
        $p_count = Db::name('platform')->count();
        $p_b_count = Db::name('plat_business')->count();
        //获取上月总台数和业务数
        $p_last_m = Db::name('platform')->whereTime('add_time','last month')->count();
        $p_b_last_m = Db::name('plat_business')->whereTime('create_time','last month')->count();
        //获取本月总台数和业务数
        $p_m = Db::name('platform')->whereTime('add_time','month')->count();
        $p_b_m = Db::name('plat_business')->whereTime('create_time','month')->count();

        $data[0] = [$p_m,$p_last_m,$p_count];
        $data[1] = [$p_b_m,$p_b_last_m,$p_b_count];

      $this->assign('data',json_encode($data));

        //获取用户总数 上月 本月
        $u_count = Db::name('user')->count();
        $u_list_m = Db::name('user')->whereTime('reg_time','last month')->count();
        $u_m = Db::name('user')->whereTime('reg_time','month')->count();
        //获取用户总积分 上月 本月
        $u_bal = Db::name('user')->where('status',1)->sum('balance');
        $u_bal_last_m = Db::name('user')->where('status',1)->whereTime('reg_time','last month')->sum('balance');
        $u_bal_m = Db::name('user')->where('status',1)->whereTime('reg_time','month')->sum('balance');
        //获取用户已获得奖金 上月 本月
        $u_money = Db::name('order')->where('status',1)->sum('money');
        $u_money_last_m = Db::name('order')->where('status',1)->whereTime('pay_time','last month')->sum('money');
        $u_money_m = Db::name('order')->where('status',1)->whereTime('pay_time','month')->sum('money');

        //转花积分
        $u_bal = chbal($u_bal);
        $u_bal_last_m = chbal($u_bal_last_m);
        $u_bal_m = chbal($u_bal_m);

        $user[0] = [$u_m,$u_list_m,$u_count];
        $user[1] = [$u_bal_m,$u_bal_last_m,$u_bal];
        $user[2] = [$u_money_m,$u_money_last_m,$u_money];

        $this->assign('user',$user);

        //获取文章，标题的总数量，上月数量，本月数量
        $ar_link = Db::name('news_article')->count();
        $ar_link_last_m = Db::name('news_article')->whereTime('add_time','last month')->count();
        $ar_link_m = Db::name('news_article')->whereTime('add_time','month')->count();

        //标题链接
        $t_link = Db::name('news_link')->count();
        $t_link_last_m = Db::name('news_link')->whereTime('add_time','last month')->count();
        $t_link_m = Db::name('news_link')->whereTime('add_time','month')->count();

        $new[0] = [$ar_link_m,$ar_link_last_m,$ar_link];
        $new[1] = [$t_link_m,$t_link_last_m,$t_link];

        $this->assign('news',$new);

        //用户业务状态
        $sql = " select count(*) as num from jfd_user_business group by status";
        $check = Db::query($sql);
        $this->assign('check',$check); //j($check);
        return $this->fetch();
    }

    public function show_phpinfo()
    {
        j(phpinfo());
    }


    //配置项目
    public function config()
    {
        $config = Db::name('config')->where('status',1)->select();//j($config);
        $group = Db::name('config')->where('status',1)->group('cate')->column('cate');

      foreach ($group as $key => $value)
      {
          foreach($config as $k => $v)
          {
              if($value == $v['cate'])
              {
                   $res[$key][] = $v;
              }
          }
      }

        $this->assign('group',$group);
        if(isset($res))
        {
         $this->assign('list',$res);
        }

        return $this->fetch();
    }

    //AJAX设置配置值
    public function ajax_set_val(Request $request)
    {
          $val = $request->param('val');
          $id = $request->param('id');

         $data = [
             'id' => $id,
             'value' => $val,
         ];
         $res = Db::name('config')->update($data);

         try_update($res);

    }






}