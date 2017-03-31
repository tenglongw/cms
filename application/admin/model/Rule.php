<?php
namespace app\admin\model;

use think\Model;

class Rule extends Model
{

    protected $name = 'auth_rule';
    protected $pk = 'id';
    protected $field = ['id', 'pid', 'group', 'opstr', 'name', 'title', 'type', 'status', 'condition', 'sort', 'locked', 'create_time', 'update_time'];
}