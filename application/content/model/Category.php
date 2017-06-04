<?php
namespace app\content\model;

use think\Model;

class Category extends Model
{

    protected $name = 'content_category';
    protected $pk = 'id';
    protected $field = ['id', 'pid', 'name', 'title', 'metatitle', 'keywords', 'description', 'extend_id', 'pagenum', 'tpl', 'tpl_detail', 'ebcms_url', 'datatype', 'expire', 'order', 'ext', 'update_time', 'create_time', 'sort', 'status', 'locked'];

    protected $type = [
        'ext' => 'json',
    ];

    public function content()
    {
        return $this->hasMany('\app\content\model\Content', 'category_id', 'id');
    }

    public function extend()
    {
        return $this->belongsTo('\app\admin\model\Extend', 'extend_id', 'id', '', 'LEFT');
    }

    public function getMetatitleAttr($value, $data)
    {
        if (!$value) {
            return $data['title'];
        }
        return $value;
    }

    public function getUrlAttr($value, $data)
    {
        return url('index/content/index?id='.$data['id']);
    }

    public function getRecontentAttr($value, $data)
    {
        static $res;
        if ($res) {
            return $res;
        }
        $where = [
            'category_id' => ['eq', $data['id']],
            'sort' => ['eq', 1],
            'status' => ['eq', 1],
        ];
        $res = \app\content\model\Content::where($where)->limit(100)->order('id desc')->select();
        return $res;
    }

    public function getCountAttr($value, $data)
    {
        static $res;
        if (isset($res[$data['id']])) {
            return $res[$data['id']];
        }
        $where = [
            'category_id' => ['eq', $data['id']],
            'status' => ['eq', 1],
        ];
        return $res[$data['id']] = \app\content\model\Content::where($where)->count();
    }

}