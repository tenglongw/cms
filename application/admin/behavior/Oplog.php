<?php
namespace app\admin\behavior;

class Oplog
{

    public function run(&$params)
    {
        $rule = strtolower(request()->module() . '_' . request()->controller() . '_' . request()->action());
        // 排除 数据库备份 还原操作。
        if ('admin_database_exports' == $rule) {
            return;
        }
        if ('admin_database_imports' == $rule) {
            return;
        }
        if (strtolower(request()->action()) != 'index') {
            if (!\think\Cache::has('rules')) {
                $rules = \think\Db::name('auth_rule')->column('opstr', 'name');
                \think\Cache::set('rules', $rules);
            } else {
                $rules = \think\Cache::get('rules');
            }
            $title = isset($rules[$rule]) ? $rules[$rule] : '未知操作！';
            $data = [
                'url' => request()->domain() . request()->url(),
                'request' => serialize(request()->request()),
                'user_id' => session('user_id') ?: 0,
                'title' => $title,
                'ids' => input('ids') ?: input('id'),
                'create_time' => time(),
            ];
            \think\Db::name('oplog')->insert($data);
        }

    }
}