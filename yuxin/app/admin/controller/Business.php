<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/2/10 0010
 * Time: 15:43
 */
namespace app\admin\controller;

use think\Db;
use think\Request;

class Business extends Base{

    //用户业务单列表
    public function bus_list()
    {
        //获取用户单列表
       $list = Db::view('user_business')
             ->view('admin',['name' => 'admin_name'],'admin.id = user_business.admin_id','LEFT')
             ->view('platform',['nickname' => 'plat_name'],'platform.id = user_business.plat_id','LEFT')
             ->view('plat_business','content','plat_business.id = user_business.plat_business_id','LEFT')
             ->paginate(5);

        $page = $list->render();
        $this->assign('page',$page);
        $this->assign('list',$list);

        //投资平台分类
        $plat = Db::name('platform')->field('id,nickname')->select();
        $this->assign('plat',$plat);


        return $this->fetch();
    }

    //根据平台，手机号查询业务
    public function ajax_get_list(Request $request)
    {
        $pid = $request->param('pid');
        $tel = $request->param('key');
        $data = [];
        if($pid)
        {
           $data['user_business.plat_id'] = $pid;
        }
        if($tel)
        {
            $data['user_mobile'] = $tel;
        }

      //j($data);
        $list = Db::view('user_business')
            ->view('admin',['name' => 'admin_name'],'admin.id = user_business.admin_id','LEFT')
            ->view('platform',['nickname' => 'plat_name'],'platform.id = user_business.plat_id','LEFT')
            ->view('plat_business','content','plat_business.id = user_business.plat_business_id','LEFT')
            ->where($data)
            ->select();

        $this->assign('list',$list);

        echo $this->fetch();


    }

    //审核业务单
    public function check_bus(Request $request)
    {
        $tag = $request->param('val');
        $id = $request->param('id');
        $bid = $request->param('bid');//平台业务ID
        $uid = $request->param('uid');//用户ID

        Db::startTrans();
        try{

        //查询平台业务应获得积分..更新用户余额
        $to_pay = Db::name('plat_business')->where('id',$bid)->value('pay_point');

        $balance = Db::name('user')->where('id',$uid)->value('balance');

        $newbal = intval($balance+$to_pay);

            $data = [
                'check_tag' => $tag,
                'status' => 1,
                'check_time' => time(),
                'award' => $to_pay,
                ];
             Db::name('user_business')->where('id',$id)->update($data);//更新用户业务单信息


            $change = [
                'uid' => $uid,
                'before' => $balance,
                'change' => $to_pay,
                'after' => $newbal,
                'create_time' => time(),
                'type' => 'business'
                     ];
            Db::name('money_log')->insertGetId($change);  //更新积分变动记录表

             Db::name('user')->where('id',$uid)->setField('balance',$newbal);//更新用户余额

            // 提交事务
            Db::commit();

             $data = [
                 'status' => 1,
                 'point' => $to_pay,
             ];
            echo json_encode($data);

        } catch (\Exception $e) {
            // 回滚事务
            Db::rollback();

            $data = [
                'status' => 0,
            ];

            echo json_encode($data);
        }

    }

    //审核不通过
    public function check_false(Request $request)
    {
        $id = $request->param('id');

        $res = Db::name('user_business')->where('id',$id)->setField('status',-1);

        try_update($res);
    }


}

