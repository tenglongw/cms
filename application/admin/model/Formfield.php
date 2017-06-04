<?php
namespace app\admin\model;

use think\Model;

class Formfield extends Model
{

    protected $pk = 'id';
    protected $field = ['id', 'category_id', 'group', 'title', 'subtable', 'extfield', 'name', 'defaultvaluetype', 'defaultvalue', 'type', 'config', 'remark', 'sort', 'update_time', 'create_time', 'status', 'locked', 'sys_mark'];
    protected $type = [
        'config' => 'json',
    ];

    public function form()
    {
        return $this->belongsTo('Form');
    }
}