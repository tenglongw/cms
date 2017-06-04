<?php
namespace app\admin\controller;
class User extends \app\admin\controller\Common
{

    public function index()
    {
        if (request()->isGet()) {
            $this->success('', '', $this->fetch());
        }
    }

    public function add()
    {
        if (request()->isGet()) {
            $this->fetchform();
        } elseif (request()->isPost()) {
            $this->ebadd();
        }
    }

    public function edit()
    {
        $config = ['allowfield' => ['nickname', 'email', 'motto', 'avatar']];
        if (input('id') == 1) {
            $config = ['allowfield' => ['nickname', 'motto', 'avatar']];
        }
        $this->ebedit($config);
    }

    public function delete()
    {
        if (request()->isPost()) {
            
            if (in_array(1, explode(',', input('ids')))) {
                $this -> error('超级管理员不允许删除！');
            }

            $config = [
                'relation' => [
                    'group' => [
                        'type' => 'manytomany',
                    ],
                    'comment' => [
                        'type' => 'hasmany',
                    ],
                ],
            ];
            $this->ebdelete($config);
        }
    }

    // 分配用户组
    public function group()
    {
        if (request()->isGet()) {
            $user_id = input('user_id');
            $this->success('获取成功', '', $this->fetch());
        } elseif (request()->isPost()) {
            $user_id = input('user_id');
            if (input('__type') == 'group') {
                // 获取该memeber下的用户组
                $checked = \think\Db::name('auth_access')->where('uid=' . $user_id)->column('group_id');
                $groups = \think\Db::name('auth_group')->select();
                $res = array(
                    'rows' => array_mark($groups, $checked, 'id', 'checked', true, false),
                );
                $this->success('', '', $res);
            } else {
                // 重新分配用户组
                // 移除老分组
                \think\Db::name('auth_access')->where(array('uid' => array('eq', $user_id)))->delete();
                // 重组新分组
                $group_ids = input('group_ids/a');
                if ($group_ids) {
                    $data = array();
                    foreach ($group_ids as $key => $value) {
                        $data[] = array(
                            'uid' => $user_id,
                            'group_id' => $value,
                        );
                    }
                    if (false !== \think\Db::name('auth_access')->insertAll($data)) {
                        $this->success('用户组分配成功！');
                    } else {
                        $this->error(\think\Db::name('auth_access')->getDbError());
                    }
                } else {
                    $this->success('用户组分配成功！');
                }
            }
        }
    }

    // 重置密码
    public function password()
    {
        if (request()->isGet()) {
            // $this->display();
        } elseif (request()->isPost()) {
            $id = input('id', '', 'intval');
            $m = \think\Db::name('user');
            // 判断并获取账户
            $id = input('id', '', 'intval');
            $_where = array(
                'id' => array('eq', $id),
            );
            if (!$data = $m->find($id)) {
                $this->error('你的邮箱输入有误，请确认是否正确！');
            }

            // 不允许超级管理员重置密码
            if ($data['email'] == config('super_admin')) {
                $this -> error('超级管理员不能被重置密码！若忘记密码请到官网下载密码找回工具！');
            }

            // 更新safe_code
            $safe_code = md5(rand());
            $m->where($_where)->setField('safe_code', $safe_code);

            // 发送连接到邮箱
            $pars = array(
                'code' => base64_encode(\ebcms\Crypt::encode($safe_code . '_' . $data['email'], config('safe_code'), 3600 * 24)),
            );
            $url = request()->domain() . url('index/auth/password', $pars);
            $str = str_preg_parse(htmlspecialchars_decode(\ebcms\Config::get('user.password_url')), array('url' => $url));
            if (sendmail($data['email'], '尊敬的用户', '找回密码', $str)) {
                $this->success('重置密码链接已发送到对方邮箱！', '', 5);
            } else {
                $this->error('邮件发送失败！请联系管理员！');
            }
        }
    }

    public function status()
    {
        if (in_array(1, explode(',', input('ids')))) {
            $this -> error('不允许对超级管理员进行该项操作！');
        }
        $this -> ebstatus();
    }

    public function lock()
    {
        if (in_array(1, explode(',', input('ids')))) {
            $this -> error('不允许对超级管理员进行该项操作！');
        }
        $this -> eblock();
    }

    // 显示用户信息
    public function info()
    {
        if (request()->isGet()) {
            if ($user = \app\admin\model\User::get(input('id'))) {
                $this->assign('user', $user);
                $this->success('', '', $this->fetch());
            } else {
                $this->error('用户不存在！');
            }
        } elseif (request()->isPost()) {
            $this->success('获取成功');
        }
    }

}