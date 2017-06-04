<?php
namespace app\content\model;

use think\Model;

class Body extends Model
{

    protected $name = 'content_body';
    protected $pk = 'id';
    protected $field = ['id', 'body'];

    // 关闭自动时间写入
    protected $autoWriteTimestamp = false;

    public function content()
    {
        return $this->belongsTo('Content', 'id', 'id');
    }
}