<?php
namespace app\admin\model;

use think\Model;

class Single extends Model
{

    protected $name = 'single';
    protected $pk = 'id';
    protected $field = ['id', 'group', 'path', 'ebcms_url', 'title', 'shorttitle', 'metatitle', 'keywords', 'description', 'thumb', 'tpl', 'body', 'ext', 'click', 'update_time', 'create_time', 'sort', 'status', 'locked'];
    protected $type = [
        'ext' => 'json',
    ];

    public function setDescriptionAttr($value, $data)
    {
        if (!$value) {
            return mb_substr(str_replace([' ', '&nbsp;', '　', "\r\n", "\t"], '', strip_tags(htmlspecialchars_decode($data['body']))), 0, 200);
        } else {
            return $value;
        }
    }

    public function setPathAttr($value, $data)
    {
        if (!$value) {
            return '';
        } elseif (0 !== strpos($value, '/')) {
            return '/' . $value;
        } else {
            return $value;
        }
    }

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

    public function setMetatitleAttr($value, $data)
    {
        if ($value && $value != $data['title']) {
            return $value;
        } else {
            return '';
        }
    }

    public function setShorttitleAttr($value, $data)
    {
        if ($value && $value != $data['title']) {
            return $value;
        } else {
            return '';
        }
    }

    // 获取器
    public function getUrlAttr($value, $data)
    {
        return url('index/single/index?id=' . $data['id']);
    }

    // 获取meta标题
    public function getMetatitleAttr($value, $data)
    {
        if (!$value) {
            return $data['title'];
        }
        return $value;
    }

    // 获取short标题
    public function getShorttitleAttr($value, $data)
    {
        if (!$value) {
            return $data['title'];
        }
        return $value;
    }

}