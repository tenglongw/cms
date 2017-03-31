<?php
namespace app\index\controller;

class Mobile extends \app\index\controller\Common
{
	public function indexList(){
		$categorys = get_content_category();
		//新闻6个
		$subids = \ebcms\Tree::subtreeid($categorys, 1);
		$lists_news = \app\content\model\Content::where(['category_id' => ['in', $subids], 'status' => 1])->order('sort desc,update_time desc')->limit('0,6')->select();
		//专题3个
		$lists_special = \app\content\model\Content::where(['category_id' => 10, 'status' => 1])->order('sort desc,update_time desc')->limit('0,3')->select();
		//视频3个
		$subids = \ebcms\Tree::subtreeid($categorys, 3);
		$lists_video = \app\content\model\Content::where(['category_id' => ['in', $subids], 'status' => 1])->order('sort desc,update_time desc')->limit('0,3')->select();
		//测评拆解3个
		$lists_cp = \app\content\model\Content::where(['category_id' => ['in', [11,12]], 'status' => 1])->order('sort desc,update_time desc')->limit('0,3')->select();
		$list = array_merge($lists_news, $lists_special,$lists_video,$lists_cp);
// 		$page = $lists->getPage();
		$baseUrl = '/index.php/';
		$result = array();
		$data_list = $this->list_hand($list,$categorys,$baseUrl,0,0);
		$result['lists'] = $data_list;
// 		$result['page'] = $page;
        $callback = $_GET['callback'];
        echo $callback.'('.json_encode($result).')';exit;
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
	private function list_hand($data_list,$categorys,$baseUrl,$with,$height,$tag){
		$result = array();
		foreach ($data_list as $key=>$val){
			$temp['thumb'] = thumb($val['thumb'],$with,$height);
			$temp['url'] = $baseUrl.$this->getUrlPath($categorys, $val['category_id']).'/'.$val['id'].'.html';
			$temp['title'] = $val['title'];
			$temp['author'] = $val['author'];
			$temp['create_time'] =$val['create_time'];
			$temp['description'] = $val['description'];
			$temp['position'] = $categorys[$val['category_id']]['title'];
			if(!empty($tag)){
				$temp['tag'] = $tag;
			}
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
	
	private function imagePathHand($dataList){
		$resutl = array();
		foreach ($dataList as $key=>$val){
			$val['thumb'] = thumb($val['thumb'],718,532);
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