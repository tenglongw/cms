<?php
namespace app\index\controller;
require_once(QQ_CLASS_PATH."API/class/QC.class.php");
class Content extends \app\index\controller\Common
{

    public function index($id)
    {
        if ($category = get_content_category($id)) {
            if (1 != $category['status']) {
                $this->error('栏目不存在！');
            }

            if ($category['ebcms_url']) {
                $this->redirect(htmlspecialchars_decode($category['ebcms_url']), 302);
            }

            // 0表示不缓存
            $category['expire'] = $category['expire'] ? $category['expire'] : false;
            $categorys = get_content_category();
            switch ($category['datatype']) {

                case 0:// 不获取
                    $page = '';
                    $lists = [];
                    break;

                case 1: // 当前栏目
                	if($category['tpl'] == 'video_list' || $category['tpl'] == 'special_list'){
                		$lists = \app\content\model\Content::where(['category_id' => $id, 'status' => 1])->order($category['order'])->cache($category['expire'])->paginate2($category['pagenum'] ?: 20);
                	}else{
	                    $lists = \app\content\model\Content::where(['category_id' => $id, 'status' => 1])->order($category['order'])->cache($category['expire'])->paginate($category['pagenum'] ?: 20);
                	}
                    $page = $lists->render();
                    break;
                case 2: // 子栏目
                    $subids = \ebcms\Tree::subid($categorys, $category['id']);
                    if($category['tpl'] == 'video_list' || $category['tpl'] == 'special_list'){
                    	$lists = \app\content\model\Content::where(['category_id' => ['in', $subids], 'status' => 1])->order($category['order'])->cache($category['expire'])->paginate2($category['pagenum'] ?: 20);
                    }else{
	                    $lists = \app\content\model\Content::where(['category_id' => ['in', $subids], 'status' => 1])->order($category['order'])->cache($category['expire'])->paginate($category['pagenum'] ?: 20);
                    }
                    $page = $lists->render();
                    break;
                case 3: // 所有子级栏目
                    $subids = \ebcms\Tree::subtreeid($categorys, $category['id']);
                    if($category['tpl'] == 'video_list' || $category['tpl'] == 'special_list'){
	                    $lists = \app\content\model\Content::where(['category_id' => ['in', $subids], 'status' => 1])->order($category['order'])->cache($category['expire'])->paginate2($category['pagenum'] ?: 20);
                    }else{
                    	$lists = \app\content\model\Content::where(['category_id' => ['in', $subids], 'status' => 1])->order($category['order'])->cache($category['expire'])->paginate($category['pagenum'] ?: 20);
                    }
                    $page = $lists->render();
                    break;
                case 4: // 不限栏目
                    $subids = \ebcms\Tree::subtreeid($categorys, $category['id']);
                    if($category['tpl'] == 'video_list' || $category['tpl'] == 'special_list'){
                    	$lists = \app\content\model\Content::where(['status' => 1])->order($category['order'])->cache($category['expire'])->paginate2($category['pagenum'] ?: 20);                    	
                    }else{
	                    $lists = \app\content\model\Content::where(['status' => 1])->order($category['order'])->cache($category['expire'])->paginate($category['pagenum'] ?: 20);
                    }
                    $page = $lists->render();
                    break;

                default:
                    $page = '';
                    $lists = [];
                    break;
            }
            if (request()->isGet()) {
                // 路径
                $categorys = get_content_category('all');
                $pdatas = \ebcms\Tree::parent_data($categorys, $id);
                config('topcateid',$pdatas?$pdatas[0]['id']:$category['id']);
                foreach ($pdatas as $value) {
                    \ebcms\Position::add(['title' => $value['title'], 'url' => $value['url']]);
                }
                \ebcms\Position::add(['title' => $category['title'], 'url' => $category['url']]);
                // seo设置
                $this->assign('seo', [
                    'title' => $category['metatitle'] . ' - ' . $this->seo['sitename'],
                    'keywords' => $category['keywords'],
                    'description' => $category['description'],
                ]);
                $tag = new \app\content\model\Tag();
                $tag_list = $tag->query("select ct.tag,cts.c_id from ebcms5_content_tag ct,ebcms5_content_tags cts where ct.id = cts.tag_id");
                $this->assign('tag_list', $tag_list);
                $this->assign('category', $category);
                $this->assign('page', $page);
                $this->assign('lists', $lists);
                return $this->fetch($category['tpl']);
            } elseif (request()->isPost()) {
                return [
                    'seo' => [
                        'title' => $category['metatitle'] . ' - ' . $this->seo['sitename'],
                        'keywords' => $category['keywords'],
                        'description' => $category['description'],
                    ],
                    'category' => $category,
                    'lists' => $lists
                ];
            }
        } else {
            $this->error('栏目不存在');
        }
    }

    public function detail()
    {
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

            if ($content['ebcms_url']) {
                $this->redirect(htmlspecialchars_decode($content['ebcms_url']), 302);
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
//                 if(!request()->isMobile()){
	                $this->assign('category', $category);
	                $this->assign('type', 'content');
//                 }
                
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

    public function search()
    {
        if (request()->isGet()) {
            $q = input('q');
            $category = input('category');
            \ebcms\Position::add(['title' => '搜索', 'url' => url('index/content/search')]);
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
                $lists = \app\content\model\Content::where($where)->order('id desc')->cache($cache)->paginate2(20, false, [
                    'query' => ['q' => $q],
                ]);
                $count =  \app\content\model\Content::where($where)->count();
                
                $tag = new \app\content\model\Tag();
                $tag_list = $tag->query("select ct.tag,cts.c_id from ebcms5_content_tag ct,ebcms5_content_tags cts where ct.id = cts.tag_id");
                $this->assign('tag_list', $tag_list);
                
                $this->assign('page', $lists->render());
                $this->assign('lists', $lists);
                $this->assign('total', $count);
                // seo设置
                $this->assign('seo', [
                    'title' => '搜索：' . $q . ' - ' . $this->seo['sitename'],
                    'keywords' => $q,
                    'description' => $q,
                ]);
            } else {
                // seo设置
                $this->assign('seo', [
                    'title' => '搜索 - ' . $this->seo['sitename'],
                    'keywords' => '搜索',
                    'description' => '搜索',
                ]);
            }
            $this->assign('q', $q);
            $this->assign('category', $category);
            return $this->fetch();
        }
    }

    public function tag()
    {
        if (request()->isGet()) {
            if ($tag = input('tag')) {
                // 查看详细标签
                if ($data = \app\content\model\Tag::where('tag', $tag)->find()) {

                    if (!$data['status']) {
                        $this->error('标签不存在！');
                    }

                    $lists = \think\Db::name('content_tags')->where('tag_id', $data['id'])->order('c_id desc')->paginate(20);
                    $this->assign('page', $lists->render());
                    $datas = $lists->toArray();
                    $ids = [];
                    $cc_ids = [];
                    foreach ($datas['data'] as $value) {
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
                        $this->assign('lists', \app\content\model\Content::where($where)->order('id desc') ->select());
                    } else {
                        $this->assign('lists', []);
                    }
                    
//                     $tag = new \app\content\model\Tag();
//                     $tag_list = $tag->query("select * from ebcms5_content_tag ct,ebcms5_content_tags cts where ct.id = cts.tag_id and cts.cc_id = '".$cc_ids[0]."'");
                    $this->assign('category_id', $cc_ids[0]);
                    
                    $this->assign('tag', $data);
                    // position设置
                    \ebcms\Position::add(['title' => '标签', 'url' => url('index/content/tag')]);
                    \ebcms\Position::add(['title' => $tag, 'url' => url('index/content/tag', ['tag' => $tag])]);

                    // seo设置
                    $this->assign('seo', [
                        'title' => '标签：' . $tag . ' - ' . $this->seo['sitename'],
                        'keywords' => $tag,
                        'description' => $tag,
                    ]);

                    return $this->fetch();
                } else {
                    $this->error('tag不存在！');
                }
            } else {
                // 显示所有标签
                $tag = new \app\content\model\Tag();
                $lists = $tag->order('sort desc,count desc,id desc')->select();
                $this->assign('lists', $lists);
                // position设置
                \ebcms\Position::add(['title' => '标签', 'url' => url('index/content/tag')]);

                // seo设置
                $this->assign('seo', [
                    'title' => '标签 - ' . $this->seo['sitename'],
                    'keywords' => '标签',
                    'description' => '标签',
                ]);

                return $this->fetch();
            }
        }
    }
    
    /**
     * 获得所有标签
     */
    public function getTag()
    {
    	if (request()->isGet()) {
    		if ($tag = input('tag')) {
    			// 查看详细标签
    			if ($data = \app\content\model\Tag::where('tag', $tag)->find()) {
    
    				if (!$data['status']) {
    					$this->error('标签不存在！');
    				}
    
    				$lists = \think\Db::name('content_tags')->where('tag_id', $data['id'])->paginate(20);
    				$this->assign('page', $lists->render());
    				$datas = $lists->toArray();
    				$ids = [];
    				foreach ($datas['data'] as $value) {
    					$ids[] = $value['c_id'];
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
    
    					$this->assign('lists', \app\content\model\Content::where($where)->order('id desc') ->select());
    				} else {
    					$this->assign('lists', []);
    				}
    				$this->assign('tag', $data);
    
    				// position设置
    				\ebcms\Position::add(['title' => '标签', 'url' => url('index/content/tag')]);
    				\ebcms\Position::add(['title' => $tag, 'url' => url('index/content/tag', ['tag' => $tag])]);
    
    				// seo设置
    				$this->assign('seo', [
    						'title' => '标签：' . $tag . ' - ' . $this->seo['sitename'],
    						'keywords' => $tag,
    						'description' => $tag,
    				]);
    
    				return $this->fetch();
    			} else {
    				$this->error('tag不存在！');
    			}
    		} else {
    			// 显示所有标签
    			$tag = new \app\content\model\Tag();
    			$lists = $tag->order('sort desc,count desc,id desc')->select();
    			$this->assign('lists', $lists);
    
    			// position设置
    			\ebcms\Position::add(['title' => '标签', 'url' => url('index/content/tag')]);
    
    			// seo设置
    			$this->assign('seo', [
    					'title' => '标签 - ' . $this->seo['sitename'],
    					'keywords' => '标签',
    					'description' => '标签',
    			]);
    
    			return $this->fetch();
    		}
    	}
    }

}