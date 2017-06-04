<?php
namespace app\admin\model;

use think\Model;

class Recommendcate extends Model
{

    protected $pk = 'id';
    protected $field = ['id', 'group', 'title', 'mark', 'extend_id', 'update_time', 'create_time', 'sort', 'status', 'locked'];

    public function Recommend()
    {
        return $this->hasMany('Recommend', 'category_id', 'id');
    }
}