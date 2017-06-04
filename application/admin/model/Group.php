<?php
namespace app\admin\model;

use think\Model;

class Group extends Model
{

    protected $name = 'auth_group';
    protected $pk = 'id';
    protected $field = ['id', 'pid', 'group', 'description', 'title', 'status', 'rules', 'c_rules', 'menus', 'sort', 'locked', 'create_time', 'update_time'];

    public function user()
    {
        return $this->belongsToMany('User', \think\Config::get('database.prefix') . 'auth_access', 'uid', 'group_id');
    }

}