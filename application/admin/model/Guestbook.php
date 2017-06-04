<?php
namespace app\admin\model;

use think\Model;

class Guestbook extends Model
{

    protected $pk = 'id';
    protected $field = ['id', 'nickname', 'mobile', 'content', 'reply', 'create_time', 'update_time', 'sort', 'status', 'locked', 'ip'];
}