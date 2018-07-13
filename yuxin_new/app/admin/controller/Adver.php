<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/2/10 0010
 * Time: 15:52
 */
namespace app\admin\controller;

use think\Db;
use think\Controller;

class Adver extends Controller{

    public function show_ad()
    {
        return $this->fetch();
    }

}