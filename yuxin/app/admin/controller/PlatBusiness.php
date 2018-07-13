<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/2/20 0020
 * Time: 15:21
 */
namespace app\admin\controller;

use think\Db;
use think\Request;

class PlatBusiness extends Base{


    //查看平台业务
    public function show_plat_business(Request $request)
    {
        $plat_id = $request->param('id');

        $list = Db::name('plat_business');
        if(isset($plat_id))
        {
          $list = $list->where('plat_id',$plat_id);
        }
        $list = $list->paginate(5);
        $page = $list->render();

        //列出平台列表以便搜索
        $plat = Db::name('platform')->where('status',1)->field('id,nickname')->select();

        $this->assign('plat',$plat);
        $this->assign('page',$page);
        $this->assign('list',$list);

        return $this->fetch();

    }

    //添加平台业务

    public function add_plat_business()
    {
        $plat = Db::name('platform')->field('id,nickname')->where('status',1)->select();
        $this->assign('plat',$plat);
        return $this->fetch();
    }

    //添加平台业务操作

    public function do_add_business()
    {
      //  j($_POST);
        $data = [
//            'id' => $_POST['id'],
            'content' => $_POST['note'],
            'pay_rebate' => $_POST['rebate'],
            'plat_income' => $_POST['plat_income'],
            'total_income' => $_POST['total_income'],
            'tips' => $_POST['tips'],
            'investment_amount' => $_POST['investment_amount'],
            'investment_horizon' => $_POST['investment_horizon'],
            'create_time' => time(),
//            'pay_point' => $_POST['pay_point'],
            'sort' => $_POST['sort'],
              ];

        if(isset($_POST['status']))
        {
            $data['status'] = 1;
        }

        $plat = explode('|',$_POST['plat']);

        $data['plat_id'] = intval($plat[0]);
        $data['plat_nickname'] = $plat[1];

        $res = Db::name('plat_business')->insertGetId($data);

        try_add($res);

    }

    //修改平台
    public function edit_business(Request $request)
    {

        $id = $request->param('id');
        $list = Db::name('plat_business')->where('id',$id)->find();

        $this->assign('list',$list);

        return $this->fetch();
    }

    //修改平台操作
    public function do_edit_business()
    {
        $data = [
            'id' => $_POST['id'],
            'content' => $_POST['note'],
            'pay_rebate' => $_POST['rebate'],
            'plat_income' => $_POST['plat_income'],
            'total_income' => $_POST['total_income'],
            'tips' => $_POST['tips'],
            'investment_amount' => $_POST['investment_amount'],
            'investment_horizon' => $_POST['investment_horizon'],
            'create_time' => time(),
            'pay_point' => $_POST['pay_point'],
            'sort' => $_POST['sort'],
        ];

        if(isset($_POST['status']))
        {
            $data['status'] = 1;
        }

        $plat = explode('|',$_POST['plat']);

        $data['plat_id'] = intval($plat[0]);
        $data['plat_nickname'] = $plat[1];

        $res = Db::name('plat_business')->update($data);

        try_update($res);

    }

    //删除平台业务
    public function del_business(Request $request)
    {
        $id = $request->param('id');

        $res = Db::name('plat_business')->where('id',$id)->delete();

        try_del($res);
    }

    //ajax根据平台搜索平台业务
    public function search_by_plat(Request $request)
    {
        if(isset($_GET['data']))
        {
            $data = json_decode($_GET['data'],true);
        }
        else
        {
            $plat_id = $request->param('plat_id');
            $data =  ['plat_id'=>$plat_id];
        }

        $list = Db::name('plat_business');
        if($data)
        {
            $list = $list->where($data);
            $query = ['query' => ['data' => json_encode($data)] ];
        }
        else
        {
            $query = ['query' => ['data' => []]];
        }
        $list = $list->paginate(2,false,$query);

        $page = $list->render();

       // j($list->all());
        $this->assign('list',$list);
        $this->assign('page',$page);
        echo $this->fetch();

    }






}