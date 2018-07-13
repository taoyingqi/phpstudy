<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/2/16 0016
 * Time: 11:33
 */
namespace app\admin\controller;
use think\Db;
use think\Request;
use think\Controller;

class Base extends Controller{

       function __construct(Request $request)
       {
           parent::__construct();

          if(!isset($_SESSION['perm_ids']))
          {
              header("refresh:0;url='/admin/login/login.html'");
              exit;
          }

           $module = $request->module();
           $control = strtolower($request->controller());
           $action = $request->action();

           $current_url = '/'.$module.'/'.$control.'/'.$action;

           $cur_perm_id = Db::name('permission')->where('url',$current_url)->value('id');

          // j($cur_perm_id);

           $perm_arr = explode(',',$_SESSION['perm_ids']);

           if(!in_array($cur_perm_id,$perm_arr) && $cur_perm_id != null)
           {
               echo '您无权访问！';
               header("refresh:1;url='/admin/login/login.html'");
               exit;
           }


       }





}