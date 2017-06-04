<?php
namespace app\admin\controller;
class Api extends \app\admin\controller\Common
{

    public function index()
    {
        if (request()->isGet()) {
            $this->success('', '', $this->fetch());
        } elseif (request()->isPost()) {
            if ($api = input('api')) {
                $this->$api();
            }
        }
    }

    // 数据字典缓存
    private function asyncdata()
    {
        $request = request();
        $res = array();
        // 超级管理员标识
        $res['super_admin'] = session('super_admin') ? 1 : 0;
        // 普通管理员权限
        $res['rules'] = $this->get_rules(session('user_id'));
        $res['api_url'] = url('admin/api/index');
        $res['recommend_url'] = url('admin/recommend/push');
        $res['suggestkeywords_url'] = url('admin/server/index');
        $res['config'] = [
            'WebUploader_swf' => '/webuploader/Uploader.swf',
            'WebUploader_server' => url('admin/index/upload'),
        ];
        $res['ueditor'] = \ebcms\Config::get('system.ueditor');
        $res['root'] = get_root();
        $this->success('加载成功', '', $res);
    }

    // 权限规则
    private function get_rules($user_id)
    {
        if (true == session('super_admin')) {
            return [];
        }
        // 根据角色获取有权限的节点id
        $where = [];
        if ($group_ids = \think\Db::name('auth_access')->where('uid', 'eq', session('user_id'))->column('group_id')) {
            $rule_ids = \think\Db::name('auth_group')->where(['id' => ['in', $group_ids], 'status' => 1])->column('rules');
            $rule_ids = implode(',', $rule_ids);
            $rule_ids = array_unique(explode(',', $rule_ids));
            if ($rule_ids) {
                $where['id'] = ['in', $rule_ids];
            } else {
                $where['id'] = ['eq', -1];
            }
        }
        $where['status'] = 1;
        $rules = \think\Db::name('auth_rule')->where($where)->column('name');
        foreach ($rules as &$rule) {
            $rule = md5($rule);
        }
        return $rules;
    }

    // 我的菜单
    private function mymenu()
    {
        $where = [];
        if (!session('super_admin')) {
            // 根据角色获取有权限的菜单id
            if ($group_ids = \think\Db::name('auth_access')->where('uid', 'eq', session('user_id'))->column('group_id')) {
                $menu_ids = \think\Db::name('auth_group')->where(['id' => ['in', $group_ids], 'status' => 1])->column('menus');
                $menu_ids = implode(',', $menu_ids);
                $menu_ids = array_unique(explode(',', $menu_ids));
                if ($menu_ids) {
                    $where['id'] = ['in', $menu_ids];
                } else {
                    $where['id'] = ['eq', -1];
                }
            }
        }
        $where['status'] = ['in', [1, 2]];
        $data = \think\Db::name('menu')->where($where)->order('sort desc,id asc')->select();
        foreach ($data as &$v) {
            $v['url'] = urlencode(url($v['url']));
        }
        $this->success('获取成功！', '', ['rows' => $data]);
    }

    // 字典数据
    private function datadict()
    {
        if ($datadict = input('datadict')) {
            $_where = array(
                'status' => array('eq', 1),
                'field' => array('eq', $datadict),
            );
            if ($cate = \think\Db::name('datadictcate')->where($_where)->find()) {
                $_where = array(
                    'status' => array('eq', 1),
                    'category_id' => array('eq', $cate['id']),
                );
                $m = \think\Db::name('datadict');
                if (input('order/a')) {
                    $m->order(input('order/a'));
                }

                $_data = $m->where($_where)->select();
                $data = [];
                foreach ($_data as &$v) {
                    $v['value'] = render_str($v['value']);
                    $data[$v['id']] = $v;
                };
                $res = array();
                foreach ($data as $key => $value) {
                    $d = array();
                    $d['id'] = (string)$value['value'];
                    $d['pid'] = isset($data[$value['pid']]) ? (string)$data[$value['pid']]['value'] : '';
                    $d['title'] = $value['title'];
                    $d['remark'] = $value['remark'];
                    $res[$value['value']] = $d;
                }
                $this->success('', '', ['rows' => $res]);
            } else {
                $this->error('数据不存在！');
            }
        } else {
            $this->error('数据不存在！');
        }
    }

    private function suggest_keywords()
    {
        $res = \ebcms\Server::api('keywords_suggest', ['k' => input('k')]);
        if ($res['code']) {
            $this->success($res['msg'], '', $res['data']);
        } else {
            $this->error($res['msg'], '', $res['data']);
        }
    }

    private function check_version()
    {
        $ver = include CONF_PATH . 'version.php';
        $param = [
            'version' => $ver['version'],
        ];
        $res = \ebcms\Server::api('version_next', $param);
        if ($res['code']) {
            $this->success($res['msg'], '', $res['data']);
        } else {
            $this->error($res['msg'], '', $res['data']);
        }
    }

}