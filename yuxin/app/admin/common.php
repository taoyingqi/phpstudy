<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/2/13 0013
 * Time: 10:39
 */

function j($str)
{
    if(is_array($str))
    {
        echo "<pre>";
        print_r($str);
    }
    elseif(is_string($str) || is_numeric($str))
    {
        echo $str;
    }
    else
    {
        var_dump($str);
    }
    exit;
}

function try_update($res)
{
    if($res)
    {
        $data = [
            'status' => 1,
            'msg' => '更新成功',
        ];
    }
    else
    {
        $data = [
            'status' => 0,
            'msg' => '更新失败',
        ];
    }
    echo json_encode($data);
}

function try_add($res)
{
    if($res)
    {
        $data = [
            'status' => 1,
            'msg' => '添加成功',
        ];
    }
    else
    {
        $data = [
            'status' => 0,
            'msg' => '添加失败',
        ];
    }
    echo json_encode($data);

}

function try_del($res)
{
    if($res)
    {
        $data = [
            'status' => 1,
            'msg' => '删除成功',
        ];
    }
    else
    {
        $data = [
            'status' => 0,
            'msg' => '删除失败',
        ];
    }
    echo json_encode($data);
}

function array_val_chunk($array){
    $result = [];
    foreach ($array as $key => $value) {
        $result[$value[1].$value[2]][] = $value;
    }
    $ret = [];
    //这里把简直转成了数字的，方便同意处理
    foreach ($result as $key => $value) {
        array_push($ret, $value);
    }
    return $ret;
}

 function chbal($data)
{
    $res = round($data/10000,2);
    return $res;
}