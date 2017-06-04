<?php
namespace app\admin\model;

use think\Model;

class Oplog extends Model
{

    protected $pk = 'id';
    protected $field = ['id', 'user_id', 'title', 'url', 'ids', 'request', 'create_time', 'status'];
    protected $type = [
        'request' => 'serialize',
    ];

    public function user()
    {
        return $this->belongsTo('\app\admin\model\User', 'user_id', 'id', '', 'LEFT');
    }

    public function getCreateTimeAttr($value, $data)
    {
        return date('Y-m-d H:i:s', $value);
    }

}