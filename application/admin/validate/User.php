<?php
namespace app\admin\validate;

use think\Validate;

class User extends Validate
{

    protected $rule = [
        'email' => 'require|email',
        'nickname' => 'require|max:10',
        'motto' => 'max:255',
    ];

    protected $scene = [
        'add' => ['email', 'nickname', 'motto'],
        'edit' => ['email', 'nickname', 'motto'],
    ];
}