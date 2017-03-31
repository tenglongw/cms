<?php
namespace app\bulletin\model;

use think\Model;

class Bulletin extends Model
{

    protected $pk = 'id';
    protected $field = ['id', 'title', 'shorttitle', 'metatitle', 'keywords', 'description', 'thumb', 'tpl', 'body', 'ext', 'ebcms_url', 'click', 'update_time', 'create_time', 'sort', 'status', 'locked', 'color', 'size', 'bold'];
    protected $type = [
        'ext' => 'json',
    ];

    // 设置简介
    public function setDescriptionAttr($value, $data)
    {
        if (!$value) {
            $input = input();
            return mb_substr(str_replace([' ', '&nbsp;', '　', "\r\n", "\t"], '', strip_tags(htmlspecialchars_decode($input['body']))), 0, 200);
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
        if (!$value) {
            $pattern = "/<[img|IMG].*?src=[\'|\"]" . preg_quote(get_root(true) . '/upload', '/') . "(.*?(?:[\.gif|\.jpg]))[\'|\"].*?[\/]?>/";
            if (preg_match($pattern, htmlspecialchars_decode($data['body']), $match)) {
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

    // 获取链接
    public function getUrlAttr($value, $data)
    {
        static $res;
        if (isset($res[$data['id']])) {
            return $res[$data['id']];
        }
        return $res[$data['id']] = url('index/bulletin/detail', ['id' => $data['id']]);
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
            'status' => ['eq', 1]
        ];
        return $res[$data['id']] = \app\bulletin\model\Bulletin::where($where)->find() ?: [];
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
            'status' => ['eq', 1]
        ];
        return $res[$data['id']] = \app\bulletin\model\Bulletin::where($where)->order('id desc')->find() ?: [];
    }
}