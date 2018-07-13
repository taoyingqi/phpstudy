<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/2/17 0017
 * Time: 15:03
 */

namespace app\admin\controller;

use think\Db;
use think\Request;

class Admin extends Base
{
    //管理员列表
      public function show_admin()
      {
          $admin = Db::view('admin')
                ->view('perm_group','group_name','admin.group_id = perm_group.id','LEFT')
                ->select();
          $this->assign('admin',$admin);

          //列出权限组
          $group = Db::name('perm_group')->field('id,group_name')->select();
          $this->assign('group',$group);
          return $this->fetch();
      }

    //增加管理员
    public function add_admin(Request $request)
    {
          $req = $request->param();

          $data = [
              'name' => $req['name'],
              'password' => $req['password'],
              'group_id' => $req['gid'],
              'add_time' => time(),
              'img' => $req['admin_img'],
              'add_admin_id' => $_SESSION['admin']['id'],
          ];

        $res = Db::name('admin')->insertGetId($data);

        try_add($res);

    }

    //修改管理员
    public function edit_admin(Request $request)
    {
        $id = $request->param('id');

        $res = Db::name('admin')->where('id',$id)->find();

        //列出权限组
        $group = Db::name('perm_group')->field('id,group_name')->select();
        $this->assign('group',$group);

        $this->assign('list',$res);

        return $this->fetch();
    }

    //操作修改管理员
    public function do_edit_admin()
    {
         $up_admin_id = $_SESSION['admin']['id'];
        $data = [
            'id' => $_POST['id'],
            'name' => $_POST['name'],
            'img' => $_POST['admin_img'],
            'password' => $_POST['password'],
            'group_id' => $_POST['gid'],
            'up_admin_id' => $up_admin_id,
        ];

        $res = Db::name('admin')->update($data);

        try_update($res);

    }

    //删除管理员
    public function del_admin(Request $request)
    {
        $id = $request->param('id');
        $res = Db::name('admin')->where('id',$id)->delete();
        try_del($res);
    }

    //修改密码
    public function edit_password()
    {
         $this->assign('name',$_SESSION['admin']['name']);
        return $this->fetch();
    }

    public function do_edit_pass()
    {
        $id = $_SESSION['admin']['id'];
        $pass = $_POST['mpass'];
        $newpass = $_POST['newpass'];

        $p = Db::name('admin')->where('id',$id)->value('password');

        if($p == $pass)
        {
            $res = Db::name('admin')->where('id',$id)->setField('password',$newpass);
            $data = [
                'status' => 1,
                'msg' => '修改密码成功！',
            ];
        }
        else
        {
            $data = [
                'status' => 0,
                'msg' => '修改密码失败！',
            ];
        }

        echo json_encode($data);

    }


    //显示权限组
    public function group_list()
    {
        $list = Db::name('perm_group')->paginate(10);

        $page = $list->render();

        $this->assign('page',$page);

        $this->assign('list',$list);

        return $this->fetch();

    }

    //编辑权限
    public function edit_prem()
    {
       $prem = Db::name('permission')->select();

        foreach($prem as $key => $value )
        {
           if($value['pid'] == 0)
           {
               $one[$value['sort']] = $value; //第一组权限
               unset($prem[$key]);
           }
        }

        if(isset($one))
        {
            foreach($one as $k => $v)
            {
                $two = [];
                foreach($prem as $k1 => $v1)
                {

                    if($v['id'] == $v1['pid'] )
                    {
                         $two[] = $v1;
                    }

                }

                if(empty($two)){
                    unset($one[$k]);
                }else{
                      $two_3 = array_chunk($two,3);

                    $one[$k]['child'] = $two_3;
                }

            }

//            echo "<pre>";
//            print_r($one);exit;
        }
       $this->assign('prem',$one);

        //查找用户的权限
        $gid = $_GET['gid'];
        $perm_ids = Db::name('perm_group')->where('id',$gid)->value('perm_ids');
        $perm_ids = explode(',',$perm_ids);

        $this->assign('perm_ids',$perm_ids);

        return $this->fetch();
    }

    //编辑权限操作
    public function do_edit_perm(Request $request)
    {
        $gid = $request->param('gid');
        $gname = $request->param('gname');
        $perm_arr = $request->param('perm_ids/a');
        asort($perm_arr);
        $perm_ids = implode(',',$perm_arr);

        $data = [
            'id' => $gid,
            'group_name' => $gname,
            'perm_ids' => $perm_ids,
            'update_time' => time(),
        ];

        $res = Db::name('perm_group')->update($data);

        try_update($res);
    }

    //显示添加权限
    public function add_perm()
    {
        $prem = Db::name('permission')->select();

        foreach($prem as $key => $value )
        {
            if($value['pid'] == 0)
            {
                $one[$value['sort']] = $value; //第一组权限
                unset($prem[$key]);
            }
        }

        if(isset($one))
        {
            foreach($one as $k => $v)
            {
                $two = [];
                foreach($prem as $k1 => $v1)
                {

                    if($v['id'] == $v1['pid'] )
                    {
                        $two[] = $v1;
                    }

                }

                if(empty($two)){
                    unset($one[$k]);
                }else{
                    $two_3 = array_chunk($two,3);

                    $one[$k]['child'] = $two_3;
                }

            }

        }
        $this->assign('prem',$one);

         return $this->fetch();
    }

    //添加权限操作
    public function do_add_perm(Request $request)
    {
        $gname = $request->param('gname');
        $perm_arr = $request->param('perm_ids/a');
        asort($perm_arr);
        $perm_ids = implode(',',$perm_arr);

        $data = [
            'group_name' => $gname,
            'perm_ids' => $perm_ids,
            'add_time' => time(),
        ];

        $res = Db::name('perm_group')->insertGetId($data);

        try_add($res);
    }

    //批量删除管理员操作
    public function del_perm(Request $request)
    {
         $gids = $request->param('gids');
         $gid_arr = explode(',',$gids);
        $res = Db::name('perm_group')->where('id','in',$gid_arr)->delete();

        try_del($res);
    }


}