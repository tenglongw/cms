<?php
namespace app\admin\behavior;

class Clearcache
{

    public function run(&$params)
    {
        $node = strtolower(request()->module() . '_' . request()->controller() . '_' . request()->action());
        $nodes = [
            'content_admin.category_add' => ['ebcms_routes', 'content_categorys'],
            'content_admin.category_edit' => ['ebcms_routes', 'content_categorys'],
            'content_admin.category_status' => ['ebcms_routes', 'content_categorys'],
            'content_admin.category_resort' => ['ebcms_routes', 'content_categorys'],
            'content_admin.category_delete' => ['ebcms_routes', 'content_categorys'],
            'content_admin.category_merge' => ['ebcms_routes', 'content_categorys'],
            'admin_config_add' => ['ebcms_routes', 'content_categorys'],
            'admin_config_edit' => ['ebcms_routes', 'content_categorys'],
            'admin_config_status' => ['ebcms_routes', 'content_categorys'],
            'admin_config_delete' => ['ebcms_routes', 'content_categorys'],
            'admin_config_setting' => ['ebcms_routes', 'content_categorys'],
            'admin_single_add' => ['ebcms_routes'],
            'admin_single_edit' => ['ebcms_routes'],
            'admin_single_status' => ['ebcms_routes'],
            'admin_single_delete' => ['ebcms_routes'],
        ];
        if (isset($nodes[$node])) {
            foreach ($nodes[$node] as $key => $value) {
                \think\Cache::set($value,'');
            }
        }
    }
}