<?php

namespace app\admin\controller;

use think\Db;
use app\admin\model\IdPhoto as IdPhotoModel;

class IdPhoto extends Base
{
	protected $Scolumnid = 2;
    /**
     * 文章列表
     */
	public function news_list()
	{
		$keytype=input('keytype','news_title');
		$key=input('key');

		//查询：时间格式过滤 获取格式 2015-11-12 - 2015-11-18
		$sldate=input('reservation','');
		$arr = explode(" - ",$sldate);
		$map= [];
        if(count($arr)==2){
            $arrdateone=strtotime($arr[0]);
            $arrdatetwo=strtotime($arr[1].' 23:55:55');
            $map['picture_addtime'] = array(array('egt',$arrdateone),array('elt',$arrdatetwo),'AND');
        }
		//map架构查询条件数组
		if(!empty($key)){
				$map[$keytype]= $key;
		}
			
		$news=Db::name('id_photo')->where($map)->order('picture_id desc')->paginate(config('paginate.list_rows'),false,['query'=>get_query()]);	
		
		$show = $news->render();
		$show=preg_replace("(<a[^>]*page[=|/](\d+).+?>(.+?)<\/a>)","<a href='javascript:ajax_page($1);'>$2</a>",$show);
		$this->assign('page',$show);

		$this->assign('keytype',$keytype);
		$this->assign('keyy',$key);
		$this->assign('sldate',$sldate);
		$this->assign('news',$news);
		if(request()->isAjax()){
			return $this->fetch('ajax_news_list');
		}else{
			return $this->fetch();
		}		
	}

    /**
     * 删除至回收站(单个)
     */
	public function news_del()
	{
		$p=input('p');
		$news_model=new IdPhotoModel;
		$rst=$news_model->where(array('n_id'=>input('n_id')))->setField('news_back',1);//转入回收站
		if($rst!==false){
			$this->success('文章已转入回收站',url('admin/IdPhoto/news_list',array('p' => $p)));
		}else{
			$this -> error("删除文章失败！",url('admin/IdPhoto/news_list',array('p'=>$p)));
		}
	}
    /**
     * 删除至回收站(全选)
     */
	public function news_alldel()
	{
		$p = input('p');
		$ids = input('n_id/a');
		if(empty($ids)){
			$this -> error("请选择删除文章",url('admin/IdPhoto/news_list',array('p'=>$p)));//判断是否选择了文章ID
		}
		if(is_array($ids)){//判断获取文章ID的形式是否数组
			$where = 'n_id in('.implode(',',$ids).')';
		}else{
			$where = 'n_id='.$ids;
		}
		$news_model=new IdPhotoModel;
		$rst=$news_model->where($where)->setField('news_back',1);//转入回收站
		if($rst!==false){
			$this->success("成功把文章移至回收站！",url('admin/IdPhoto/news_list',array('p'=>$p)));
		}else{
			$this -> error("删除文章失败！",url('admin/IdPhoto/news_list',array('p'=>$p)));
		}
	}
  
   
    /**
     * 回收站列表
     */
	public function news_back()
	{
		$keytype=input('keytype','news_title');
		$key=input('key');
		$news_l=input('news_l');
		$opentype_check=input('opentype_check','');
		$diyflag=input('diyflag','');
		//查询：时间格式过滤 格式 2015-11-12 - 2015-11-18
		$sldate=input('reservation','');
		$arr = explode(" - ",$sldate);
		if(count($arr)==2){
			$arrdateone=strtotime($arr[0]);
			$arrdatetwo=strtotime($arr[1].' 23:55:55');
			$map['news_time'] = array(array('egt',$arrdateone),array('elt',$arrdatetwo),'AND');
		}
		//map架构查询条件数组
		$map['news_back']= 1;
		if(!empty($key)){
			$map[$keytype]= array('like',"%".$key."%");
		}
		if ($opentype_check!=''){
			$map['news_open']= array('eq',$opentype_check);
		}
		if (!empty($news_l)){
			$map['news_l']= array('eq',$news_l);
		}
        if(!config('lang_switch_on')){
            $map['news_l']=  $this->lang;
        }
		if($this->Scolumnid){
			$map['news_columnid']=  $this->Scolumnid;
		}
		$where=$diyflag?"FIND_IN_SET('$diyflag',news_flag)":'';
		$news_model=new IdPhotoModel;
		$news=$news_model->alias("a")->field('a.*,b.*,c.menu_name')
				->join(config('database.prefix').'member_list b','a.news_auto =b.member_list_id')
				->join(config('database.prefix').'menu c','a.news_columnid =c.id')->where($map)
				->where($where)->order('news_time desc')->paginate(config('paginate.list_rows'),false,['query'=>get_query()]);
		$show = $news->render();
		$show=preg_replace("(<a[^>]*page[=|/](\d+).+?>(.+?)<\/a>)","<a href='javascript:ajax_page($1);'>$2</a>",$show);
		$this->assign('page',$show);
		//文章属性数据
		$diyflag_list=Db::name('diyflag')->select();
		$this->assign('diyflag',$diyflag_list);
		$this->assign('opentype_check',$opentype_check);
		$this->assign('keytype',$keytype);
		$this->assign('keyy',$key);
		$this->assign('news_l',$news_l);
		$this->assign('sldate',$sldate);
		$this->assign('diyflag_check',$diyflag);
		$this->assign('news',$news);
		if(request()->isAjax()){
			return $this->fetch('ajax_news_back');
		}else{
			return $this->fetch();
		}	
	}
    /**
     * 还原文章
     */
	public function news_back_open()
	{
		$p=input('p');
		$news_model=new IdPhotoModel;
		$rst=$news_model->where('n_id',input('n_id'))->setField('news_back',0);//转入正常
		if($rst!==false){
			$this->success('文章还原成功',url('admin/News/news_back',array('p' => $p)));
		}else{
			$this -> error("文章还原失败！",url('admin/News/news_back',array('p' => $p)));
		}
	}
    /**
     * 彻底删除(单个)
     */
	public function news_back_del()
	{
		$n_id=input('n_id');
		$p = input('p');
		$news_model=new IdPhotoModel;
		if (empty($n_id)){
			$this->error('参数错误',url('admin/News/news_back',array('p' => $p)));
		}else{
			$rst=$news_model->where('n_id',input('n_id'))->delete();
			if($rst!==false){
				$this->success('文章彻底删除成功',url('admin/News/news_back',array('p' => $p)));
			}else{
				$this -> error("文章彻底删除失败！",url('admin/News/news_back',array('p' => $p)));
			}
		}
	}
    /**
     * 彻底删除(全选)
     */
	public function news_back_alldel()
	{
		$p = input('p');
		$ids = input('n_id/a');
		if(empty($ids)){
			$this -> error("请选择删除文章",url('admin/News/news_back',array('p'=>$p)));//判断是否选择了文章ID
		}
		if(is_array($ids)){//判断获取文章ID的形式是否数组
			$where = 'n_id in('.implode(',',$ids).')';
		}else{
			$where = 'n_id='.$ids;
		}
		$news_model=new IdPhotoModel;
		$rst=$news_model->where($where)->delete();
		if($rst!==false){
			$this->success("成功把文章删除，不可还原！",url('admin/News/news_back',array('p'=>$p)));
		}else{
			$this -> error("文章彻底删除失败！",url('admin/News/news_back',array('p' => $p)));
		}
	}
}