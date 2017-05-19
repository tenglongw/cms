<?php
namespace app\index\controller;

class Mobile extends \app\index\controller\Common
{
	public function index(){

		$baseUrl = 'https://'.$_SERVER['HTTP_HOST'].'';
		//首页轮播
		$lists_recommend = \think\Db::name('recommend')->field("content_id,thumb")->where('category_id', 2)->select();
		$carousel_temp = $this->imagePathHand($lists_recommend,$baseUrl,750,330);
		$carousel = $this->carouselHandle($carousel_temp);
		$titleArray = array('平台类型','产品类型');
		$lists_recommendCate = \think\Db::name('recommendcate')->field("id,group,title,image,color")->where(array('group'=>['in', $titleArray]))->order('sort desc')->select();
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
					$lists_recommend = \think\Db::name('recommend')->field("content_id id,title,thumb")->where('category_id', $cval['id'])->select();
					$dataList = $this->imagePathHand($lists_recommend,$baseUrl,160,240);
					$secondLevelMenu = array();
					$secondLevelMenu['title'] = $cval['title'];
					$secondLevelMenu['color'] = $cval['color'];
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
		$cateList = \app\content\model\Recommendcate::field("id,title,mark,image")->where(['group' => '重点产品', 'status' => 1])->order('sort desc,update_time desc')->select();
		//查询分类对应的新闻广告
		foreach ($cateList as $key => $val){
			$list = \app\content\model\Recommend::field("content_id,thumb,title,isVideo")->where(['category_id' => $val['id'], 'status' => 1])->order('RAND()')->limit(5)->select();
// 			$list = $this->imagePathHand($list,$baseUrl,107,107);
			$temp = array();
			foreach ($list as $lkey=>$lval){
				if(count($list)-1 == $lkey){
					$with = 290;
					$height = 290;
				}else{
					$with = 130;
					$height = 130;
				}
				$lval['thumb'] = $baseUrl.thumb($lval['thumb'],$with,$height);
				
				$temp[] = $lval;
			}
			$val['image'] = $baseUrl.thumb($val['image'],290,290);
			$val['list'] = $temp;
			$result['data'][] = $val;
		}
		echo json_encode($result);
	}
	
	public function majorProductList(){
		$baseUrl = 'https://'.$_SERVER['HTTP_HOST'].'';
		$where = [
				'status' => 1,
				'category_id' => $_GET['category_id']
		];
		
		$cache = \ebcms\Config::get('content.search_cache') ?: false;
		$lists = \app\content\model\Recommend::where($where)->order('sort desc')->cache($cache)->paginate(20);
		$count =  \app\content\model\Recommend::where($where)->count();
		// 路径
		$data_list = $this->list_hand($lists,$baseUrl,160,240);
		$result['lists'] = $data_list;
		$result['page'] = $lists->getPage();
		$result['total'] = $count;
		echo json_encode($result);exit;
	}
	
	private function categoryImageArray($baseUrl){
		$cateList = \app\content\model\Recommendcate::field("id,image")->where(['status' => 1,'group'=>array('neq','重点产品')])->select();
		$cateArray = array();
		foreach ($cateList as $key => $val){
			
			if(!empty($val['image'])){
				$imagePath = $baseUrl.'/upload'.$val['image'];
			}else{
				$imagePath = $val['image'];
			}
			$cateArray[$val['id']] = $imagePath;
		}
		return $cateArray;
	}
	
	/**
	 * 保存用户信息
	 */
	public function saveUser(){
		$result = array();
		$user = \think\Db::name('user');
		$data = array(
			'nickname' => $_GET['nickname'],
			'email' => 'wexin@qq.com',
			'salt' => 'wechat',
			'password' => crypt_pwd('111111', 'tencent'),
			'create_time' => time(),
		);
		$id = $this->updateUserInfo($data);
		if($id){
			$result['status'] = 1;
			$result['data'] = $id;
		}else{
			$result['status'] = 0;
			$result['data'] = '保存失败';
		}
		echo json_encode($result);exit;
	}
	
	public function updateUserInfo($row){;}
	
	/**
	 * 搜索
	 */
	public function search()
	{
		$baseUrl = 'https://'.$_SERVER['HTTP_HOST'].'';
		if (request()->isGet()) {
			$result = array();
			$q = input('q');
			$category = input('category');
			if ($q) {
				$q = trim($q);
				$where = [
						'status' => 1,
						'title|description' => ['like', '%' . $q . '%']
				];
	
				$cache = \ebcms\Config::get('content.search_cache') ?: false;
				$lists = \app\content\model\Recommend::where($where)->order('sort desc')->cache($cache)->paginate(20, false, [
						'query' => ['q' => $q],
				]);
				$count =  \app\content\model\Recommend::where($where)->count();
				// 路径
				$data_list = $this->list_hand($lists,$baseUrl,160,240);
				$result['lists'] = $data_list;
				$result['page'] = $lists->getPage();
				$result['total'] = $count;
				// seo设置
			}else {
				//热门搜索
				$hotword = \app\content\model\Hotword::field("tag,id")->where(['status' => 1])->order('sort desc,update_time desc')->select();
				$result['hotword'] = $hotword;
			}
			echo json_encode($result);exit;
		}
	}
	
	
	/**
	 * 文章详情
	 */
	public function detail(){
		$baseUrl = 'https://'.$_SERVER['HTTP_HOST'];
		$result = array();
		if ($filename = input('filename')) {
			$where = [
					'filename' => $filename
			];
		} else {
			$where = [
					'id' => input('id', 0, 'intval')
			];
		}
		if ($content = \app\content\model\Content::field("id,title,description,ext,status")->where($where)->find()) {
			if (1 != $content['status']) {
				$result['data'] = '内容未审核！';
				$result['status'] = 0;
			}
			//内容处理
			$content = $this->contentHandler($content, $baseUrl);
		
			// 统计点击次数
			if (\ebcms\Config::get('content.click_record')) {
				\think\Hook::add('app_end', 'app\\index\\behavior\\Click');
			}
			
// 			$body = \app\content\model\Body::field("body")->where(array('id'=>input('id', 0, 'intval')))->find();
			$result['data'] = $content;
			$result['status'] = 1;
		} else {
			$result['data'] = '内容不存在';
			$result['status'] = 0;
		}
		echo json_encode($result);exit;
	}
	
	private function contentHandler($content,$baseUrl){
		$array = array();
		$ext = array();
		$isVideo = false;
		if(!empty($content['ext']) && !empty($content['ext']['body'])){
			$body = $content['ext']['body'];
			$ext = $content['ext'];
			if(!empty($ext['product'])){
				$ext['product'] = $baseUrl.'/upload'.$ext['product'];
			}
			
			if(!empty($ext['thumbnail'])){
				$ext['thumbnail'] = $baseUrl.thumb($ext['thumbnail']);
				if(strpos($ext['product'], '.mp4') !== false){
					$isVideo = true;
				}
			}
			if(!empty($ext['downImage'])){
				$ext['downImage'] = $baseUrl.'/upload'.$ext['downImage'];
			}
			unset($ext['body']);
			// 			echo json_encode($ext);exit;
			// 			var_dump(json_decode(json_encode($body['__config__']),true));exit;
			$config = json_decode(json_encode($body['__config__']),true);
			foreach ($config as $key => $val){
			
				if(isset($body[$key])){
					$temp = array();
					$temp['type'] = $val;
					if($val == 'file'){
						$temp['data'] = $baseUrl.thumb($body[$key]);
					}else{
						$temp['data'] = $body[$key];
					}
					$array[] = $temp;
				}
			}
		}
		$ext['body'] = $array;
		$ext['isVideo'] = $isVideo;
		$content['ext'] = $ext;
		return $content;
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
	
	
	/**
	 * 获取数据图片，以及跳转地址
	 * @param unknown $data_list
	 */
	private function list_hand($data_list,$baseUrl,$with,$height){
		$imagePath = array($baseUrl.'/static/index/image/video.png',$baseUrl.'/static/index/image/file.png');
		$cateImageArray = $this->categoryImageArray($baseUrl);
		$result = array();
		foreach ($data_list as $key=>$val){
			$temp['thumb'] = $baseUrl.thumb($val['thumb'],$with,$height);
			$temp['title'] = $val['title'];
			$temp['tagImage'] = $imagePath[$val['isVideo']];
			if(!empty($cateImageArray[$val['category_id']])){
				$temp['cateImage'] = $cateImageArray[$val['category_id']];
			}else{
				$temp['cateImage'] = '';
			}
			$temp['id'] = $val['content_id'];
			$temp['create_time'] =$val['create_time'];
			$temp['description'] = $val['description'];
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
}