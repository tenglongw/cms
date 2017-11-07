<?php
namespace app\admin\controller;

use think\Controller;

class Auth extends Controller
{

    // 登录
    public function login()
    {

        session('?abc');
//         if (!isset($_SESSION['login_auth'])) {
//             $this->redirect('index/index/index');
//         }

        // 登陆页面
        if (request()->isGet()) {
            $this->assign('seo', [
                'title' => '欢迎登陆易贝内容管理系统',
                'keywords' => '欢迎登陆易贝内容管理系统',
                'description' => '欢迎登陆易贝内容管理系统',
            ]);
            return $this->fetch();
        } elseif (request()->isPost()) {
//             // 验证验证码
//             $verify = new \org\Verify([]);
//             if (!$verify->check(input('verify'), 1)) {
//                 $this->error('验证码错误！', '', 'verify');
//             }
            // 读取该账户
            $where = array(
                'email' => input('email'),
            );
            $m = new \app\admin\model\User();
            if ($user = $m->where($where)->find()) {
                // 判断账户状态
                if ($user['status'] != 1) {
                    $this->error('账户未通过审核！');
                }

                // 判断密码是否正确
                if ($user['password'] !== crypt_pwd(input('password'), $user['salt'])) {
                    $this->error('密码不匹配！');
                }

                // 更新数据库
                $data = array(
                    'login_ip' => request()->ip(),
                    'login_time' => time(),
                    'id' => $user['id'],
                    'login_times' => $user['login_times'] + 1
                );
                $user->save($data);
                unset($_SESSION['login_auth']);
                // 清空session
                \think\Session::clear();
                // 超级管理员识别
                if ($user['email'] == config('super_admin')) {
                    session('super_admin', true);
                }
                // 写入新session
                session('user_id', $user['id']);
                session('user_email', $user['email']);
                session('user_nickname', $user['nickname']);
                session('user_avatar', $user['avatar']);
                session('user_notice', $user['notice']);
                session('admin_auth', 1);
                unset($_SESSION['login_auth']);
                $this->success('登陆成功!', url('admin/index/index'));
            } else {
                $this->error('信息错误，请重新输入！');
            }

        }
    }

    // 退出
    public function logout()
    {
        if (request()->isGet()) {
            \think\Session::clear();
            $this->success('退出成功');
        }
    }

}