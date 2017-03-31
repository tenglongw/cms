<?php
namespace app\index\controller;
class User extends \app\index\controller\Common
{

    public function _initialize()
    {
        parent::_initialize();
        if (!session('?user_id')) {
            session('go', url('index/user/index'));
            $this->redirect('index/auth/login');
        }
    }

    // 会员中心
    public function index()
    {
        if (request()->isGet()) {

            // 位置
            \ebcms\Position::add(['title' => '会员中心', 'url' => url('index/user/index')]);

            // seo设置
            $this->assign('seo', [
                'title' => '会员中心 - ' . $this->seo['sitename'],
                'keywords' => '会员中心',
                'description' => '会员中心',
            ]);

            return $this->fetch();
        }
    }

    // 修改信息
    public function info()
    {
        if (request()->isGet()) {

            // 位置
            \ebcms\Position::add(['title' => '会员中心', 'url' => url('index/user/index')]);
            \ebcms\Position::add(['title' => '修改基本信息', 'url' => url('index/user/info')]);

            // seo设置
            $this->assign('seo', [
                'title' => '修改基本信息 - 会员中心 - ' . $this->seo['sitename'],
                'keywords' => '修改基本信息',
                'description' => '修改基本信息',
            ]);

            $this->assign('user', \app\admin\model\User::find(session('user_id')));
            return $this->fetch();
        } elseif (request()->isPost()) {
            // 验证码判断
            if (\ebcms\Config::get('user.info_verify')) {
                $verify = new \org\Verify([]);
                if (!$verify->check(input('verify'), 1)) {
                    $this->error('验证码错误！');
                }
            }


            $m = new \app\admin\model\User();
            $data = input();
            $data['id'] = session('user_id');

            // 上传动作
            if ($file = request()->file('avatar')) {
                $info = $file->move('./upload/avatar');
                if (false === $info) {
                    $this->error('上传失败！');
                } else {
                    $avatar = substr(str_replace('\\', '/', $info->getPath() . '/' . $info->getBasename()), strlen('./upload'));
                    $data['avatar'] = $avatar;
                }
            } else {
                unset($data['avatar']);
            }

            if ($m->allowField(['nickname', 'avatar', 'motto'])->save($data, ['id' => session('user_id')])) {
                if (isset($avatar)) {
                    session('user_avatar', $avatar);
                }
                $this->success('修改成功', url('index/user/index'));
            } else {
                $this->error('修改失败！');
            }
        }
    }

    // 修改密码
    public function password()
    {
        if (request()->isGet()) {

            // 位置
            \ebcms\Position::add(['title' => '会员中心', 'url' => url('index/user/index')]);
            \ebcms\Position::add(['title' => '修改密码', 'url' => url('index/user/password')]);

            // seo设置
            $this->assign('seo', [
                'title' => '修改密码 - 会员中心 - ' . $this->seo['sitename'],
                'keywords' => '修改密码',
                'description' => '修改密码',
            ]);

            return $this->fetch();
        } elseif (request()->isPost()) {

            // 验证码判断
            if (\ebcms\Config::get('user.password_verifys')) {
                $verify = new \org\Verify([]);
                if (!$verify->check(input('verify'), 1)) {
                    $this->error('验证码错误！');
                }
            }

            $oldpassword = input('oldpassword');
            $password = input('password');
            $password2 = input('password2');
            if ($password2 != $password) {
                $this->error('两次密码输入不一致');
            }
            $id = session('user_id');
            $m = \think\Db::name('user');
            if (crypt_pwd($oldpassword) == $m->where('id=' . $id)->value('password')) {
                if (false !== $m->where('id=' . $id)->setField('password', crypt_pwd($password))) {
                    $this->success('密码修改成功', url('index/user/index'));
                } else {
                    $this->error($m->getDbError());
                }
            } else {
                $this->error('密码错误');
            }
        }
    }

    // 通知
    public function notice()
    {
        if (request()->isGet()) {
            $where = [
                'user_id' => session('user_id'),
            ];
            if (input('isread', 0, 'intval')) {
                $where['isread'] = 1;
            } else {
                $where['isread'] = 0;
            }
            $where['status'] = 1;
            $lists = \app\admin\model\Notice::where($where)->order('id desc')->paginate(20);
            $this->assign('page', $lists->render());
            $this->assign('lists', $lists);

            // 位置
            \ebcms\Position::add(['title' => '会员中心', 'url' => url('index/user/index')]);
            \ebcms\Position::add(['title' => '我的消息', 'url' => url('index/user/notice')]);

            // seo设置
            $this->assign('seo', [
                'title' => '我的消息 - 会员中心 - ' . $this->seo['sitename'],
                'keywords' => '我的消息',
                'description' => '我的消息',
            ]);

            return $this->fetch();
        } elseif (request()->isPost()) {
            $ids = input('ids/a');
            $isread = input('isread', 1, 'intval') ? 1 : 0;
            $where = [
                'user_id' => session('user_id'),
                'id' => ['in', $ids],
            ];
            \think\Db::name('user_notice')->where($where)->setField('isread', $isread);
            $this->success('更新成功！');
        }
    }

}