<?php
namespace app\content\model;

use think\Model;

class Hotword extends Model
{

    protected $name = 'content_hotword';
    protected $pk = 'id';
    protected $field = ['id', 'tag', 'count', 'update_time', 'create_time', 'sort', 'status', 'locked', 'color', 'size', 'bold','cc_id'];

    public function content()
    {
        return $this->belongsToMany('Content', \think\Config::get('database.prefix') . 'content_hotwords', 'c_id', 'tag_id');
    }

    public function getUrlAttr($value, $data)
    {
        return url('index/content/hotword', ['tag' => $data['tag']]);
    }

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
}