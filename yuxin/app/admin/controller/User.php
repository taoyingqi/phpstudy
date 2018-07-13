<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/2/16 0016
 * Time: 16:26
 */
namespace app\admin\controller;

use think\Db;
use think\Request;

class User extends Base{


    function show_user_list()
    {
       // $list = Db::name('user')->paginate(20);
        $list = Db::name('user')->paginate(10);
        $page = $list->render();

        $this->assign('list',$list);
        $this->assign('page',$page);


        return $this->fetch();
    }

    function add_user()
    {
        //查询平台分类
        $cate = Db::name('level')->select();
        $this->assign('cate',$cate);

        return $this->fetch();
    }

    function see_user(Request $request)
    {
       $id = $request->param('id');

       $user = Db::name('user')->where('id',$id)->find();
        $this->assign('user',$user);
        return $this->fetch();
    }

    function del_user(Request $request)
    {
        $id = $request->param('id');
        $rs = Db::name('user')->where('id',$id)->delete();

        if($rs)
        {
            echo json_encode(array('status'=>1,'msg'=>'删除成功'));die;
        }else{
            echo json_encode(array('status'=>0,'msg'=>'删除失败'));die;
        }

    }


    function do_add_user(Request $request)
    {
        $name = $request->param('username');
        $truename = $request->param('truename');
        $mobile = $request->param('mobile');
        $pass = $request->param('pass');
        $lid = $request->param('lid');

        $res = Db::name('user')->where('username',$name)->whereOr('mobile',$mobile)->count();
        if($res > 0)
        {
            echo json_encode(array('status' => 0,'msg' => '用户名或手机号已存在'));die;
        }

        $arr = array(
            'username' => $name,
            'truename' => $truename,
            'mobile' => $mobile,
            'password' => $pass,
            'adtime' => date('Y-m-d H:i:s'),
            'uptime' => date('Y-m-d H:i:s'),
        );
        $uid = Db::name('user')->insertGetId($arr);

        if($uid)
        {
            $lcount = Db::name('queue')->where('lid',$lid)->count();
            $lcount++;
            $data = array(
                'lid' => $lid,
                'uid' => $uid,
                'num' => $lcount,
                'is_tc' => 0
            );
            $res = Db::name('queue')->insertGetId($data);
            if($res)
            {
                if($lcount%5 == 1 && $lcount != 1)
                {
                    $wz = floor($lcount/5);
                    $r = Db::name('queue')->where(array('lid'=> $lid,'num'=>intval($wz)))->update(array('is_tc'=>1));
                    echo json_encode(array('status' => 1,'msg' => '用户加入队列成功,已有人提车'));die;
                }

                echo json_encode(array('status' => 1,'msg' => '用户加入队列成功'));die;
            }else{
                echo json_encode(array('status' => 0,'msg' => '用户加入队列失败'));die;
            }

        }else{
            echo json_encode(array('status' => 0,'msg' => '添加用户失败'));die;

        }


    }


    //禁用用户
    function ch_user_status(Request $request)
    {
        $id = $request->param('id');

        $type = $request->param('type');

        if($type)
        {
            $res = Db::name('user')->where('id',$id)->setField('status',1);
        }
         else
         {
            $res = Db::name('user')->where('id',$id)->setField('status',0);
         }


        echo $res;

    }




}