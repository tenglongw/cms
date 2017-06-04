<?php
namespace app\admin\controller;
class Group extends \app\admin\controller\Common
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
        $this->ebedit();
    }

    public function delete()
    {
        if (request()->isPost()) {
            $config = [
                'relation' => [
                    'user' => [
                        'type' => 'manytomany',
                    ],
                ],
            ];
            $this->ebdelete($config);
        }
    }

    public function rule()
    {
        if (request()->isGet()) {
            $this->success('', '', $this->fetch());
        } elseif (request()->isPost()) {
            $group_id = input('group_id');
            if (input('__type') == 'rule') {
                // 获取该分组下的规则
                $checked = \think\Db::name('auth_group')->where(array('id' => array('eq', $group_id)))->value('rules');
                $checked = explode(',', $checked);
                $rules = \think\Db::name('auth_rule')->select();
                $res = array(
                    'rows' => array_mark($rules, $checked, 'id', 'checked', true, false),
                );
                $this->success('', '', $res);
            } else {
                if ($rule_ids = input('rule_ids/a')) {
                    if (false !== \think\Db::name('auth_group')->where(array('id' => array('eq', $group_id)))->setField('rules', implode(',', $rule_ids))) {
                        $this->success('权限分配成功！');
                    } else {
                        $this->error(\think\Db::name('auth_group')->getDbError());
                    }
                }
                $this->success('权限分配成功！');
            }
        }
    }

    // 功能菜单分配
    public function menu()
    {
        if (request()->isGet()) {
            $this->success('', '', $this->fetch());
        } elseif (request()->isPost()) {
            $group_id = input('group_id', 0, 'intval');
            if (input('__type') == 'menu') {
                // 获取该分组下的规则
                $checked = \think\Db::name('auth_group')->where(array('id' => array('eq', $group_id)))->value('menus');
                $checked = explode(',', $checked);
                $menus = \think\Db::name('Menu')->select();
                $res = array(
                    'rows' => array_mark($menus, $checked, 'id', 'checked', true, false),
                );
                $this->success('', '', $res);
            } else {
                if ($menu_ids = input('menu_ids/a')) {
                    if (false !== \think\Db::name('auth_group')->where(array('id' => array('eq', $group_id)))->setField('menus', implode(',', $menu_ids))) {
                        $this->success('功能分配成功！');
                    } else {
                        $this->error(\think\Db::name('auth_group')->getDbError());
                    }
                }
                $this->success('功能分配成功！');
            }
        }
    }
}