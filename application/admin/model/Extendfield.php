<?php
namespace app\admin\model;

use think\Model;

class Extendfield extends Model
{

    protected $pk = 'id';
    protected $field = ['id', 'category_id', 'group', 'title', 'name', 'value', 'type', 'config', 'remark', 'sort', 'update_time', 'create_time', 'status', 'locked', 'sys_mark'];
    protected $type = [
        'config' => 'json',
    ];

    public function extend()
    {
        return $this->belongsTo('Extend');
    }
}