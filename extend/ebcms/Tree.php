<?php
namespace ebcms;
class Tree
{
    // 生成树
    public static function tree($data, $childrenfield = 'rows', $pidfield = 'pid', $idfield = 'id')
    {
        $temp = array();
        foreach ($data as $key => $value) {
            $temp[$value[$idfield]] = $value;
        }
        $topid = array();
        foreach ($data as $value) {
            if (!array_key_exists($value[$pidfield], $temp)) {
                $topid[] = $value[$idfield];
            }
        }
        $result = array();
        foreach ($topid as $key => $pid) {
            $result[$key] = $temp[$pid];
            if ($tmp = self::subtree($data, $pid, $childrenfield, $pidfield, $idfield)) {
                $result[$key][$childrenfield] = $tmp;
            }
        }
        return $result;
    }

    // 数组压制
    public static function subtree($arr = array(), $pid = 0, $childrenfield = 'rows', $pidfield = 'pid', $idfield = 'id')
    {
        $temp = array();
        foreach ($arr as $key => $value) {
            if ($value[$pidfield] == $pid) {
                unset($arr[$key]);
                $tmp = self::subtree($arr, $value[$idfield], $childrenfield, $pidfield, $idfield);
                if ($tmp) {
                    $value[$childrenfield] = $tmp;
                }
                $temp[] = $value;
            }
        }
        return $temp;
    }

    // 获取所有子id
    public static function subtreeid($data, $pid = 0)
    {
        $res = array();
        foreach ($data as $key => $value) {
            if ($value['pid'] == $pid) {
                $res = array_merge($res, (array)$value['id']);
                $res = array_merge($res, (array)self::subtreeid($data, $value['id']));
            }
        }
        return $res;
    }

    // 子节点
    public static function sub($arr = [], $pid = 0, $pidfield = 'pid')
    {
        $res = array();
        foreach ($arr as $value) {
            if ($value[$pidfield] == $pid) {
                $res[] = $value;
            }
        }
        return $res;
    }

    // 子节点id
    public static function subid($arr = [], $pid = 0, $pidfield = 'pid')
    {
        $res = [];
        foreach ($arr as $value) {
            if ($value[$pidfield] == $pid) {
                $res[] = $value['id'];
            }
        }
        return $res;
    }
    public static function subid2($arr = [], $pid = 0, $pidfield = 'pid')
    {
    	$res = [];
    	$res[] = $pid;
    	foreach ($arr as $value) {
    		if ($value[$pidfield] == $pid) {
    			$res[] = $value['id'];
    		}
    	}
    	return $res;
    }

    // 获取父栏目
    public static function parent_data($data, $id)
    {
        $res = [];
        foreach ($data as $value) {
            $res[$value['id']] = $value;
        }
        return self::_parent_data($res, $id);
    }

    protected static function _parent_data($data, $id)
    {
        if (!$data) {
            return [];
        }
        $res = [];
        // 如果存在父内容
        if (isset($data[$data[$id]['pid']])) {
            if ($x = self::_parent_data($data, $data[$data[$id]['pid']]['id'])) {
                $res = array_merge($res, $x);
            }
            $res[] = $data[$data[$id]['pid']];
        }
        return $res;
    }
}