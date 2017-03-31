<?php
namespace app\admin\model;

use think\Model;

class Configcate extends Model
{

    protected $pk = 'id';
    protected $field = ['id', 'group', 'title', 'name', 'remark', 'update_time', 'create_time', 'sort', 'status', 'locked'];

    public function config()
    {
        return $this->hasMany('Config', 'category_id');
    }
}