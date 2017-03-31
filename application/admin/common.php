<?php

// 删除目录下的文件
function deldir($dir)
{
    //删除当前文件夹下得文件：
    if (is_dir($dir)) {
        $dh = opendir($dir);
        while ($file = readdir($dh)) {
            if ($file != "." && $file != "..") {
                $fullpath = $dir . "/" . $file;
                if (!is_dir($fullpath)) {
                    unlink($fullpath);
                } else {
                    deldir($fullpath);
                }
            }
        }
        return true;
    }
    return false;
}

function file_id_dir($dirname)
{
    if (!$Ld = @dir($dirname)) {
        return array();
    }
    $result = [];
    while (false !== ($entry = $Ld->read())) {
        $checkdir = $dirname . "/" . $entry;
        $id = str_replace(array('/', '.'), array('', ''), $checkdir);
        if (is_dir($checkdir) && !preg_match("[^\.]", $entry)) {
            $rows = file_id_dir($checkdir);
            if ($rows) {
                $result[] = array(
                    'id' => eb_encrypt($id),
                    'title' => $entry,
                    'path' => eb_encrypt($checkdir),
                    'state' => 'open',
                    'isdir' => true,
                    'rows' => $rows
                );
            }
        } elseif ($entry != '.' && $entry != '..' && in_array(pathinfo($entry, PATHINFO_EXTENSION), \think\Config::get('tpl.edit_ext'))) {
            if (!preg_match('/[^\x00-\x80]/', $entry)) {
                $result[] = array(
                    'id' => eb_encrypt($id),
                    'title' => $entry,
                    'filename' => eb_encrypt($checkdir),
                    'isdir' => false,
                );
            }
        }
    }
    $Ld->close();
    return $result;
}

function array_mark($arr = array(), $data = '', $eq = 'id', $additem = '_mark', $mark = 'checked', $checkp = true)
{
    if ($checkp) {
        $pid = array();
        foreach ($arr as $key => $value) {
            $pid[$value['pid']] = 1;
        }
    }
    $arr = is_array($arr) ? $arr : false;
    $tmp = array();

    foreach ($arr as $v) {
        if (!$checkp || ($checkp && !$pid[$v['id']])) {
            $v[$additem] = in_array($v[$eq], (array)$data) ? $mark : '';
        }
        $tmp[] = $v;
    }
    return $tmp;
}