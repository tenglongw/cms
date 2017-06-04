<?php
namespace app\index\controller;

use think\Controller;

class Common extends Controller
{

    protected $seo = [];

    public function _initialize()
    {
        // 判断网站是否关闭
        if (\ebcms\Config::get('system.site_closed')) {
            $this->error(\ebcms\Config::get('system.site_closed_reason'));
        }

        if (!config('app_debug')) {
            error_reporting(0);
        }

        if (request()->isGet()) {

            // 判断是否开启统计
            if (\ebcms\Config::get('tongji.tongji_on')) {
                \think\Hook::add('app_end', 'app\\index\\behavior\\Tongji');
            }

            $config = \ebcms\Config::get('index');
            $this->seo = [
                'sitename' => $config['sitename'],
                'title' => $config['title'],
                'keywords' => $config['keywords'],
                'description' => $config['description'],
            ];

            $template = config('template');
            $theme = \ebcms\Config::get('system.theme') ?: 'default';
            if (request()->isMobile() && \ebcms\Config::get('system.mobile_on')) {
                if (is_dir(ROOT_PATH . 'templates' . DS . $theme . '_mobile')) {
                    $theme = $theme . '_mobile';
                }
            }
            $template['view_path'] = ROOT_PATH . 'templates' . DS . $theme . DS;
            $template['taglib_pre_load'] = 'cx,\\app\\index\\taglib\\ebcms,\\app\\index\\taglib\\content';
            $this->view->engine($template);

        }
    }
}