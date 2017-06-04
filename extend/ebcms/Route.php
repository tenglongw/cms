<?php
namespace ebcms;

class Route
{

    public static function route()
    {
        $routes = self::get_route();
        if (is_array($routes)) {
            foreach ($routes as $key => $route) {
                \think\Route::rule($route[0], $route[1], $route[2], $route[3], $route[4]);
            }
        }
    }

    private static function get_route()
    {
        $routes = [];
        switch (\ebcms\Config::get('system.url_model')) {

            // 标准模式
            case '1':
                $rules = [
                    '/' => 'index/index/index',
                    'verify/:id' => 'index/api/verify',
                    'verify$' => 'index/api/verify',
                    'guestbook$' => 'index/guestbook/index',
                    'link_apply$' => 'index/link/apply',
                    'space/:id' => 'index/space/index',
                    'search$' => 'index/content/search',
                    'login$' => 'index/auth/login',
                    'logout$' => 'index/auth/logout',
                    'reg/:code' => 'index/auth/reg',
                    'reg$' => 'index/auth/reg',
                    'password/:code' => 'index/auth/password',
                    'password$' => 'index/auth/password',
                    'user/password' => 'index/user/password',
                    'user/info' => 'index/user/info',
                    'user/notice' => 'index/user/notice',
                    'user$' => 'index/user/index',
                    'tag/:tag' => 'index/content/tag',
                    'tag$' => 'index/content/tag',
                    'bulletin/:id' => 'index/bulletin/detail',
                    'bulletin$' => 'index/bulletin/index',
                    'category/:id' => 'index/content/index',
                    'detail/:id' => 'index/content/detail',
                    'detail/:filename' => 'index/content/detail',
                    'single/:id' => 'index/single/index',
                ];
                foreach ($rules as $key => $rule) {
                    $routes[] = [$key, $rule, 'post|get', [], []];
                }
                break;

            // 高级模式
            case '2':
                if (!$routes = \think\Cache::get('ebcms_routes')) {
                    // 内容模块
                    $categorys = \think\Db::name('content_category')->column(true, 'id');
                    self::category_route($categorys, 0, [], $routes);
                    // 单页模块
                    $single = \think\Db::name('single')->where(['path' => ['neq', '']])->column('path', 'id');
                    self::single_route($single, $routes);
                    // 自定义
                    $customs = \ebcms\Config::get('system.url_route_rules');
                    $customs = explode("\r\n", $customs);
                    foreach ($customs as $custom) {
                        if (strpos($custom, '|')) {
                            $custom = explode('|', $custom);
                            $routes[] = [$custom[0], $custom[1], 'get|post', [], []];
                        }
                    }
                    // 默认
                    $rules = [
                        '/' => 'index/index/index',
                        'verify/:id$' => 'index/api/verify',
                        'verify$' => 'index/api/verify',
                        'guestbook$' => 'index/guestbook/index',
                        'link_apply$' => 'index/link/apply',
                        'space/:id$' => 'index/space/index',
                        'search$' => 'index/content/search',
                        'login$' => 'index/auth/login',
                        'logout$' => 'index/auth/logout',
                        'reg/:code' => 'index/auth/reg',
                        'reg$' => 'index/auth/reg',
                        'password/:code' => 'index/auth/password',
                        'password$' => 'index/auth/password',
                        'user/password' => 'index/user/password',
                        'user/info' => 'index/user/info',
                        'user/notice' => 'index/user/notice',
                        'user$' => 'index/user/index',
                        'tag/:tag' => 'index/content/tag',
                        'tag$' => 'index/content/tag',
                        'bulletin/:id' => 'index/bulletin/detail',
                        'bulletin$' => 'index/bulletin/index',
                        'category/:id' => 'index/content/index',
                        'detail/:id' => 'index/content/detail',
                        'detail/:filename' => 'index/content/detail',
                        'single/:id' => 'index/single/index',
                    ];
                    foreach ($rules as $key => $value) {
                        $routes[] = [$key, $value, 'get|post', [], []];
                    }
                    \think\Cache::set('ebcms_routes', $routes);
                }
                break;

            // 普通模式
            default:
                break;
        }
        return $routes;
    }

    protected static function category_route($categorys, $pid = 0, $path = [], &$res)
    {
        foreach ($categorys as $key => $category) {
            if ($category['pid'] == $pid) {
                $tpath = array_merge($path, [$category['name']]);
                self::category_route($categorys, $category['id'], $tpath, $res);
                if ($tpath) {
                    $res[] = [implode('/', $tpath) . '$', 'index/content/index?id=' . $category['id'], 'get|post', [], []];
                    $res[] = [implode('/', $tpath) . '/:id$', 'index/content/detail?category_id=' . $category['id'], 'get|post', [], []];
                    $res[] = [implode('/', $tpath) . '/:filename$', 'index/content/detail?category_id=' . $category['id'], 'get|post', [], []];
                }
            }
        }
    }

    protected static function single_route($single, &$routes)
    {
        if ($single) {
            foreach ($single as $id => $path) {
                if ($path) {
                    $routes[] = [substr($path, 1), 'index/single/index?id=' . $id, 'get|post', [], []];
                }
            }
        }
    }

}