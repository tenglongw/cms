<?php
namespace app\admin\model;

use think\Model;

class Form extends Model
{

    protected $pk = 'id';
    protected $field = ['id', 'group', 'title', 'name', 'remark', 'sort', 'update_time', 'create_time', 'status', 'locked', 'ext'];
    protected $type = [
        'ext' => 'json',
    ];

    public function formfield()
    {
        return $this->hasMany('Formfield', 'category_id');
    }
}