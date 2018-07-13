<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/2/24 0024
 * Time: 10:38
 */
namespace app\admin\controller;

use think\Controller;
use think\Db;
use think\Request;
use app\admin\model\Common as COM;

class Login extends Controller{

    public function login()
    {
        session_unset();
        session_destroy();
        return $this->fetch();
    }

    public function get_verifi()
    {
        $com = new COM();

        $com ->get_verifi();
    }

    public function do_login(Request $request)
    {
        $name = $request->param('name');
        $password = $request->param('password');

        $verifi = $request->param('code');

        $verifi = strtoupper($verifi);

        if($verifi != $_SESSION['code'])
        {
            $data = [
                'status' => 2,
                'msg' => '验证码错误！请重新登陆',
                'type' => 'login',
            ];

            echo json_encode($data);return;
        }

        $data = [
            'name' => $name,
            'password' => $password,
        ];

        $res = Db::name('admin')->where($data)->find();

        if($res)
        {
            $time = time();
            Db::name('admin')->where('id',$res['id'])->setField('login_time',$time);
            unset($res['password']);
            $_SESSION['admin'] = $res;
            $_SESSION['time'] = $time;

            //获取是否唯一登陆标识
//            $only_load = Db::name('config')->where('key','only_onload')->value('value');
//
//            if($only_load == 1)
//            {
//                j(session_id()) ;
//            }


            //写权限
            $perm_ids = Db::name('perm_group')->where('id',$res['group_id'])->value('perm_ids');
            $_SESSION['perm_ids'] = $perm_ids;

            $data = [
                'status' => 1,
                'msg' => '登陆成功！',
                'type' => 'login',
            ];
        }
        else
        {
            $data = [
                'status' => 0,
                'msg' => '账号或密码错误，请重新登陆！',
                'type' => 'login',
            ];
        }

        echo json_encode($data);

    }

}