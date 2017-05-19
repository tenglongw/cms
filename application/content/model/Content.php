<?php
namespace app\content\model;

use think\Model;

class Content extends Model
{

    protected $name = 'content_content';
    protected $pk = 'id';
    protected $field = ['id', 'category_id', 'title', 'shorttitle', 'metatitle', 'keywords', 'description', 'thumb', 'tpl', 'ebcms_url', 'filename', 'ext', 'click', 'user_id', 'baidu', 'comment_able', 'update_time', 'create_time', 'sort', 'status', 'locked', 'color', 'size', 'bold','author','source','comment_count'];
    protected $type = [
        'ext' => 'json',
    ];

    // 关联
    public function body()
    {
        return $this->hasOne('Body', 'id', 'id');
    }

    public function category()
    {
        return $this->belongsTo('Category', 'category_id');
    }

    public function comment()
    {
        return $this->hasMany('Comment', 'tid', 'id');
    }

    public function tag()
    {
        return $this->belongsToMany('Tag', \think\Config::get('database.prefix') . 'content_tags', 'tag_id', 'c_id');
    }

    // 设置简介
    public function setDescriptionAttr($value, $data)
    {
        if (!$value) {
            $input = input();
            return mb_substr(str_replace([' ', '&nbsp;', '　', "\r\n", "\t"], '', strip_tags(htmlspecialchars_decode($input['body']['body']))), 0, 200);
        } else {
            return $value;
        }
    }

    // 设置META标题
    public function setMetatitleAttr($value, $data)
    {
        if ($value && $value != $data['title']) {
            return $value;
        } else {
            return '';
        }
    }

    // 设置短标题
    public function setShorttitleAttr($value, $data)
    {
        if ($value && $value != $data['title']) {
            return $value;
        } else {
            return '';
        }
    }

    // 设置缩略图
    public function setThumbAttr($value, $data)
    {
    	if (!$value && !empty($value)) {
            $pattern = "/<[img|IMG].*?src=[\'|\"]" . preg_quote(get_root(true) . '/upload', '/') . "(.*?(?:[\.gif|\.jpg]))[\'|\"].*?[\/]?>/";
            if (preg_match($pattern, htmlspecialchars_decode($data['body']['body']), $match)) {
                if ($pos = strpos($match[1], '!')) {
                    return mb_substr($match[1], 0, $pos);
                } else {
                    return $match[1];
                }
            }
            return '';
        } else {
            return $value;
        }
    }

    // 获取META标题
    public function getMetatitleAttr($value, $data)
    {
        if (!$value) {
            return $data['title'];
        }
        return $value;
    }

    // 获取短标题
    public function getShorttitleAttr($value, $data)
    {
        if (!$value) {
            return $data['title'];
        }
        return $value;
    }

    // 获取样式
    public function getStyleAttr($value, $data)
    {
        $str = '';
        if ($data['color']) {
            $str .= 'color:' . $data['color'] . ';';
        }
        if ($data['bold']) {
            $str .= 'font-weight:' . $data['bold'] . ';';
        }
        if ($data['size']) {
            $str .= 'font-size:' . $data['size'] . 'px;';
        }
        return $str;
    }

    // 获取栏目（缓存）
    public function getCateAttr($value, $data)
    {
        return get_content_category($data['category_id']);
    }

    // 获取链接
    public function getUrlAttr($value, $data)
    {
        static $res;
        if (isset($res[$data['id']])) {
            return $res[$data['id']];
        }
        $url_model = \ebcms\Config::get('system.url_model');
        if ($url_model == 2) {
            if ($data['filename'] && is_string($data['filename'])) {
                return $res[$data['id']] = url('index/content/detail?category_id=' . $data['category_id'], ['filename' => $data['filename']]);
            } else {
                return $res[$data['id']] = url('index/content/detail?category_id=' . $data['category_id'], ['id' => $data['id']]);
            }
        } else if ($url_model == 1) {
            if ($data['filename'] && is_string($data['filename'])) {
                return $res[$data['id']] = url('index/content/detail', ['filename' => $data['filename']]);
            } else {
                return $res[$data['id']] = url('index/content/detail', ['id' => $data['id']]);
            }
        } else {
            return $res[$data['id']] = url('index/content/detail', ['id' => $data['id']]);
        }
    }

    // 获取上一篇
    public function getPrevAttr($value, $data)
    {
        static $res = [];
        if (isset($res[$data['id']])) {
            return $res[$data['id']];
        }
        $where = [
            'id' => ['gt', $data['id']],
            'category_id' => ['eq', $data['category_id']],
            'status' => ['eq', 1]
        ];
        return $res[$data['id']] = \app\content\model\Content::where($where)->find() ?: [];
    }

    // 获取下一篇
    public function getNextAttr($value, $data)
    {
        static $res = [];
        if (isset($res[$data['id']])) {
            return $res[$data['id']];
        }
        $where = [
            'id' => ['lt', $data['id']],
            'category_id' => ['eq', $data['category_id']],
            'status' => ['eq', 1]
        ];
        return $res[$data['id']] = \app\content\model\Content::where($where)->order('id desc')->find() ?: [];
    }

    // 获取相关文章
    public function getRelationAttr($value, $data)
    {
        static $res;
        if ($res) {
            return $res;
        }
        $where = [
            'c_id' => ['eq', $data['id']],
        ];
        $tag_ids = \think\Db::name('content_tags')->where($where)->limit(20)->column('tag_id');
        if ($tag_ids) {
            $where = [
                'tag_id' => array('in', array_unique($tag_ids)),
                'c_id' => array('neq', $data['id']),
            ];
            $c_ids = \think\Db::name('content_tags')->where($where)->order('c_id desc')->limit(20)->column('c_id');
            if ($c_ids) {
                $where = [
                    'content.id' => ['in', $c_ids],
                    'content.status' => ['eq', 1],
                    'category.status' => ['eq', 1],
                    'category.extend_id' => ['eq', $data['category']['extend_id']],
                ];
                return $res = \app\content\model\Content::with('category')->where($where)->limit(20)->order('content.id desc')->select();
            }
        }
        return [];
    }

    // 获取推荐评论
    public function getRecommentAttr($value, $data)
    {
        static $res;
        if ($res) {
            return $res;
        }
        $where = [
            'comment.tid' => ['eq', $data['id']],
            'comment.sort' => ['eq', 1],
            'comment.status' => ['eq', 1],
        ];
        $res = \app\content\model\Comment::with('user,touser')->where($where)->limit(100)->select();
        return $res;
    }

}