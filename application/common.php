<?php

// 变量调试
function p($data)
{
    echo '<pre>';
    print_r($data);
    echo '</pre>';
}

// 生成命名空间字符串
function ns($controller = '', $module = '')
{
    if (!isset($controller) || !$controller) {
        $controller = request()->controller();
    }
    if (!isset($module) || !$module) {
        $module = request()->module();
    }
    return 'ebcms_' . md5($module . '_' . $controller);
}

// 获取操作节点
function mca($action, $controller = '', $module = '')
{
    $module = $module ?: request()->module();
    $controller = $controller ?: request()->controller();
    $action = $action ?: request()->action();
    return md5($module . '_' . $controller . '_' . $action);
}

function ebconfig($name)
{
    return \ebcms\Config::get($name);
}

function get_root($domain = false)
{
    $str = dirname(request()->baseFile());
    $str = ($str == DS) ? '' : $str;
    if ($domain) {
        return request()->domain() . $str;
    } else {
        return $str;
    }
}

// 从数据中获取数据
function get_tpl_value($data = [], $str)
{
    $pos = strpos($str, '.');
    if (false === $pos) {
        return isset($data[$str]) ? $data[$str] : false;
    } else {
        $key = mb_substr($str, 0, $pos);
        if (isset($data[$key])) {
            return get_tpl_value($data[$key], mb_substr($str, $pos + 1));
        } else {
            return false;
        }
    }
}

// 将多行特定字符串解析成数组
// 类型1：abc:标题|链接
// 类型2：高度|30cm
function render_param($str)
{
    if (!$str) {
        return '';
    }
    $arr = explode("\r\n", $str);
    $array = array();
    foreach ($arr as $key => $value) {
        if ($value) {
            if (strpos($value, ':')) {
                $tmp = explode(':', $value);
                if (strpos($tmp[1], '|')) {
                    $temp = explode('|', $tmp[1]);
                    foreach ($temp as $k => $v) {
                        $temp[$k] = $v;
                    }
                    $tmp[1] = $temp;
                } else {
                    $tmp[1] = $tmp[1];
                }
                $array[$tmp[0]] = $tmp[1];
            } else {
                if (strpos($value, '|')) {
                    $temp = explode('|', $value);
                    foreach ($temp as $k => $v) {
                        $temp[$k] = $v;
                    }
                    $array[] = $temp;
                } else {
                    $array[] = $value;
                }
            }
        }
    }
    return $array;
}

// 加密
function eb_encrypt($dir)
{
    return \ebcms\Crypt::encode($dir, config('safe_code'), 99999);
}

// 解密
function eb_decrypt($str)
{
    return \ebcms\Crypt::decode($str, config('safe_code'));
}

// 获取easyui传来的排序字段
function getorder()
{
    $eusort = explode(',', input('sort', 'id'));
    $euorder = explode(',', input('order', 'desc'));
    $order = '';
    $idsort = 0;
    foreach ($eusort as $key => $value) {
        if ($value == 'id') {
            $idsort = 1;
        }
        $order .= $value . ' ' . $euorder[$key] . ',';
    }
    if (!$idsort) {
        $order .= 'id desc,';
    }
    return substr($order, 0, strlen($order) - 1);
}

function getpage()
{
    $rows = input('rows', 0, 'intval');
    $page = input('page', 1, '');
    if ($rows) {
        return abs($page) . ',' . abs($rows);
    }
    return '';
}

function render_str($data)
{
    preg_match_all('/{{([\s\S]*?)}}/', $data, $mat);
    foreach ($mat[1] as $key => $value) {
        eval('$__m = ' . $value . ';');
        $data = str_replace($mat[0][$key], $__m, $data);
    }
    return $data;
}

// 根据模型获取控制器名称
function get_model_controller($controller)
{
    if (false != $pos = strpos($controller, '.')) {
        $controller = substr($controller, $pos + 1);
    }
    return $controller;
}

// 获取栏目
function get_content_category($type = '')
{
    static $res;
    if (!$res && !$res = \think\Cache::get('content_categorys')) {
        $x = \app\content\model\Category::with('')->order('sort desc,id asc')->select();
        $categorys_status = [];
        $categorys_extend = [];
        $categorys = [];
        foreach ($x as $category) {
            $categorys[$category['id']] = $category;
            if ($category['status']) {
                $categorys_status[$category['id']] = $category;
                $categorys_extend[$category['extend_id']][] = $category['id'];
            }
        }
        $res['categorys'] = $categorys;
        $res['categorys_status'] = $categorys_status;
        $res['categorys_extend'] = $categorys_extend;
        \think\Cache::set('content_categorys', $res);
    }
    if (!$res) {
        return false;
    }
    if (is_numeric($type)) {
        return isset($res['categorys'][$type]) ? $res['categorys'][$type] : false;
    } elseif ('all' == $type) {
        return $res['categorys'];
    } elseif ('extend' == $type) {
        return $res['categorys_extend'];
    } else {
        return $res['categorys_status'];
    }
}

// 获取缩略图真实地址
function thumb($file, $width = 0, $height = 0, $type = 3)
{
    if (0 === strpos($file, 'http')) {
        return $file;
    }
    $base = get_root();
    if (!$width || !$height) {
        if (is_file('./upload' . $file)) {
            return $base . '/upload' . $file;
        }
        return get_root() . '/static/index/image/nopic.gif"';
    } else {
        $res = $base . '/upload' . $file . '!' . $width . '_' . $height . '_' . $type . '.' . pathinfo($file, PATHINFO_EXTENSION);
        $thumbfile = './upload' . $file . '!' . $width . '_' . $height . '_' . $type . '.' . pathinfo($file, PATHINFO_EXTENSION);
        $file = './upload' . $file;
    }
    if (!is_file($thumbfile)) {
        if (!is_file($file)) {
            if ($width && $height) {
                return get_root() . '/static/index/image/nopic.gif" width="' . $width . '" height="' . $height;
            } else {
                return get_root() . '/static/index/image/nopic.gif" ';
            }
        } else {
            \think\Image::open($file)->thumb($width, $height, $type)->save($thumbfile, null, 100);
        }
    }
    return $res;
}

/**
 * 用户名密码加密
 *
 */
function crypt_pwd($pwd, $salt = ' love ebcms forever!')
{
    return md5($pwd . $salt);
}

// 替换
function str_preg_parse($str, $data)
{
    return preg_replace_callback('|{[\w\.\-_]+}|', function ($match) use ($data) {
        $res = get_tpl_value($data, substr($match[0], 1, -1));
        if (false != $res) {
            return $res;
        } else {
            return substr($match[0], 1, -1);
        }
    }, $str);
}

// 发送邮件
function sendmail($address, $name = '收件人', $subject = '测试邮件！', $body = '测试内容！')
{
    $config = \ebcms\Config::get('system');
    vendor('PHPMailer.PHPMailerAutoload');
    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->CharSet = 'utf-8';
    $mail->Host = $config['email_host'];
    $mail->Port = $config['email_port'];
    $mail->SMTPAuth = $config['email_smtpauth'];
    $mail->Username = $config['email_name'];
    $mail->Password = $config['email_password'];
    $mail->From = $config['email_from'];
    $mail->FromName = $config['email_fromname'];
    $mail->IsHTML($config['email_html']);

    $mail->AddAddress($address, $name);
    $mail->Subject = $subject;
    $mail->Body = $body;
    return $mail->Send();
}