<?php
namespace app\admin\model;

use think\Model;

class User extends Model
{

    protected $pk = 'id';
    protected $field = ['id', 'email', 'nickname', 'avatar', 'motto', 'password', 'login_times', 'login_ip', 'jifen', 'jinbi', 'login_time', 'salt', 'safe_code', 'update_time', 'create_time', 'sort', 'status', 'locked', 'ext'];
    protected $type = [
        'ext' => 'json',
    ];

    public function group()
    {
        return $this->belongsToMany('Group', \think\Config::get('database.prefix') . 'auth_access', 'group_id', 'uid');
    }

    public function comment()
    {
        return $this->hasMany('\\app\\content\\model\\Comment', 'uid', 'id');
    }

    public function setEmailAttr($value)
    {
        return strtolower($value);
    }

    public function setPasswordAttr($value, $data)
    {
        if ($value) {
            return crypt_pwd($value, $data['email'] . ' love ebcms forever!');
        }
    }

    public function setSaltAttr($value, $data)
    {
        if ($data['password']) {
            return $data['email'] . ' love ebcms forever!';
        }
    }

    public function getSpaceAttr($value, $data)
    {
        return url('index/space/index?id=' . $data['id']);
    }

    public function getNoticeAttr($value, $data)
    {
        $where = [
            'user_id' => session('user_id'),
            'isread' => 0,
            'status' => 1,
        ];
        return \think\Db::name('user_notice')->where($where)->count();
    }

}