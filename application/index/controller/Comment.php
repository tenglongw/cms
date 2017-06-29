<?php
namespace app\index\controller;
class Comment extends \app\index\controller\Common
{

    public function index()
    {
        if (request()->isGet()) {
        } elseif (request()->isPost()) {
            $size = input('size', 5, 'intval') ?: 5;
            $size = min($size, 50);
            $lists = \app\content\model\Comment::with('touser,user')->where(['comment.pid' => 0, 'comment.tid' => input('tid')])->order('comment.id', 'desc')->paginate($size);
            $ids = [];
            foreach ($lists as $v) {
                $ids[] = $v->id;
            }
            $sublists = [];
            if ($ids) {
                $x = \app\content\model\Comment::with('touser,user')->where(['comment.topid' => ['in', $ids]])->order('comment.id', 'desc')->select();
                foreach ($x as $key => $v) {
                    $sublists[] = $v->toArray();
                }
            }
            $this->success('加载成功！', '', [
                'page' => $lists->render(),
                'comments' => $lists->toArray(),
                'subcomments' => $sublists,
            ]);
        }
    }

    // 添加评论
    public function add()
    {
        if (request()->isPost()) {

            if (\ebcms\Config::get('content.comment_able')) {

                if (session('?user_id')) {
                    if (\ebcms\Config::get('content.comment_verify')) {
                        // 验证验证码
//                         $verify = new \org\Verify([]);
//                         if (!$verify->check(input('verify'), 1)) {
//                             $this->error('验证码错误！');
//                         }
                    }
                } else {
                    if (!\ebcms\Config::get('content.comment_visitor')) {
                        $this->error('请登录！');
                    }
                    if (\ebcms\Config::get('content.comment_visitor_verify')) {
                        // 验证验证码
//                         $verify = new \org\Verify([]);
//                         if (!$verify->check(input('verify'), 1)) {
//                             $this->error('验证码错误！');
//                         }
                    }
                }

                $status = \ebcms\Config::get('content.comment_check') ? 99 : 1;
                $data = [
                    'uid' => session('?user_id') ? session('user_id') : 0,
                    'touid' => 0,
                    'topid' => 0,
                    'tid' => input('tid'),
                    'pid' => 0,
                    'content' => input('content'),
                    'status' => $status,
                	'create_date' => date("m月d日",time())
                ];
                if (\ebcms\Config::get('content.comment_getip')) {
                    $data['ip'] = request()->ip(0, true);
                }
                \app\content\model\Comment::create($data);
                $this->success('评论成功！');

            } else {
                $this->error('评论已关闭！');
            }
        }
    }

    // 回复评论
    public function reply()
    {
        if (request()->isPost()) {

            if (\ebcms\Config::get('content.comment_able')) {

                if (session('?user_id')) {
                    if (\ebcms\Config::get('content.comment_verify')) {
                        // 验证验证码
                        $verify = new \org\Verify([]);
                        if (!$verify->check(input('verify'), 2)) {
                            $this->error('验证码错误！');
                        }
                    }
                } else {
                    if (!\ebcms\Config::get('content.comment_visitor')) {
                        $this->error('请登录！');
                    }
                    if (\ebcms\Config::get('content.comment_visitor_verify')) {
                        // 验证验证码
                        $verify = new \org\Verify([]);
                        if (!$verify->check(input('verify'), 2)) {
                            $this->error('验证码错误！');
                        }
                    }
                }

                $reply_id = input('reply_id');
                $m = new \app\content\model\Comment();
                $reply = $m->find($reply_id);
                $status = \ebcms\Config::get('content.comment_check') ? 99 : 1;
                $data = [
                    'uid' => session('?user_id') ? session('user_id') : 0,
                    'touid' => $reply['uid'],
                    'topid' => $reply['topid'] ?: $reply['id'],
                    'tid' => $reply['tid'],
                    'pid' => $reply['id'],
                    'content' => input('content'),
                    'status' => $status,
                ];
                $comment = \app\content\model\Comment::create($data);

                // 消息提醒
                $param = [
                    'mycomment' => $reply,
                    'comment' => $comment,
                ];
                $content = str_preg_parse(htmlspecialchars_decode(\ebcms\Config::get('user.notice_comment')), $param);
                $notice = [
                    'user_id' => $reply['uid'],
                    'content' => $content,
                ];
                \ebcms\Notice::add($notice);

                $this->success('评论成功！');

            } else {
                $this->error('评论已关闭！');
            }
        }
    }

    public function setSession(){
    	$page_type = input('page_type');
//     	\think\Session::clear();
    	session('page_type', $page_type);
    	echo json_encode(session('page_type'));exit;
    }
    
    /**
     * 发售列表
     */
    public function issueList(){
    	$date_ = input('date');
    	//若不传参数则默认为当天的日期
    	if(empty($date_)){
    		$date_ = date("Y-m");
    	}else{
    		$dateArray = explode('-',$date_);
    		if(strlen($dateArray[1])< 2){
    			$date_ = $dateArray[0].'-0'.$dateArray[1];
    		}
    	}
    	//发售列表分类ID
    	$id = '4';
    	$category = get_content_category($id);
    	if (1 != $category['status']) {
    		$this->error('栏目不存在！');
    	}
    	
    	if ($category['ebcms_url']) {
    		$this->redirect(htmlspecialchars_decode($category['ebcms_url']), 302);
    	}
    	// 0表示不缓存
    	$category['expire'] = $category['expire'] ? $category['expire'] : false;
    	$baseUrl = 'l7cms/'.$category['name'].'/';
//     	$lists = \app\content\model\Content::where(['category_id' => $id, 'status' => 1])->order($category['sell_time'])->cache($category['expire'])->paginate($category['pagenum'] ?: 20);
    	$lists = \app\content\model\Content::query("select id,title,thumb,description,ext,sell_time,sell_time_mm from ebcms5_content_content where status=1 and category_id = 4 and sell_time_mm = '".$date_."' order by sell_time desc");
    	$date = array();
    	foreach ($lists as $key=>$val){
    		$date[] = $val['sell_time'];
    	}
    	$key = 'sell_time';
    	$date = $this->assoc_unique($date);
    	$result = $this->issueListHand($date, $lists,$baseUrl);
    	$result['currentDate'] = $date_;
    	$result['isHave'] = !empty($lists);
// 		echo json_encode($result);exit;
    	$callback = $_GET['callback'];
    	echo $callback.'('.json_encode($result).')';exit;
    }
    
    /**
     * 列表处理
     * @param unknown $dateArray
     * @param unknown $issueList
     */
    function issueListHand($dateArray,$issueList,$baseUrl){
    	$result = array();
    	
    	//循环列表
    	foreach ($issueList as $key=>$val){
    		//循环日期
    		foreach ($dateArray as $dkey=>$dval){
    			if($val['sell_time'] == $dval){
    				$val['thumb'] = thumb($val['thumb']);
    				$val['url'] = $baseUrl.$val['id'].'.html';
    				$result['issueList'][$val['sell_time']][] = $val;
    			}
    		}
    	}
    	return $result;
    }
    
    /**
     * 去重
     * @param unknown $arr
     * @param unknown $key
     * @return unknown
     */
    function assoc_unique($arr)
    {
    	$tmp_arr = array();
    	foreach($arr as $k => $v)
    	{
    		if(in_array($v, $tmp_arr))//搜索$v[$key]是否在$tmp_arr数组中存在，若存在返回true
    		{
    			unset($arr[$k]);
    		}
    		else {
    			$tmp_arr[] = $v;
    		}
    	}
    	sort($arr); //sort函数对数组进行排序
    	return $arr;
    }
    
    public function list_data()
    {
    	$id = input('pid');
    	$tag = input('tag_id');
    	if ($category = get_content_category($id)) {
    		if (1 != $category['status']) {
    			$this->error('栏目不存在！');
    		}
    
    		if ($category['ebcms_url']) {
    			$this->redirect(htmlspecialchars_decode($category['ebcms_url']), 302);
    		}
    
    		$tag = new \app\content\model\Tag();
    		
    		// 0表示不缓存
    		$category['expire'] = $category['expire'] ? $category['expire'] : false;
    		$categorys = get_content_category();
    		switch ($category['datatype']) {
    
    			case 0:// 不获取
    				$page = '';
    				$lists = [];
    				break;
    			case 1: // 当前栏目
    				$lists = \app\content\model\Content::where(['category_id' => $id, 'status' => 1])->order($category['order'])->cache($category['expire'])->paginate($category['pagenum'] ?: 20);
    				$page = $lists->getPage();
    				break;
    			case 2: // 子栏目
    				$subids = \ebcms\Tree::subid($categorys, $category['id']);
    				$lists = \app\content\model\Content::where(['category_id' => ['in', $subids], 'status' => 1])->order($category['order'])->cache($category['expire'])->paginate($category['pagenum'] ?: 20);
    				$page = $lists->getPage();
    				break;
    			case 3: // 所有子级栏目
    				$subids = \ebcms\Tree::subtreeid($categorys, $category['id']);
    				$lists = \app\content\model\Content::where(['category_id' => ['in', $subids], 'status' => 1])->order($category['order'])->cache($category['expire'])->paginate($category['pagenum'] ?: 20);
    				$page = $lists->getPage();
    				break;
    			case 4: // 不限栏目
    				$subids = \ebcms\Tree::subtreeid($categorys, $category['id']);
    				$lists = \app\content\model\Content::where(['status' => 1])->order($category['order'])->cache($category['expire'])->paginate($category['pagenum'] ?: 20);
    				$page = $lists->getPage();
    				break;
    
    			default:
    				$page = '';
    				$lists = [];
    				break;
    		}
    		if (request()->isGet()) {
    			// 路径
    			$baseUrl = '/';
    			$result = array();
    			$data_list = $this->list_hand($lists,$categorys,$baseUrl);
    			$result['lists'] = $data_list;
    			$result['page'] = $page;
//     			echo json_encode($result);exit;
    			$callback = $_GET['callback'];
    			echo $callback.'('.json_encode($result).')';exit;
    		}
    	} else {
    		$this->error('栏目不存在');
    	}
    }
    
    /**
     * 标签列表
     */
    public function tagList(){
    	if (request()->isGet()) {
    		$category_id = input('category_id');
    		$tag = new \app\content\model\Tag();
    		$tag_list = $tag->query("select distinct ct.* from ebcms5_content_tag ct,ebcms5_content_tags cts where ct.id = cts.tag_id and cts.cc_id = '".$category_id."' order by ct.tag asc");
    	}
    	$result = array();
    	$baseUrl = '/l7cms/tag/';
    	foreach ($tag_list as $key=>$val){
    		$val['url'] = $baseUrl.$val['tag'].'.html';
    		$result[] = $val;
    	}
//     	echo json_encode($tag_list);exit;
    	$callback = $_GET['callback'];
    	echo $callback.'('.json_encode($result).')';exit;
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
    			$baseUrl = '/l7cms/';
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
     * 获取数据图片，以及跳转地址
     * @param unknown $data_list
     */
    private function list_hand($data_list,$categorys,$baseUrl,$tag_list){
    	$result = array();
    	foreach ($data_list as $key=>$val){
    		$temp['thumb'] = thumb($val['thumb'],0,0);
    		$temp['url'] = $baseUrl.$this->getUrlPath($categorys, $val['category_id']).'/'.$val['id'].'.html';
    		$temp['title'] = $val['title'];
    		$temp['description'] = $val['description'];
    		$temp['author'] = $val['author'];
    		$temp['create_time'] = $val['create_time'];
    		if(!empty($tag_list)){
	    		foreach ($tag_list as $tkey=>$tval){
	    			if($val['id'] == $tval['c_id']){
	    				$temp['tag'] = $tval['tag'];
	    				break;
	    			}
	    		}
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
}