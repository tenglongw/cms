<?php
namespace app\admin\model;

use think\Model;

class Notice extends Model
{

    protected $name = 'user_notice';
    protected $pk = 'id';
    protected $field = ['id', 'user_id', 'content', 'isread', 'create_time', 'update_time', 'sort', 'status', 'locked'];

}