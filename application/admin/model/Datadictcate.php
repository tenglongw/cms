<?php
namespace app\admin\model;

use think\Model;

class Datadictcate extends Model
{

    protected $pk = 'id';
    protected $field = ['id', 'group', 'title', 'field', 'extend_id', 'remark', 'update_time', 'create_time', 'sort', 'status', 'locked', 'system'];

    public function datadict()
    {
        return $this->hasMany('Datadict', 'category_id', 'id');
    }
}