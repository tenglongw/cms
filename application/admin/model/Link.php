<?php
namespace app\admin\model;

use think\Model;

class Link extends Model
{

    protected $pk = 'id';
    protected $field = ['id' => 'int', 'group', 'title', 'description', 'info', 'logo', 'url', 'update_time', 'create_time', 'sort', 'status', 'locked'];
}