<?php
namespace app\admin\model;

use think\Model;

class Tongji extends Model
{

    protected $pk = 'id';
    protected $field = ['id' => 'int', 'user_id', 'title', 'url', 'create_time', 'ip'];
    protected $type = [
        'request' => 'serialize',
    ];
    protected $updateTime = false;

    public function user()
    {
        return $this->belongsTo('\app\admin\model\User', 'user_id', 'id', '', 'LEFT');
    }

    public function getCreateTimeAttr($value, $data)
    {
        return date('Y-m-d H:i:s', $value);
    }

}