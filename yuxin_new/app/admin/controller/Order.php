<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/2/22 0022
 * Time: 10:35
 */
namespace app\admin\controller;

use think\Db;
use think\Request;

class Order extends Base{

    //订单列表
    public function show_order()
    {
        $list = Db::name('order')
              ->field('id,order_num,jfd_point,money,user_tel,create_time,ischeck,status')
              ->paginate(5);

        $page = $list->render();

        $this->assign('page',$page);
        $this->assign('list',$list);
        return $this->fetch();
    }

    //审核订单
    public function check_order(Request $request)
    {
        $id = $request->param('id');
        $ch = $request->param('check');
        $check_id = $_SESSION['admin']['id'];
        $data = ['admin_check_id' => $check_id ];
        if($ch == 'yes')
        {
            $data['ischeck'] = 1;
        }
        else
        {
            $data['ischeck'] = -1;
        }

        $res = Db::name('order')->where('id',$id)->update($data);

         try_update($res);

    }

    //显示付款页面

    public function pay_money(Request $request)
    {
        $id = $request->param('id');
        $admin_name = $_SESSION['admin']['name'];

        $this->assign('admin',$admin_name);

        //获取订单信息
        $list = Db::view('order')
              ->view('admin','name','admin.id = order.admin_check_id')
              ->where('order.id',$id)
              ->find();
         $this->assign('list',$list);

        return $this->fetch();

    }

    //付款操作
    public function do_pay_money()
    {
          $id = $_POST['id'];
          $channel = $_POST['channel'];
          $pay_tag = $_POST['pay_tag'];
          $pay_id = $_SESSION['admin']['id'];

        $data = [
            'id' => $id,
            'pay_channel' => $channel,
            'pay_tag' => $pay_tag,
            'status' => 1,
            'pay_time' => time(),
            'admin_pay_id' => $pay_id,
        ];

        $res = Db::name('order')->update($data);

        if($res)
        {
            $data = [
                'status' => 1,
                'msg' => '操作成功！',
                'type' => 'pay',
            ];
        }else
        {
            $data = [
                'status' => 0,
                'msg' => '操作失败！',
                'type' => 'pay'
            ];
        }

        echo json_encode($data);

    }

    //查看订单
    public function see_order()
    {
        $id =$_GET['id'];
        $list = Db::view('order')
              ->view('user',['nickname' => 'user_name'],'user.id = order.uid','LEFT')
              ->view('admin',['name' => 'check_name'],'admin.id = order.admin_check_id','LEFT')
              ->view(['jfd_admin' => 'admin1'],['name' => 'pay_name'],'admin.id = order.admin_pay_id','LEFT')
              ->where('order.id',$id)
              ->find();

        $this -> assign('list',$list);

        return $this->fetch();

    }






























}