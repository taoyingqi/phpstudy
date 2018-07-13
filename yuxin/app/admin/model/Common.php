<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/2/16 0016
 * Time: 11:42
 */
namespace app\admin\model;
use think\Db;
use think\Request;

class Common {

    //处理上传图片
    public function get_img()
    {
        //  var_dump($_FILES);
        $name = $_FILES['imgfile']['name'];
        $type = $_FILES['imgfile']['type'];
        $tmp = $_FILES['imgfile']['tmp_name'];
        $size = $_FILES['imgfile']['size'];

        if($size > 1024*1024*8)
        {
            echo "<script>alert('上传文件大小超过限制。');</script>";die;
        }

        $arr = explode('.',$name);
        $ext = array_pop($arr);
        $ext = trim($ext);
        $ext = strtolower($ext);
        $allow_arr = ['jpg','png','jpeg','gif'];
        if(in_array($ext,$allow_arr) == false)
        {
            echo "<script>alert('上传文件扩展名是不允许的扩展名。');</script>";die;
        }

        $filepath = time().".".$ext;

        $dirpath = $_SERVER['DOCUMENT_ROOT']."/upload/admin/plat_img/";

        if(!file_exists($dirpath))
        {
            mkdir($dirpath,0777,true);
        }
        move_uploaded_file($tmp,$dirpath.$filepath);

        $path = "/upload/admin/plat_img/".$filepath;

        echo $path;

    }

    //生成验证码
    public function get_verifi()
    {
         $img = imagecreatetruecolor(100,43);

        $color = imagecolorallocate($img,245,245,245);

        imagefill($img,0,0,$color);

         $code = '';
        for($i=0;$i<4;$i++)
        {
            $fontsize = 14;
            $fontcolor = imagecolorallocate($img,mt_rand(0,120),mt_rand(0,120),mt_rand(0,120));

            $data = "ABCDEFGHIJKLMNPQRSTUVWSYZ123456789";
            $max = intval(strlen($data))-1;
            $fontcontent = substr($data,mt_rand(0,$max),1);

             $code .= $fontcontent;

            $x = ($i*100/4) + mt_rand(5,10);
            $y = mt_rand(5,25);

            imagestring($img,$fontsize,$x,$y,$fontcontent,$fontcolor);
        }

        $_SESSION['code'] = $code;

        header('content-type:image/png');

        imagepng($img);
        imagedestroy($img);

    }
















}