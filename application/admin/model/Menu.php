<?php
namespace app\admin\model;

use think\Model;

class Menu extends Model
{

    protected $pk = 'id';
    protected $field = ['id', 'pid', 'type', 'title', 'url', 'iconcls', 'update_time', 'create_time', 'sort', 'status', 'locked', 'sys_mark'];

}