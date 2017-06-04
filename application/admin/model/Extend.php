<?php
namespace app\admin\model;

use think\Model;

class Extend extends Model
{

    protected $pk = 'id';
    protected $field = ['id', 'group', 'title', 'remark', 'sort', 'update_time', 'create_time', 'status', 'locked', 'sys_mark'];

    public function extendfield()
    {
        return $this->hasMany('Extendfield', 'category_id');
    }
}