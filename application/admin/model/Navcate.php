<?php
namespace app\admin\model;

use think\Model;

class Navcate extends Model
{

    protected $pk = 'id';
    protected $field = ['id', 'mark', 'title', 'extend_id', 'update_time', 'create_time', 'sort', 'status', 'locked'];

    public function nav()
    {
        return $this->hasMany('\app\admin\model\Nav', 'category_id', 'id');
    }
}