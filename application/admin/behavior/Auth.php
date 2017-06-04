<?php
namespace app\admin\behavior;

class Auth
{
    use \traits\controller\Jump;

    public function run(&$params)
    {
        $config = [
            'AUTH_GROUP' => config('database.prefix') . 'auth_group', // 用户组数据表名
            'AUTH_ACCESS' => config('database.prefix') . 'auth_access', // 用户-用户组关系表
            'AUTH_RULE' => config('database.prefix') . 'auth_rule', // 权限规则表
            'AUTH_USER' => config('database.prefix') . 'user', // 用户信息表
            'AUTH_ON' => \ebcms\Config::get('system.auth_on'), // 用户信息表
            'AUTH_TYPE' => \ebcms\Config::get('system.auth_type'), // 用户信息表
        ];
        $auth = new \ebcms\Auth($config);
        if (!session('?super_admin') || !session('super_admin')) {
            $node = request()->module() . '_' . request()->controller() . '_' . request()->action();
            if (!$auth->check($node, session('user_id'))) {
                $this->error('没有权限！');
            }
        }
    }
}