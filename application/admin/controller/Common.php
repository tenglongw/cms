<?php
namespace app\admin\controller;

use think\Controller;
class Common extends Controller
{
    public function _initialize()
    {
        if (!session('?admin_auth')) {
            session('go', url('admin/index/index'));
            $this->redirect('admin/auth/login');
        }
        \think\Hook::listen('admin_init');
        if (request()->isPost()) {
            \think\Hook::add('app_end', 'app\\admin\\behavior\\Clearcache');
            if (\ebcms\Config::get('system.oplog_on')) {
                \think\Hook::add('app_end', 'app\\admin\\behavior\\Oplog');
            }
        }
        \think\Config::set('app_trace', false);
    }
    protected function modeldata($d = [])
    {
        $e = request();
        if (!$d) {
            $d = $e->param();
        }
        if (!isset($d['model'])) {
            $d['model'] = $e->controller();
        }
        if (!isset($d['where'])) {
            $d['where'] = [];
        } else {
            foreach ($d['where'] as &$f) {
                foreach ($f as &$g) {
                    $g = is_string($g) ? trim($g) : $g;
                }
            }
        }
        if (!isset($d['with'])) {
            $d['with'] = '';
        }
        $h = \think\Loader::model($d['model']);
        if (input('order/a')) {
            $h->order(input('order/a'));
        }
        $i = [];
        $j = input('rows', 0, 'intval') ?: 1000;
	    $where = [];
	    $where1 = [];
        if ($times = input('times')) {
        	switch ($times) {
        		case 'jinri':
        			$start = strtotime(date('Y-m-d'));
        			$where = [
        					'tongji.create_time' => ['between', [$start, time()]],
        			];
        			$where1 = [
        					'create_time' => ['between', [$start, time()]],
        			];
        			break;
        		case 'zuori':
        			$start = strtotime(date('Y-m-d') . ' -1 days');
        			$end = strtotime(date('Y-m-d'));
        			$where = [
        					'tongji.create_time' => ['between', [$start, $end]],
        			];
        			$where1 = [
        					'create_time' => ['between', [$start, $end]],
        			];
        			break;
        		case 'benzhou':
        			$date = date('Y-m-d');
        			$w = date('w', strtotime($date));
        			$start = strtotime("$date -" . ($w ? $w - 1 : 6) . ' days');
        			$where = [
        					'tongji.create_time' => ['between', [$start, time()]],
        			];
        			$where1 = [
        					'create_time' => ['between', [$start, time()]],
        			];
        			break;
        		case 'shangzhou':
        			$date = date('Y-m-d');
        			$w = date('w', strtotime($date));
        			$end = strtotime("$date -" . ($w ? $w - 1 : 6) . ' days');
        			$start = $end - 7 * 24 * 3600;
        			$where = [
        					'tongji.create_time' => ['between', [$start, $end]],
        			];
        			$where1 = [
        					'create_time' => ['between', [$start, $end]],
        			];
        			break;
        
        		default:
        			if ($times && is_numeric($times)) {
        				$where = [
        						'tongji.create_time' => ['gt', time() - 3600 * 24 * $times]
        				];
        				$where1 = [
        						'create_time' => ['gt', time() - 3600 * 24 * $times]
        				];
        			}
        			break;
        	}
	        $total_num = count(\think\Db::name('tongji')->group('ip')->where($where1)->field('ip')->select());
        }else{
        	$where = $d['where'];
        	$where1 = $d['where'];
        }
        $i = $h::with($d['with'])->where($where)->paginate($j);
        $i = $i->toArray();
        $i['rows'] = $i['data'];
        if(!empty($total_num)){
	        $i['total_num'] = $total_num;
        }
        unset($i['data']);
        $this->success('获取成功！', '', $i);
    }
    protected function fetchform($k = array(), $l = array())
    {
        $n = $this->getform($k, $l);
        $this->assign($n);
        $this->assign('_data', $k);
        $this->success('', '', $this->fetch('admin@common/form'));
    }
    protected function getform($k = array(), $l = array())
    {
        $o = [];
        $l['formname'] = isset($l['formname']) ? $l['formname'] : request()->module() . '_' . request()->controller() . '_' . request()->action();
        $l['action'] = isset($l['action']) ? $l['action'] : request()->module() . '/' . request()->controller() . '/' . request()->action();
        $q = ['status' => array('eq', 1), 'name' => array('eq', $l['formname'])];
        if ($n = \think\Db::name('form')->where($q)->find()) {
            $q = ['status' => array('eq', 1), 'category_id' => array('eq', $n['id'])];
            $r = \app\admin\model\Formfield::where($q)->order('sort desc,id asc')->select();
            $s = [];
            foreach ($r as $t => $u) {
                $v = [];
                $v['id'] = $u['id'];
                $v['config'] = $u['config'];
                $v['title'] = $u['title'];
                $v['remark'] = $u['remark'];
                $v['type'] = substr($u['type'], 5);
                if ($u['subtable'] && $u['extfield']) {
                    $v['field'] = $u['subtable'] . '[' . $u['extfield'] . ']' . '[' . $u['name'] . ']';
                } elseif ($u['extfield']) {
                    $v['field'] = $u['extfield'] . '[' . $u['name'] . ']';
                } elseif ($u['subtable']) {
                    $v['field'] = $u['subtable'] . '[' . $u['name'] . ']';
                } else {
                    $v['field'] = $u['name'];
                }
                switch ($u['defaultvaluetype']) {
                    case '0':
                        $v['value'] = $u['defaultvalue'];
                        break;
                    case '1':
                        $v['value'] = input($u['defaultvalue']);
                        break;
                    case '2':
                        $v['value'] = config($u['defaultvalue']);
                        break;
                    case '3':
                        if ($u['subtable'] && $u['extfield']) {
                            $w = $k[$u['subtable']][$u['extfield']];
                        } elseif ($u['extfield']) {
                            $w = $k[$u['extfield']];
                        } elseif ($u['subtable']) {
                            $w = $k[$u['subtable']];
                        } else {
                            $w = $k;
                        }
                        $v['value'] = $this->get_point_value($w, $u['defaultvalue']);
                        break;
                    default:
                        $v['value'] = $u['defaultvalue'];
                        break;
                }
                $s[$u['group']][$u['id']] = $v;
            }
            $n['action'] = \think\Url::build($l['action']);
            $n['formtime'] = time();
            $o['_form'] = $n;
            $o['_groups'] = $s;
            if (isset($l['ext_id']) && $l['ext_id']) {
                $q = array('category_id' => array('eq', $l['ext_id']), 'status' => array('eq', 1));
                if ($x = \app\admin\model\Extendfield::where($q)->order('sort desc,id asc')->select()) {
                    $y = [];
                    foreach ($x as $t => $z) {
                        $v = [];
                        $v['id'] = $z['id'];
                        $v['config'] = $z['config'];
                        $v['title'] = $z['title'];
                        $v['remark'] = $z['remark'];
                        $v['type'] = substr($z['type'], 5);
                        if (isset($l['ext_table']) && $l['ext_table']) {
                            $v['field'] = $l['ext_table'] . '[ext]' . '[' . $z['name'] . ']';
                        } else {
                            $v['field'] = 'ext[' . $z['name'] . ']';
                        }
                        $v['value'] = '';
                        if ($k) {
                            if (isset($l['ext_table']) && $l['ext_table']) {
                                $w = $k[$l['ext_table']]['ext'];
                                $v['value'] = isset($w[$z['name']]) ? $w[$z['name']] : $z['value'];
                            } elseif (isset($k['ext'])) {
                                $w = $k['ext'];
                                $v['value'] = isset($w[$z['name']]) ? $w[$z['name']] : $z['value'];
                            }
                        }
                        $y[$z['group']][$z['id']] = $v;
                    }
                    $o['_extgroups'] = $y;
                }
            } elseif (isset($l['single_ext_id']) && $l['single_ext_id']) {
                $q = array('single_id' => array('eq', $l['single_ext_id']), 'status' => array('eq', 1));
                if ($x = \app\admin\model\Extendfield::where($q)->order('sort desc,id asc')->select()) {
                    $y = [];
                    foreach ($x as $t => $z) {
                        $v = [];
                        $v['id'] = $z['id'];
                        $v['config'] = $z['config'];
                        $v['title'] = $z['title'];
                        $v['remark'] = $z['remark'];
                        $v['type'] = substr($z['type'], 5);
                        if (isset($l['ext_table']) && $l['ext_table']) {
                            $v['field'] = $l['ext_table'] . '[ext]' . '[' . $z['name'] . ']';
                        } else {
                            $v['field'] = 'ext[' . $z['name'] . ']';
                        }
                        $v['value'] = '';
                        if ($k) {
                            if (isset($l['ext_table']) && $l['ext_table']) {
                                $w = $k[$l['ext_table']]['ext'];
                                $v['value'] = isset($w[$z['name']]) ? $w[$z['name']] : $z['value'];
                            } elseif (isset($k['ext'])) {
                                $w = $k['ext'];
                                $v['value'] = isset($w[$z['name']]) ? $w[$z['name']] : $z['value'];
                            }
                        }
                        $y[$z['group']][$z['id']] = $v;
                    }
                    $o['_extgroups'] = $y;
                }
            }
            if (input('__modal') == 1) {
                $o['__modal'] = 1;
            } else {
                $o['__modal'] = 0;
            }
            $o['namespace'] = ns();
            return $o;
        } else {
            $this->error('表单配置错误！');
        }
    }
    protected function ebadd($l = [], $aa = false)
    {
        if (request()->isGet()) {
            $this->fetchform();
        } else {
            if (request()->isPost()) {
                $l['model'] = isset($l['model']) ? $l['model'] : get_model_controller(request()->controller());
                $l['module'] = isset($l['module']) ? $l['module'] : request()->module();
                $h = \think\Loader::model($l['module'] . '/' . $l['model']);
                $bb = input();
                if(!empty($bb['ext']) && !empty($bb['ext']['date'])){
	                $bb['sell_time'] = $bb['ext']['date'];
	                $bb['sell_time_mm'] = substr($bb['ext']['date'],0,-3);
                }
                $l['allowfield'] = isset($l['allowfield']) ? $l['allowfield'] : true;
                $l['validate'] = isset($l['validate_scene']) ? $l['model'] . '.' . $l['validate_scene'] : $l['model'];
                if (false !== ($cc = $h->allowField($l['allowfield'])->validate($l['validate'])->save($bb))) {
                	$c_id = $h->db()->getLastInsID();
                    if (isset($l['relation']) && $l['relation']) {
                        foreach ($l['relation'] as $dd => $ee) {
                            switch ($ee['type']) {
                                case 'hasone':
                                    $h->{$dd}()->save($bb[$dd]);
                                    break;
                                case 'hasmany':
                                    $h->{$dd}()->saveAll($bb[$dd]);
                                    break;
                                case 'manytomany':
                                    $h->{$dd}()->saveAll($bb[$dd]);
                                    break;
                            }
                        }
                    }
                    if ($aa == true) {
                        return $c_id;
                    } else {
                        $this->success('新增成功！', '', ['id' => $c_id]);
                    }
                } else {
                    $this->error($h->getError());
                }
            }
        }
    }
    protected function ebedit($l = [], $aa = false)
    {
        if (request()->isGet()) {
            $cc = isset($l['id']) ? $l['id'] : input('id');
            $l['model'] = isset($l['model']) ? $l['model'] : get_model_controller(request()->controller());
            $l['module'] = isset($l['module']) ? $l['module'] : request()->module();
            $h = \think\Loader::model($l['module'] . '/' . $l['model']);
            $this->fetchform($h->get($cc));
        } else {
            if (request()->isPost()) {
                $cc = isset($l['id']) ? $l['id'] : input('id');
                $l['model'] = isset($l['model']) ? $l['model'] : get_model_controller(request()->controller());
                $l['module'] = isset($l['module']) ? $l['module'] : request()->module();
                $h = \think\Loader::model($l['module'] . '/' . $l['model']);
                $k = $h->get($cc);
                if (true != session('super_admin') && $k['locked']) {
                    $this->error('锁定的数据可解锁后修改！');
                }
                $bb = input();
                $l['allowfield'] = isset($l['allowfield']) ? $l['allowfield'] : true;
                $l['validate'] = isset($l['validate_scene']) ? $l['model'] . '.' . $l['validate_scene'] : $l['model'];
                if(!empty($bb['ext']) && !empty($bb['ext']['date'])){
                	$bb['sell_time'] = $bb['ext']['date'];
                	$bb['sell_time_mm'] = substr($bb['ext']['date'],0,-3);
                }
                $bb['update_time'] = time();
                if (false !== $h->allowField($l['allowfield'])->validate($l['validate'])->save($bb, ['id' => $cc])) {
                    if (isset($l['relation']) && $l['relation']) {
                        foreach ($l['relation'] as $dd => $ee) {
                            switch ($ee['type']) {
                                case 'hasone':
                                    $ee['validate'] = isset($ee['validate_scene']) ? $dd . '.' . $ee['validate_scene'] : $dd;
                                    $ee['allowfield'] = isset($ee['allowfield']) ? $ee['allowfield'] : true;
                                    if (false === $h->{$dd}->allowField($ee['allowfield'])->validate($ee['validate'])->save($bb[$dd])) {
                                        $this->error($h->{$dd}->getError());
                                    }
                                    break;
                                case 'hasmany':
                                    $h->{$dd}()->delete();
                                    $h->{$dd}()->saveAll($bb[$dd]);
                                    break;
                                case 'manytomany':
                                    $h->{$dd}()->detach(true);
                                    $h->{$dd}()->saveAll($bb[$dd]);
                                    break;
                            }
                        }
                    }
                    if ($aa == true) {
                        return true;
                    } else {
                        return $this->success('修改成功！');
                    }
                } else {
                    $this->error($h->getError());
                }
            }
        }
    }
    protected function ebdelete($l = [], $k = [])
    {
        if (false !== ($o = $this->_ebdelete($l, $k))) {
            $this->success('删除成功！', '', $o);
        } else {
            $this->error('删除失败！');
        }
    }
    protected function _ebdelete($l = [], $k = [])
    {
        if (isset($k['ids'])) {
            $ff = (array) $k['ids'];
        } elseif ($ff = input('ids')) {
            $ff = explode(',', $ff);
        }
        if ($ff) {
            $l['model'] = isset($l['model']) ? $l['model'] : get_model_controller(request()->controller());
            $l['module'] = isset($l['module']) ? $l['module'] : request()->module();
            $h = \think\Loader::model($l['module'] . '/' . $l['model']);
            $gg['id'] = array('in', $ff);
            if (!session('super_admin') && !isset($l['unlock'])) {
                $gg['locked'] = array('eq', 0);
            }
            if (isset($l['relation']) && $l['relation']) {
                $hh = $h->where($gg)->select();
                if ($hh) {
                    foreach ($hh as $ii) {
                        foreach ($l['relation'] as $dd => $ee) {
                            switch ($ee['type']) {
                                case 'hasone':
                                    if (isset($ee['sub'])) {
                                        $this->_ebdelete($ee['sub'], ['ids' => $ii['id']]);
                                    }
                                    $ii->{$dd}->delete();
                                    break;
                                case 'hasmany':
                                    if (isset($ee['sub'])) {
                                        $jj = $ii->{$dd};
                                        $kk = [];
                                        foreach ($jj as $ll) {
                                            $kk[] = $ll['id'];
                                        }
                                        if ($kk) {
                                            $this->_ebdelete($ee['sub'], ['ids' => $kk]);
                                        }
                                    }
                                    $ii->{$dd}()->delete();
                                    break;
                                case 'manytomany':
                                    $ii->{$dd}()->detach(true);
                                    break;
                            }
                        }
                        $ii->delete();
                    }
                }
            } else {
                $hh = $h->where($gg)->select();
                $h->where($gg)->delete();
            }
            $o = [];
            foreach ($hh as $mm) {
                $o[] = $mm->toArray();
            }
            return $o;
        } else {
            return false;
        }
    }
    protected function ebstatus($l = [])
    {
        if (isset($l['ids'])) {
            $ff = (array) $l['ids'];
        } elseif ($ff = input('ids')) {
            $ff = explode(',', $ff);
        }
        if (empty($ff)) {
            $this->error('请选择要 操作 的数据！');
        }
        if (isset($l['value'])) {
            $u = (int) $l['value'];
        } else {
            $u = input('value', 0, 'intval') ? 1 : 0;
        }
        $this->ebfield($ff, 'status', $u, $l);
    }
    protected function ebsort($l = [])
    {
        if (isset($l['ids'])) {
            $ff = (array) $l['ids'];
        } elseif ($ff = input('ids')) {
            $ff = explode(',', $ff);
        }
        if (empty($ff)) {
            $this->error('请选择要 操作 的数据！');
        }
        if (isset($l['value'])) {
            $u = (int) $l['value'];
        } else {
            $u = input('value', 0, 'intval');
        }
        $this->ebfield($ff, 'sort', $u, $l);
    }
    protected function ebfield($ff, $nn, $u, $l = [])
    {
        $l['model'] = isset($l['model']) ? $l['model'] : get_model_controller(request()->controller());
        $l['module'] = isset($l['module']) ? $l['module'] : request()->module();
        $h = \think\Loader::model($l['module'] . '/' . $l['model']);
        $oo = [];
        if (true != session('super_admin')) {
            $oo['locked'] = array('eq', 0);
        }
        $oo['id'] = array('in', $ff);
        $pp = $h->where($oo)->setField($nn, $u);
        if (false === $pp) {
            $this->error('操作失败！');
        } elseif (is_numeric($pp)) {
	        $pp = $h->where($oo)->setField('update_time', time());
            $this->success('操作成功！');
        }
    }
    protected function eblock($l = [])
    {
        if (isset($l['ids'])) {
            $ff = (array) $l['ids'];
        } elseif ($ff = input('ids')) {
            $ff = explode(',', $ff);
        }
        if (empty($ff)) {
            $this->error('请选择要 操作 的数据！');
        }
        if (isset($l['value'])) {
            $u = (int) $l['value'];
        } else {
            $u = input('value') ? 1 : 0;
        }
        $l['model'] = isset($l['model']) ? $l['model'] : get_model_controller(request()->controller());
        $l['module'] = isset($l['module']) ? $l['module'] : request()->module();
        $h = \think\Loader::model($l['module'] . '/' . $l['model']);
        $oo = [];
        if (is_array($ff)) {
            $oo['id'] = array('in', $ff);
        } elseif (is_numeric($ff)) {
            $oo['id'] = array('eq', $ff);
        }
        $pp = $h->where($oo)->setField('locked', $u);
        if (false === $pp) {
            $this->error('操作失败！');
        } elseif (is_numeric($pp)) {
            $this->success('操作成功！');
        }
    }
    private function get_point_value($k = [], $qq)
    {
        $rr = strpos($qq, '.');
        if (false === $rr) {
            return isset($k[$qq]) ? $k[$qq] : false;
        } else {
            $t = mb_substr($qq, 0, $rr);
            if (isset($k[$t])) {
                return $this->get_point_value($k[$t], mb_substr($qq, $rr + 1));
            } else {
                return false;
            }
        }
    }
    public function _empty()
    {
        $ss = request()->action();
        switch ($ss) {
            case 'add':
                if (request()->isGet()) {
                    $this->fetchform();
                } elseif (request()->isPost()) {
                    $this->ebadd();
                }
                break;
            case 'edit':
                if (request()->isGet()) {
                    $k = \think\Db::name(request()->controller())->find(input('id'));
                    $this->fetchform($k);
                } elseif (request()->isPost()) {
                    $this->ebedit();
                }
                break;
            case 'resort':
                if (request()->isGet()) {
                } elseif (request()->isPost()) {
                    $this->ebsort();
                }
                break;
            case 'delete':
                $this->ebdelete();
                break;
            case 'status':
                $this->ebstatus();
                break;
            case 'lock':
                $this->eblock();
                break;
            default:
                $this->error('错误请求！');
                break;
        }
    }
}