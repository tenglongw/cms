<?php
namespace app\admin\controller;
class Config extends \app\admin\controller\Common
{

    // 所有模板显示
    public function index()
    {
        if (request()->isGet()) {
            $this->success('', '', $this->fetch());
        } elseif (request()->isPost()) {
            $this->success('', '', $res);
        }
    }

    public function setting()
    {
        if (request()->isGet()) {
            $_form = array(
                'action' => url('admin/config/setting'),
                'group' => '系统配置',
                'title' => '修改配置',
                'formtime' => time(),
            );
            $type = input('type');
            if (!$type = eb_decrypt($type)) {
                $this->error('非法操作！');
            }
            list($k, $v) = explode('|', $type);
            switch ($k) {
                case 'category_id':
                    $_form['group'] = \think\Db::name('configcate')->where(['id' => $v])->value('title');
                    $_where = array(
                        'status' => array('eq', 1),
                        'form' => array('neq', 'hidden'),
                        'locked' => array('eq', 0),
                        'category_id' => array('eq', $v),
                    );
                    break;
                case 'ids':
                    $_where = array(
                        'status' => array('eq', 1),
                        'form' => array('neq', 'hidden'),
                        'locked' => array('eq', 0),
                        'id' => array('in', explode(',', $v)),
                    );
                    break;
                case 'pid':
                    $x = \think\Db::name('config')->find($v);
                    $_form['title'] = $x['title'];
                    $_form['group'] = \think\Db::name('configcate')->where(['id' => $x['category_id']])->value('title');
                    $_where = array(
                        'status' => array('eq', 1),
                        'form' => array('neq', 'hidden'),
                        'locked' => array('eq', 0),
                        'pid' => array('eq', $v),
                    );
                    break;
                case 'name':
                    $x = \think\Db::name('configcate')->where(['name' => ['eq', $v]])->find();
                    $_category_id = $x['id'];
                    $_form['group'] = $x['title'];
                    $_where = array(
                        'status' => array('eq', 1),
                        'form' => array('neq', 'hidden'),
                        'locked' => array('eq', 0),
                        'category_id' => array('eq', $_category_id),
                    );
                    break;
                default:
                    $this->error('参数错误！');
                    break;
            }
            if ($configs = \app\admin\model\Config::where($_where)->order('sort desc,id asc')->select()) {
                $ids = [];
                foreach ($configs as $key => $config) {
                    $ids[] = $config['id'];
                    $tmp = [];
                    $tmp['id'] = $config['id'];
                    $tmp['title'] = $config['title'];
                    $tmp['remark'] = $config['remark'];
                    $tmp['type'] = substr($config['form'], 5);
                    $tmp['field'] = 'config[' . $config['id'] . ']';
                    $tmp['value'] = $config['value'];
                    $tmp['config'] = $config['config'];
                    $_groups[$config['group']][$config['id']] = $tmp;
                }
                sort($ids);
                $config_verify = eb_encrypt($ids);
                $_groups[$config['group']][] = [
                    'field' => 'config_verify',
                    'value' => $config_verify,
                    'type' => 'hidden',
                    'title' => '',
                    'config' => [],
                    'id' => '0',
                ];
                $this->assign('_form', $_form);
                $this->assign('_groups', $_groups);
                $this->assign('namespace', ns());
                if (input('__modal') == 1) {
                    $this->assign('__modal', 1);
                }
                $this->success('', '', $this->fetch('common/form'));
            } else {
                $this->error('没有配置项');
            }
        } elseif (request()->isPost()) {
            $data = input('config/a');
            $config_verify = input('config_verify');
            // 验证数据真实性
            $ids = array_keys($data);
            sort($ids);
            if ($ids != eb_decrypt($config_verify)) {
                $this->error('非法操作！');
            }
            // 更新数据
            foreach ($data as $key => $value) {
                \think\Db::name('config')->where(array('id' => array('eq', $key)))->setField('value', $value);
            }
            // 更新配置缓存
            \ebcms\Config::config(true);
            $this->success('修改成功');
        }
    }

    public function custom()
    {
        if (request()->isGet()) {
            $this->success('', '', $this->fetch());
        } elseif (request()->isPost()) {
            # code...
        }
    }

    // 添加自定义配置
    public function add()
    {
        if (request()->isGet()) {
            $this->fetchform();
        } elseif (request()->isPost()) {
            // 更新配置缓存
            \ebcms\Config::config(true);
            // 注意安全性。
            $this->ebadd(['validate_scene' => 'add']);
        }
    }

    // 编辑自定义配置
    public function edit()
    {
        if (request()->isGet()) {
            $this->ebedit();
        } elseif (request()->isPost()) {

            $this->ebedit(['validate_scene' => 'edit']);
            // 更新配置缓存
            \ebcms\Config::config(true);
            $this->success('更新成功！');
        }
    }
}