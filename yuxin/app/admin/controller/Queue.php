<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/2/10 0010
 * Time: 15:10
 */
namespace app\admin\controller;

use think\Db;
use think\Request;
use app\admin\model\Common as com_m;

class Queue extends Base{

    protected $request;

//    function __construct()
//    {
//        parent::__construct();
//       $this->request = Request::instance();
//    }

    //显示平台
    public function show_queue(Request $request)
    {
        if(isset($_GET['data']))
        {
            $data = json_decode($_GET['data'],true);
            //  j($data);
        }
        else
        {
            $lid = $request->param('cid');
            $key = $request->param('key');  //手机号

            if($key)
            {
                $user = Db::name('user')->where('mobile',$key)->find();
                if(empty($user['id']))
                {
                    echo json_encode(['code' => 0,'msg'=>'没有找到该手机号的用户！']);die;
                }else{
                    $data['queue.uid'] = $user['id'];
                }
            }

            if($lid){ $data['queue.lid'] = $lid; }

        }

        //平台列表
        $platinfo = Db::view('queue')
                  ->view('user','username,mobile','queue.uid = user.id')
                  ->view('level','lname','level.id = queue.lid');
                 // ->select();

        if(isset($data))
        {
            $platinfo = $platinfo->where($data);
            $query = ['query' => [ 'data' => json_encode($data)]];
            // j($query);
        }
        else
        {
            $query = ['query' => ['data' => []] ];
        }

        $platinfo = $platinfo->paginate(10,false,$query);
        //j($platinfo);
        //平台分类
        $pcate = Db::name('level')->select();

        $this->assign('pcate',$pcate);

        $page = $platinfo->render();
        $this->assign('page',$page);
         $this->assign('platinfo',$platinfo);

        return $this->fetch();
    }

    //显示平台
    public function show_has_tc(Request $request)
    {
        if(isset($_GET['data']))
        {
            $data = json_decode($_GET['data'],true);
            //  j($data);
        }
        else
        {
            $lid = $request->param('cid');
            $key = $request->param('key');  //手机号

            if($key)
            {
                $user = Db::name('user')->where('mobile',$key)->find();
                if(empty($user['id']))
                {
                    echo json_encode(['code' => 0,'msg'=>'没有找到该手机号的用户！']);die;
                }else{
                    $data['queue.uid'] = $user['id'];
                }
            }

            if($lid){ $data['queue.lid'] = $lid; }

        }

        //平台列表
        $platinfo = Db::view('queue')
            ->view('user','username,mobile','queue.uid = user.id')
            ->view('level','lname','level.id = queue.lid');
        // ->select();

        if(isset($data))
        {
            $platinfo = $platinfo->where($data);
            $query = ['query' => [ 'data' => json_encode($data)]];
            // j($query);
        }
        else
        {
            $query = ['query' => ['data' => []] ];
        }

        $platinfo = $platinfo->where(array('queue.is_tc'=>1))->paginate(10,false,$query);
        //j($platinfo);
        //平台分类
        $pcate = Db::name('level')->select();

        $this->assign('pcate',$pcate);

        $page = $platinfo->render();
        $this->assign('page',$page);
        $this->assign('platinfo',$platinfo);

        return $this->fetch();
    }

    //显示平台
    public function show_no_tc(Request $request)
    {
        if(isset($_GET['data']))
        {
            $data = json_decode($_GET['data'],true);
            //  j($data);
        }
        else
        {
            $lid = $request->param('cid');
            $key = $request->param('key');  //手机号

            if($key)
            {
                $user = Db::name('user')->where('mobile',$key)->find();
                if(empty($user['id']))
                {
                    echo json_encode(['code' => 0,'msg'=>'没有找到该手机号的用户！']);die;
                }else{
                    $data['queue.uid'] = $user['id'];
                }
            }

            if($lid){ $data['queue.lid'] = $lid; }

        }

        //平台列表
        $platinfo = Db::view('queue')
            ->view('user','username,mobile','queue.uid = user.id')
            ->view('level','lname','level.id = queue.lid');
        // ->select();

        if(isset($data))
        {
            $platinfo = $platinfo->where($data);
            $query = ['query' => [ 'data' => json_encode($data)]];
            // j($query);
        }
        else
        {
            $query = ['query' => ['data' => []] ];
        }

        $platinfo = $platinfo->where(array('queue.is_tc'=>0))->paginate(10,false,$query);
        //j($platinfo);
        //平台分类
        $pcate = Db::name('level')->select();

        $this->assign('pcate',$pcate);

        $page = $platinfo->render();
        $this->assign('page',$page);
        $this->assign('platinfo',$platinfo);

        return $this->fetch();
    }

    // 平台 ajax搜索
    public function search_queue(Request $request)
    {
        if(isset($_GET['data']))
        {
            $data = json_decode($_GET['data'],true);
           //  j($data);
        }
        else
        {

            $lid = $request->param('cid');
            $key = $request->param('key');  //手机号

            if($key)
            {
                $user = Db::name('user')->where('mobile',$key)->find();
                if(empty($user['id']))
                {
                    echo json_encode(['code' => 0,'msg'=>'没有找到该手机号的用户！']);die;
                }else{
                    $data['queue.uid'] = $user['id'];
                }
            }

            if($lid){ $data['queue.lid'] = $lid; }

        }

       // print_r($data);die;
        $platinfo = Db::view('queue')
                   ->view('user','username,mobile','queue.uid = user.id')
                   ->view('level','lname','level.id = queue.lid');

        if(isset($data))
        {
            $platinfo = $platinfo->where($data);
            $query = ['query' => [ 'data' => json_encode($data)] ,'path' => url('admin/queue/show_queue')];
           // j($query);
        }
        else
        {
            $query = ['query' => ['data' => []] ,'path' => url('admin/queue/show_queue')];
        }


         $platinfo = $platinfo->paginate(20,false,$query);

       // j($platinfo);
        if(empty($platinfo))
        {
            echo json_encode(['code' => 0,'msg'=>'搜索失败']);die;
        }

        $page = $platinfo->render();
     //   j($page);
        $this->assign('page',$page);
        $this->assign('platinfo',$platinfo);

        $html = $this->fetch();

       echo json_encode(['code' => 1,'msg'=>'成功！','data'=>$html]);die;

    }

    //添加平台
    public function add_queue()
    {
        //查询一级城区
       //  $select1 = Db::name('district')->where('level',1)->select();

     //   $this->assign('select1',$select1);

        //查询平台分类
        $cate = Db::name('level')->select();
        $this->assign('cate',$cate);


        return $this->fetch();

    }

    public function get_img()
    {
        $m = new com_m();
         $m -> get_img();

    }

    //添加平台操作
    public function do_add_queue(Request $request)
    {
         $post = $request->param();

         $lid = $post['lid'];
         $uid = $post['uid'];
         $mobile = $post['mobile'];

         $user = Db::name('user')->where('id',$uid)->find();
         if(empty($user))
         {
             echo json_encode(array('status' => 0,'msg' => '用户不存在'));die;
         }

        if($user['mobile'] != trim($mobile))
        {
            echo json_encode(array('status' => 0,'msg' => '用户ID和手机号不对应'));die;
        }

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
                 echo json_encode(array('status' => 1,'msg' => '加入队列成功,已有人提车'));die;
             }

            echo json_encode(array('status' => 1,'msg' => '加入队列成功'));die;
        }else{
            echo json_encode(array('status' => 0,'msg' => '加入队列失败'));die;
        }
    }

    //增加平台标签
    public function add_tag()
    {
        return $this->fetch();
    }

    public function do_add_tag(Request $request)
    {
       $tag = $request->param('tag');

        if(empty($tag))
        {
            echo "请添加标签"; return;
        }

        $data = [
             'name' => $tag,
              'add_time' => time(),
        ];

        $res = Db::name('tag')->insertGetId($data);

        try_add($res);

    }

    //标签列表
    public function tag_list()
    {
        $res = Db::name('tag')->paginate(5);
        $page = $res->render();
         $this->assign('page',$page);
         $this->assign('list',$res);
         return $this->fetch();
    }

    public function delete_tag(Request $request)
    {
        $id = $request->param('id');

        $res = Db::name('tag')->where('id',$id)->delete();

        echo $res;

    }

     //选择删除标签(批量删除)
    public function select_del(Request $request)
    {
       $ids = $request->param('ids');

        $ids = explode(',',$ids);

        $res = Db::name('tag')->delete($ids);

        echo $res;

    }

    //ajax获取城市区域
    public function  ajax_get_city(Request $request)
    {
        $data = $request->param('data');
         $data = explode('|',$data);

        $select2 = Db::name('district')->where('pid',$data[0])->select();

        if($select2)
        {
            $this->assign('select2',$select2);

            $this->assign('level',$data[1]);

             $list = $this->fetch();

            $res=['status'=>1,'html'=>$list,'level'=>$data[1]];

            echo json_encode($res);
        }
        else
        {
            $res=['status'=>0,'message'=>'没有数据了'];

            echo json_encode($res);
        }

    }

    //修改平台
    public function edit_queue(Request $request)
    {
        $id = $request->param('id');
        //查询队列
        $queue = Db::view('queue')
               ->view('user','username','user.id=queue.uid')
               ->where('queue.id',$id)
               ->find();
        $this->assign('queue',$queue);

        $cate = Db::name('level')->select();
        $this->assign('cate',$cate);

         return $this->fetch();
    }

    //修改平台操作
    public function do_edit_queue(Request $request)
    {
        $post = $request->param();
         $qid = $post['id'];
        $username = $post['username'];
        $queue = Db::name('queue')->where('id',$qid)->find();
        $res = Db::name('user')->where('id',$queue['uid'])->update(array('username'=>$username));

//        $data = [
//            'lid' => $post['lid'],
//            'num' => $post['num'],
//            'is_tc' => $post['is_tc'],
//        ];

       //  $res = Db::name('queue')->where('id',$post['id'])->update($data);
        try_update($res);
    }

    //删除平台
    public function del_queue(Request $request)
    {
          $id = $request->param('id');
          $queue = Db::name('queue')->where('id',$id)->find();
           $res = Db::name('queue')->where('id',$id)->delete();
           $res1 = Db::name('user')->where('id',$queue['uid'])->delete();
             if($res && $res1)
             {
                 $data=[
                     'status'=> 1,
                     'msg' => '删除成功',
                 ];
             }
            else
            {
                $data=[
                    'status'=> 0,
                    'msg' => '删除失败,请联系管理员！',
                ];
            }

        echo json_encode($data);
    }

    //平台分类
    public function queue_cate()
    {
       $pcate = Db::name('level')->select();

       $this->assign('pcate',$pcate);

       return $this->fetch();

    }

    //添加分类
    public function add_cate()
    {
        $data = [
            'cate_name' => $_POST['cate_name'],
            'cate_img' => $_POST['cate_img'],
            'sort' => $_POST['sort'],
            'info' => $_POST['cate_desc'],
            'is_index' => intval($_POST['isindex']),
            'status' => $_POST['status'],
            'add_time' => time(),
        ];

        $res = Db::name('plat_cate')->insertGetId($data);

        try_add($res);

    }

    //显示修改分类
    public function edit_cate(Request $request)
    {
        $id = $request->param('id');

        $list = Db::name('level')->where('id',$id)->find();

        $this->assign('list',$list);

        return $this->fetch();

    }

    //修改分类操作
    public function do_edit_cate(Request $request)
    {
        $post = $request->param();
        $data = [
            'id' => $post['id'],
            'money' => $post['money'],
            'lname' => $post['lname'],
        ];

        $res = Db::name('queue')->update($data);
        try_update($res);

    }

    //删除分类操作
    public function del_cate(Request $request)
    {
       $id = $request->param('id');

        $has_plat = Db::name('queue')->where('lid',$id)->count();

        if($has_plat)
        {
            $data = [
                 'status' => -1,
                 'message' => '该档位里面还有用户，不能删除！',
            ];
        }
        else
        {
            $res = Db::name('level')->where('id',$id)->delete();
            if($res)
            {
                $data = [
                     'status' => 1,
                     'message' => '删除成功',
                ];
            }
            else
            {
                $data = [
                    'status' => 0,
                    'message' => '删除失败，请联系管理员',
                ];
            }
        }

        echo json_encode($data);
    }



























}