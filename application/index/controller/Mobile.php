<?php
namespace app\index\controller;

class Mobile extends \app\index\controller\Common
{
	
	public function index(){

		$baseUrl = 'https://'.$_SERVER['HTTP_HOST'].'';
		//首页轮播
		$lists_recommend = \think\Db::name('recommend')->field("content_id,thumb")->where('category_id', 2)->select();
		$carousel_temp = $this->imagePathHand($lists_recommend,$baseUrl,750,325);
		$carousel = $this->carouselHandle($carousel_temp);
		$titleArray = array('平台类型','产品类型');
		$lists_recommendCate = \think\Db::name('recommendcate')->field("id,group,title,image")->where(array('group'=>['in', $titleArray]))->select();
		$resultList = array();
		$index = 0;
		$adviceList = array();
		foreach ($titleArray as $key => $val){
			$parent = array();
			$parent['title'] = $val;
			if($index == 0){
				$parent['isActive'] = true;
			}else{
				$parent['isActive'] = false;
			}
			$index ++;
			//循环二级菜单
			foreach ($lists_recommendCate as $ckey=>$cval){
				if($cval['group'] == $val){
					//查询二级菜单下的新闻列表
					$lists_recommend = \think\Db::name('recommend')->field("content_id,title,thumb")->where('category_id', $cval['id'])->select();
					$dataList = $this->imagePathHand($lists_recommend,$baseUrl,150,150);
					$secondLevelMenu = array();
					$secondLevelMenu['title'] = $cval['title'];
					$secondLevelMenu['image'] = $baseUrl.thumb($cval['image'],40,40);
					$secondLevelMenu['size'] = count($dataList);
					$secondLevelMenu['list'] = $dataList;
					$parent['advice'][] = $secondLevelMenu;
				}
			}
			$adviceList[] = $parent;
		}
		$result = array();
		$result['carousel'] = $carousel;
		$result['adviceList'] = $adviceList;
		echo json_encode($result);
		//         $callback = $_GET['callback'];
		//         echo $callback.'('.json_encode($result).')';exit;
	}
	
	/**
	 * 重点产品
	 */
	public function  majorProducts(){
		$baseUrl = 'https://'.$_SERVER['HTTP_HOST'].'';
		$result = array();
		//获取所有推荐分类
		$cateList = \app\content\model\Recommendcate::field("id,title,mark")->where(['group' => '重点产品', 'status' => 1])->order('sort desc,update_time desc')->select();
		//查询分类对应的新闻广告
		foreach ($cateList as $key => $val){
			$list = \app\content\model\Recommend::field("content_id,thumb,title")->where(['category_id' => $val['id'], 'status' => 1])->order('RAND()')->limit(5)->select();
// 			$list = $this->imagePathHand($list,$baseUrl,107,107);
			$temp = array();
			foreach ($list as $lkey=>$lval){
				if(count($list)-1 == $lkey){
					$with = 236;
					$height = 236;
				}else{
					$with = 107;
					$height = 107;
				}
				$lval['thumb'] = $baseUrl.thumb($lval['thumb'],$with,$height);
				$temp[] = $lval;
			}
			$val['list'] = $temp;
			$result['data'][] = $val;
		}
		echo json_encode($result);
	}
	
	
	/**
	 * 搜索页面
	 */
	public function getSearch(){
		$result = array();
		$tag = new \app\content\model\Tag();
		//热门搜索
		$hotword = \app\content\model\Hotword::field("tag,id")->where(['status' => 1])->order('sort desc,update_time desc')->select();
		$result['hotword'] = $hotword;
		//分类标签
		$categorys = get_content_category();
		foreach ($categorys as $key=>$val){
			if($val['pid'] == 0){
				$tagTemp = array();
				$subTreeId = \ebcms\Tree::subtreeidStr($categorys, $val['id']);
				$tag_list = $tag->query("select t.id,t.tag from ebcms5_content_tag t join ebcms5_content_tags ts on t.id = ts.tag_id where ts.cc_id in(".$subTreeId.")");
				$tagTemp['title'] = $val['title'];
				$tagTemp['tagList'] = $tag_list;
				$result['tag'][] = $tagTemp;
			}
		}
		echo json_encode($result);exit;
	}
	
	/**
	 * 搜索
	 */
	public function search()
	{
		if (request()->isGet()) {
			$result = array();
			$q = input('q');
			$category = input('category');
			if ($q) {
				$q = trim($q);
				$where = [
						'status' => 1,
						'title|keywords|description' => ['like', '%' . $q . '%']
				];
				$categorys = get_content_category();
				$category_ids = [];
				if(!empty($category)){
					$category_ids = \ebcms\Tree::subid2($categorys, $category);
				}else{
					foreach ($categorys as $key => $value) {
						$category_ids[] = $value['id'];
					}
				}
	
				if ($extend_id = input('extend_id',0,'intval')) {
					$extendids = get_content_category('extend');
					$where['category_id'] = ['in',array_intersect($category_ids, $extendids[$extend_id])];
				}elseif ($category_id = input('category_id',0,'intval')) {
					$where['category_id'] = ['in',array_intersect($category_ids, (array)$category_id)];
				}else{
					$where['category_id'] = ['in',$category_ids];
				}
	
				$cache = \ebcms\Config::get('content.search_cache') ?: false;
				$lists = \app\content\model\Content::where($where)->order('id desc')->cache($cache)->paginate(20, false, [
						'query' => ['q' => $q],
				]);
				$count =  \app\content\model\Content::where($where)->count();
	
				$tag = new \app\content\model\Tag();
				$tag_list = $tag->query("select ct.tag,cts.c_id from ebcms5_content_tag ct,ebcms5_content_tags cts where ct.id = cts.tag_id");
				$this->assign('tag_list', $tag_list);
	
				// 路径
				$baseUrl = '/';
				$data_list = $this->list_hand($lists,$categorys,$baseUrl,$tag_list);
				$result['lists'] = $data_list;
				$result['page'] = $lists->getPage();
				$result['total'] = $count;
				// seo设置
			}
			$result['q'] = $q;
			$result[category] = $category;
			//     		echo json_encode($result);exit;
			$callback = $_GET['callback'];
			echo $callback.'('.json_encode($result).')';exit;
		}
	}
	
	
	/**
	 * 文章详情
	 */
	public function detail(){

		if ($filename = input('filename')) {
			$where = [
					'filename' => $filename
			];
		} else {
			$where = [
					'id' => input('id', 0, 'intval')
			];
		}
		if ($content = \app\content\model\Content::where($where)->find()) {
			if (1 != $content['status']) {
				$this->error('内容未审核！');
			}
		
			if ($content['category']['status'] != 1) {
				$this->error('内容未审核！');
			}
		
		
			// 统计点击次数
			if (\ebcms\Config::get('content.click_record')) {
				\think\Hook::add('app_end', 'app\\index\\behavior\\Click');
			}
		
			if (request()->isGet()) {
				// 路径
				$categorys = get_content_category('all');
				$pdatas = \ebcms\Tree::parent_data($categorys, $content['category_id']);
				config('topcateid',$pdatas?$pdatas[0]['id']:$content['category']['id']);
				foreach ($pdatas as $value) {
					\ebcms\Position::add(['title' => $value['title'], 'url' => $value['url']]);
				}
				\ebcms\Position::add(['title' => $categorys[$content['category_id']]['title'], 'url' => $categorys[$content['category_id']]['url']]);
				\ebcms\Position::add(['title' => $content['title'], 'url' => $content['url']]);
		
				// seo设置
				$this->assign('seo', [
						'title' => $content['title'] . ' - ' . $this->seo['sitename'],
						'keywords' => $content['keywords'],
						'description' => $content['description'],
				]);
				$category = array('title'=>$content['title'],'id'=>$content['category_id'],'name'=>$categorys[$content['category_id']]['name']);
				$this->assign('content', $content);
				if(!request()->isMobile()){
					$this->assign('category', $category);
				}
		
				$qc = new \QC();
				$login_url = $qc->qq_login();
				$this->assign('qq_url', $login_url);
				$catetpl = isset($categorys[$content['category_id']]) ? $categorys[$content['category_id']]['tpl_detail'] : '';
				return $this->fetch($content['tpl'] ?: $catetpl);
			} elseif (request()->isPost()) {
				$res = [
						'seo' => [
								'title' => $content['metatitle'] . ' - ' . $this->seo['sitename'],
								'keywords' => $content['keywords'],
								'description' => $content['description'],
						],
						'content' => $content
				];
				return $res;
			}
		} else {
			$this->error('内容不存在');
		}
		
	}
	
	private function carouselHandle($dataList){
		$tempList = array();
		foreach ($dataList as $key => $val){
			$temp = array();
			if($key == 0){
				$val['active'] = true;
			}else{
				$val['active'] = false;
			}
			$tempList[] = $val;
		}
		return $tempList;
	}
	
	public function tag()
	{
			if ($tag = input('tag')) {
				// 查看详细标签
				if ($data = \app\content\model\Tag::where('tag', $tag)->find()) {
	
					if (!$data['status']) {
						$this->error('标签不存在！');
					}
	
					$lists_tag = \think\Db::name('content_tags')->where('tag_id', $data['id'])->select();
// 					$this->assign('page', $lists->render());
					$ids = [];
					$cc_ids = [];
					foreach ($lists_tag as $value) {
						$ids[] = $value['c_id'];
						$cc_ids[] = $value['cc_id'];
					}
					if ($ids) {
	
						$where = [
								'id' => ['in', $ids],
								'status' => ['eq', 1],
						];
						$categorys = get_content_category();
						$category_ids = [];
						foreach ($categorys as $key => $value) {
							$category_ids[] = $value['id'];
						}
						$where['category_id'] = ['in',$category_ids];
						$lists = \app\content\model\Content::where($where)->order('id desc')->paginate(20);
						$page = $lists->getPage();
					} else {
						$lists = [];
					}
// 					$category_id = $cc_ids[0];
// 					$tag = $data;
// 					return $this->fetch();
				} else {
					$this->error('tag不存在！');
				}
			}
			
			$result = array();
			$baseUrl = '/index.php/';
			$data_list = $this->list_hand($lists,$categorys,$baseUrl,291,212,$data['tag']);
			$result['lists'] = $data_list;
			$result['page'] = $page;
			$callback = $_GET['callback'];
			echo $callback.'('.json_encode($result).')';exit;
	}
	
	
	/**
	 * 获取数据图片，以及跳转地址
	 * @param unknown $data_list
	 */
	private function list_hand($data_list,$categorys,$baseUrl,$with,$height){
		$result = array();
		foreach ($data_list as $key=>$val){
			$temp['thumb'] = thumb($val['thumb'],$with,$height);
			$temp['url'] = $baseUrl.$this->getUrlPath($categorys, $val['category_id']).'/'.$val['id'].'.html';
			$temp['title'] = $val['title'];
			$temp['author'] = $val['author'];
			$temp['create_time'] =$val['create_time'];
			$temp['description'] = $val['description'];
			$temp['position'] = $categorys[$val['category_id']]['title'];
			$result[] = $temp;
		}
		return $result;
	}
	
	private function getUrlPath($categorys,$category_id){
		$pathUrl = $categorys[$category_id]['name'];
		if($categorys[$category_id]['pid'] != 0){
			$path = self::getUrlPath($categorys,$categorys[$category_id]['pid']);
			$pathUrl = $path.'/'.$pathUrl;
		}
		return $pathUrl;
	}
	
	private function imagePathHand($dataList,$url,$with=0,$height=0){
		$resutl = array();
		foreach ($dataList as $key=>$val){
			$val['thumb'] = $url.thumb($val['thumb'],$with,$height);
			$resutl[] = $val;
		}
		return $resutl;
	}
	public function menuList(){
		$result = array();
		//获取分类
		$categorys = get_content_category();
		$result['categorys'] = $categorys;
		$tree = \ebcms\Tree::subtree(get_content_category(),0);
		echo json_encode($tree);exit;
	}
}