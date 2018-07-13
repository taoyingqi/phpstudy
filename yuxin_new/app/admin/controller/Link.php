<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/3 0003
 * Time: 14:56
 */
namespace app\admin\controller;

use think\Db;
use think\Request;

class Link extends Base{

      //显示链接分类
        public function show_link_cate()
        {
            $list = Db::name('news_cate')
                  ->where('display_mode','link')
                  ->field('id,cate_name,sort,display_position')
                  ->select();

            $this->assign('list',$list);

            $this->assign('link','link');
            return $this-> fetch('show_news_cate');

        }

    //显示文章分类
    public function show_news_cate()
    {
        $list = Db::name('news_cate')
            ->where('display_mode','article')
            ->field('id,cate_name,sort,display_position')
            ->select();

        $this->assign('list',$list);

        return $this-> fetch();

    }

     //添加分类
     public function add_news_cate()
     {

       $data = [
           'cate_name' => $_POST['cate_name'],
           'display_position' => $_POST['display_position'],
           'sort' => $_POST['sort'],
       ];

         if(isset($_POST['type']) && $_POST['type'] == 'link')
         {
             $data['display_mode'] = 'link';
         }
         else
         {
             $data['display_mode'] = 'article';
         }

       $res = Db::name('news_cate')->insertGetId($data);

         try_add($res);
     }

    //显示修改分类
    public function edit_news_cate(Request $request)
    {
        $id = $request -> param('id');

        $list = Db::name('news_cate')
              ->where('id',$id)
              ->find();

        $this->assign('list',$list);

        return $this->fetch();
    }

    //修改分类操作
    public function do_edit_news_cate()
    {
        $res = Db::name('news_cate')->update($_POST);

        try_update($res);
    }

    //删除分类
    public function del_news_cate(Request $request)
    {
       $id = $request->param('id');

        $res = Db::name('news_cate')->where('id',$id)->delete();

        try_del($res);

    }

    //文章列表
    public function show_article_list()
    {
        $list = Db::view('news_article')
              ->view('news_cate','cate_name','news_cate.id = news_article.cate_id')
              ->paginate(5);

        $page = $list->render();

        $this->assign('list',$list);
        $this->assign('page',$page);
        //获取链接分类
        $cate = Db::name('news_cate')->where('display_mode','article')->field('id,cate_name')->select();
        $this->assign('cate',$cate);

        return $this->fetch();
    }

    public function add_article()
    {
        $cate = Db::name('news_cate')->where('display_mode','article')->field('id,cate_name')->select();
        $this->assign('cate',$cate);
        return $this->fetch();
    }

    //添加文章操作
    public function do_add_article(Request $request)
    {
        $req = $request->param();
      //  j($req);
        $data = [
            'cate_id' => $req['cate_id'],
            'title' =>  $req['title'],
            'text' =>  $req['text'],
            'url' =>  $req['url'],
            'img' =>  $req['img'],
            'sort' =>  $req['sort'],
            'display' => empty($req['display'])? 'N' : 'Y',
            'add_time' => time(),
            'admin_id' => $_SESSION['admin']['id'],
        ];

        $res = Db::name('news_article')->insertGetId($data);

        try_add($res);

    }

    //修改文章
    public function edit_article()
    {
        $cate = Db::name('news_cate')->where('display_mode','article')->field('id,cate_name')->select();
        $this->assign('cate',$cate);

        $id = $_GET['id'];
        $res = Db::name('news_article')->where('id',$id)->find();
        $this->assign('list',$res);

        return $this->fetch();
    }

    //修改文章操作
    public function do_edit_article()
    {

        $_POST['update_time'] = time();
        $_POST['display'] = empty($_POST['display']) ? 'N' : 'Y' ;

        $res = Db::name('news_article')->update($_POST);

        try_update($res);
    }

    //删除文章操作
    public function del_article()
    {
        $id = $_GET['id'];

        $res = Db::name('news_article')->where('id',$id)->delete();

        try_del($res);

    }

    //显示链接列表
    public function show_news_link()
    {
        //j($_GET);
        if(isset($_GET['news_cate_display_mode']) || isset($_GET['news_cate_id']) || isset($_GET['news_link_name']))
        {
            if(isset($_GET['news_cate_display_mode']))
            {
                $data['news_cate.display_mode'] = $_GET['news_cate_display_mode'];
            }
            if(isset($_GET['news_cate_id']))
            {
                $data['news_cate.id'] = $_GET['news_cate_id'];
            }
            if(isset($_GET['news_link_name']))
            {
                $data['news_link.name'] = $_GET['news_link_name'];
            }

            $junjun ='卢笃钧';

        }
        else
        {

             //   $type = isset($_POST['type'])?$_POST['type']:0;
                $cateid = isset($_POST['cate'])?$_POST['cate']:0;
                $key = isset($_POST['key'])?$_POST['key']:0;
                $data = [];

//                if(!empty($type))
//                {
//                    $data['news_cate.display_mode'] = $type;
//                }
                if(!empty($cateid))
                {
                    $data['news_cate.id'] = $cateid;
                }
                if(!empty($key))
                {
                    $data['news_link.name'] = $key;
                }

        }

         $res = Db::view('news_link');
         $res= $res->view('news_cate','cate_name','news_cate.id = news_link.cate_id');

         if($data)
         {
           $res = $res->where($data);
           $query = ['query' => $data];
           $res = $res->paginate(5,false,$query);
         }
        else
        {
            $res = $res->paginate(5);
        }


        $page = $res -> render();

        $this->assign('page',$page);
        $this->assign('list',$res);

        if($data && empty($junjun))
        {
          echo $this->fetch('ajax_link_list');
          exit;
        }

        //获取链接分类
        $cate = Db::name('news_cate')->where('display_mode','link')->field('id,cate_name')->select();
        $this->assign('cate',$cate);

        return $this->fetch();

    }

    //添加新闻链接
    public function add_link()
    {
        $link_cate = Db::name('news_cate')->where('display_mode','link')->field('id,cate_name')->select();

        $this->assign('link_cate',$link_cate);
        return $this->fetch();
    }

    //添加新闻链接操作
    public function do_add_link(Request $request)
    {
        extract($request->param());

        $data = [
            'name' => $link_name,
            'icon' => $link_img,
            'url' => $link_url,
            'display' => empty($display)? 'N' : 'Y',
            'sort' => $sort,
            'cate_id' => $cate_id,
            'add_time' => time(),
        ];

        $res = Db::name('news_link')->insertGetId($data);

        try_add($res);
    }

    //修改链接
    public function edit_link(Request $request)
    {
        //列出链接分类
        $link_cate = Db::name('news_cate')->where('display_mode','link')->field('id,cate_name')->select();
        $this->assign('link_cate',$link_cate);

        //获得链接通过ID
        $id = $request->param('id');

        $res = Db::name('news_link')->where('id',$id)->find();
        $this->assign('list',$res);
        return $this->fetch();
    }

    //修改链接操作
    public function do_edit_link()
    {
        $data = [
            'id' => $_POST['id'],
            'name' => $_POST['link_name'],
            'icon' => $_POST['link_img'],
            'url' => $_POST['link_url'],
            'display' => empty($_POST['display']) ? 'N' : 'Y' ,
            'sort' => $_POST['sort'],
            'cate_id' => $_POST['cate_id'],
            'update_time' => time(),
        ];

        $res = Db::name('news_link')->update($data);

        try_update($res);

    }

    //删除链接操作
    public function del_link(Request $request)
    {
        $id = $request->param('id');

        $res = Db::name('news_link')->where('id',$id)->delete();

        try_del($res);

    }

    //ajax搜索文章
    public function ajax_article_list()
    {

            if(isset($_GET['data']))
            {
                $data = json_decode($_GET['data'],true);
                // j($data);
            }
            else
            {
                $cate_id = $_POST['cate_id'];
                $title = $_POST['title'];
                $data = [];

                if($cate_id)
                {
                    $data['cate_id'] = $cate_id;
                }
                if($title)
                {
                    $data['title'] = $title;
                }
            }

        $res = Db::view('news_article');
        $res = $res->view('news_cate','cate_name','news_article.cate_id = news_cate.id');
            if(isset($data))
            {
             $res = $res->where($data);
             $query = ['query' => ['data' => json_encode($data)]];
            }

         $res = $res->paginate(5,false,$query);


        $page = $res->render();
        $this->assign('page',$page);
        $this->assign('list',$res);

        echo $this->fetch();

    }

    //测试websocket
    public function see_websocket()
    {
        return $this->fetch();
    }


}