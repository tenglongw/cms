<?php
namespace app\admin\controller;
class Database extends \app\admin\controller\Common
{

    public function index()
    {
        if (request()->isGet()) {
            $this->success('', '', $this->fetch());
        } elseif (request()->isPost()) {
            $api = input('api');
            $this->$api();
        }
    }

    // 返回数据库中的表
    protected function datatables()
    {
        if (request()->isPost()) {
            // $list  = \think\Db::query('SHOW TABLE STATUS');
            $list = \think\Db::query("SHOW TABLE STATUS from `" . config('database.database') . "` LIKE '" . config('database.prefix') . "%'");
            $list = array_map('array_change_key_case', $list);
            $count = count($list);
            for ($i = 0; $i < $count; $i++) {
                $list[$i]['id'] = $i + 1;
            }
            $result = array(
                'rows' => $list,
                'total' => $count,
            );
            $this->success('获取成功', '', $result);
        }
    }

    // 返回备份的数据包
    protected function databackups()
    {
        // 返回备份的数据包
        if (request()->isPost()) {
            $backup_path = \ebcms\Config::get('system.backup_path');
            $pattern = $backup_path . DS . 'db' . DS . '201*-*-*.sql*';
            $files = glob($pattern);
            $list = array();
            foreach ($files as $name) {
                $basename = basename($name);
                $size = filesize($name);
                $ext = pathinfo($basename, PATHINFO_EXTENSION);
                $match = sscanf($basename, '%4s%2s%2s-%2s%2s%2s-%d');
                $filetime = $match[0] . $match[1] . $match[2] . '-' . $match[3] . $match[4] . $match[5];
                $list[$filetime]['time'] = $filetime;
                if (isset($list[$filetime]['parts'])) {
                    $list[$filetime]['parts'] += 1;
                } else {
                    $list[$filetime]['parts'] = 1;
                }
                if (isset($list[$filetime]['size'])) {
                    $list[$filetime]['size'] += $size;
                } else {
                    $list[$filetime]['size'] = 0;
                }
                $list[$filetime]['ext'] = $ext;
                $list[$filetime]['files'][$match[6]] = array('file' => $basename, 'size' => intval($size / 1024) ? intval($size / 1024) : 1);
            }
            $count = count($list);
            $rows = array();
            for ($i = 0; $i < $count; $i++) {
                $rows[$i] = array_shift($list);
                $rows[$i]['id'] = $i + 1;
                $rows[$i]['size'] = intval($rows[$i]['size'] / 1024) ? intval($rows[$i]['size'] / 1024) : 1;
            }
            $rows = array_reverse($rows);
            $result = array(
                'rows' => $rows,
                'total' => $count,
            );
            $this->success('', '', $result);
        }
    }

    public function showsql()
    {
        if (request()->isGet()) {
            $backup_path = \ebcms\Config::get('system.backup_path');
            $filename = input('filename');
            $this->assign('filename', $filename);
            $filename = $backup_path . DS . 'db' . DS . $filename;
            if (!is_file($filename)) {
                $this->error('文件不存在！');
            }
            $ext = pathinfo($filename, PATHINFO_EXTENSION);
            if ($ext == 'gz') {
                $gz = gzopen($filename, 'r');
            } else {
                $gz = fopen($filename, 'r');
            }
            $sql = '';
            for ($i = 0; $i < 70; $i++) {
                $sql .= ($ext == 'gz') ? gzgets($gz) : fgets($gz);
                if (($ext == 'gz') ? gzeof($gz) : feof($gz)) {
                    break;
                }
            }
            if (($ext == 'gz') ? !gzeof($gz) : !feof($gz)) {
                $sql .= "\r\n<p class='text-danger'>后面还有更多内容，若需要请下载到本地查看</p>";
            }
            $this->assign('sql', $sql);
            $this->success('', '', $this->fetch());
        }
    }

    // 还原数据库
    public function imports()
    {
        $config = \ebcms\Config::get('system.backup_db');
        $backup_path = \ebcms\Config::get('system.backup_path');
        $backup_config = array_merge([
            'path' => $backup_path . DS . 'db' . DS,
            'part' => 2048000,
            'compress' => false,
            'hostname' => config('database.hostname'),
            'port' => config('database.port'),
            'database' => config('database.database'),
            'level' => 4], $config);
        $lock = $backup_config['path'] . 'backup.lock';
        if (request()->isGet()) {
            $filename = $backup_config['path'] . input('filetime') . '-*.sql*';
            $files = glob($filename);
            $list = array();
            foreach ($files as $name) {
                $basename = basename($name);
                $match = sscanf($basename, '%4s%2s%2s-%2s%2s%2s-%d');
                $list[$match[6]] = $basename;
            }
            ksort($list);
            $count = count($list);
            end($list);
            session('backup_list', $list);
            $this->assign('backup_list', $list);
            $this->assign('filetime', input('filetime'));
            $this->success('', '', $this->fetch());
        } elseif (request()->isPost()) {
            $input = input();
            if (input('init')) {
                if (!is_file($lock)) {
                    file_put_contents($lock, time());
                } else {
                    $this->error("检测到有一个还原进程正在执行，请稍后再试！若有必要，可手动删除锁定文件：{$lock}");
                }
                $filename = $backup_config['path'] . input('filetime') . '-*.sql*';
                $files = glob($filename);
                $list = array();
                foreach ($files as $name) {
                    $basename = basename($name);
                    $match = sscanf($basename, '%4s%2s%2s-%2s%2s%2s-%d');
                    $list[$match[6]] = $basename;
                }
                ksort($list);
                $count = count($list);
                end($list);
                if (!$count || $count != key($list)) {
                    unlink($lock);
                    session('backup_list', null);
                    $this->error('备份文件可能已经损坏，请检查！');
                }
                if ($list != session('backup_list')) {
                    unlink($lock);
                    session('backup_list', null);
                    $this->error('文件可能有改动！请稍后再试');
                }
                session('backup_list', $list);
                $this->success('下一步', '', array('part' => 1, 'start' => 0, 'initend' => 1));
            } else {
                if (!is_file($lock)) {
                    $this->error('操作错误：还原锁定文件丢失！');
                }
                $list = session('backup_list');
                if (!$list) {
                    unlink($lock);
                    $this->error('没有检测到需要还原的数据！请从新提交！');
                }
                $part = input('part');
                $start = input('start');
                $backup_config['compress'] = (pathinfo($list[$part], PATHINFO_EXTENSION) == 'sql') ? 0 : 1;
                $db = new \ebcms\Database($list[$part], $backup_config);
                $start = $db->import($start);
                if (false === $start) {
                    unlink($lock);
                    $this->error('还原数据出错！');
                } elseif (0 === $start) { //下一卷
                    $part = $part + 1;
                    if (isset($list[$part])) {
                        $data = array('part' => $part, 'start' => 0, 'rate' => 0);
                        $this->success('下一卷', '', $data);
                    } else {
                        unlink($lock);
                        session('backup_list', null);
                        $data = array('part' => $part, 'start' => -1, 'rate' => 0);
                        $this->success('', '', $data);
                    }
                } else {
                    if ($start[1]) {
                        $data = array('part' => $part, 'start' => $start[0], 'rate' => floor(100 * ($start[0] / $start[1])));
                        $this->success('', '', $data);
                    } else {
                        $data = array('part' => $part, 'start' => $start[0], 'rate' => 0);
                        $this->success('', '', $data);
                    }
                }
            }
        }
    }

    // 删除备份数据
    public function delete()
    {
        if (request()->isPost()) {

            $backup_path = \ebcms\Config::get('system.backup_path');
            $pattern = $backup_path . DS . 'db' . DS . input('time') . '-*.' . input('ext');
            $list = glob($pattern);
            if (count($list) != input('parts')) {
                $this->error('数据校验失败！');
            }
            foreach ($list as $key => $value) {
                @unlink($value);
            }
            $this->success('删除成功！');
        }
    }

    // 优化表
    public function optimize()
    {
        if (request()->isPost()) {
            $tables = input('table');
            $tables = explode(',', $tables);
            if ($tables) {
                if (is_array($tables)) {
                    $tables = implode('`,`', $tables);
                    $list = \think\Db::query('OPTIMIZE TABLE `' . $tables . '`');
                    if ($list) {
                        $this->success('数据表优化完成！');
                    } else {
                        $this->error('数据表优化出错请重试！');
                    }
                }
            } else {
                $this->error('请指定要优化的表！');
            }
        }
    }

    // 修复表
    public function repair()
    {
        if (request()->isPost()) {
            $tables = input('table');
            $tables = explode(',', $tables);
            if ($tables) {
                if (is_array($tables)) {
                    $tables = implode('`,`', $tables);
                    $list = \think\Db::query('REPAIR TABLE `' . $tables . '`');
                    if ($list) {
                        $this->success('数据表修复完成！');
                    } else {
                        $this->error('数据表修复出错请重试！');
                    }
                }
            } else {
                $this->error('请指定要修复的表！');
            }
        }
    }

    // 查看创建信息
    public function showcreate()
    {
        if (request()->isPost()) {
            $table = input('table');
            $data = \think\Db::query("SHOW CREATE TABLE `{$table}`");
            $data[0] = array_change_key_case($data[0], CASE_LOWER);
            $result = array(
                'table' => $data[0]['table'],
                'tableinfo' => $data[0]['create table'],
            );
            $this->success('获取成功', '', $result);
        }
    }

    // 备份数据库
    public function exports()
    {

        $config = \ebcms\Config::get('system.backup_db');
        $backup_path = \ebcms\Config::get('system.backup_path');
        $backup_config = array_merge([
            'path' => $backup_path . DS . 'db' . DS,
            'part' => 2048000,
            'compress' => false,
            'hostname' => config('database.hostname'),
            'port' => config('database.port'),
            'database' => config('database.database'),
            'level' => 4], $config);
        $lock = $backup_config['path'] . 'backup.lock';
        if (request()->isGet()) {
            $tables = input('tables');
            $tables = explode(',', $tables);
            if (!is_dir($backup_config['path'])) {
                if (is_writable(dirname($backup_config['path']))) {
                    mkdir($backup_config['path'], 0755, true);
                } else {
                    $this->error('无法创建目录：' . $backup_config['path'] . '，请检查权限');
                }
            } elseif (!is_writeable($backup_config['path'])) {
                $this->error('备份目录不存在或不可写，请检查后重试！');
            }
            if (is_array($tables)) {
                $this->assign('tables', $tables);
                session('backup_tables', $tables);
                $this->success('获取成功', '', $this->fetch());
            } else {
                $this->error('参数错误！');
            }
        } elseif (request()->isPost()) {
            $step = input('step');
            switch ($step) {
                //检查是否有正在执行的备份任务
                case 0:
                    if (!session('?backup_tables')) {
                        $this->error('没有检测到需要备份的数据库表！请从新提交！');
                    }
                    if (is_file($lock)) {
                        $this->error("检测到有一个备份任务正在执行，请稍后再试！若有必要，可手动删除锁定文件：{$lock}");
                    } else {
                        //创建锁文件
                        file_put_contents($lock, time());
                        session('backup_step', $step + 1);
                        $this->success('下一步', '', array('step' => $step + 1));
                    }
                    break;

                // 创建备份文件
                case 1:
                    if (!is_file($lock)) {
                        $this->error('操作错误：备份锁定文件丢失！');
                    }
                    if (session('backup_step') != $step) {
                        unlink($lock);
                        session('backup_step', null);
                        $this->error('步骤错误！');
                    }
                    //生成备份文件信息
                    $file = array(
                        'name' => date('Ymd-His', time()),
                        'part' => 1,
                    );
                    session('backup_file', $file);

                    //创建备份文件
                    $database = new \ebcms\Database($file, $backup_config);
                    if (false !== $database->create()) {
                        session('backup_step', $step + 1);
                        $tables = session('backup_tables');
                        $table = array_shift($tables);
                        session('backup_tables', $tables);
                        $this->success('下一步', '', array('step' => $step + 1, 'table' => $table, 'start' => 0, 'rate' => 0));
                    } else {
                        unlink($lock);
                        $this->error('初始化失败，备份文件创建失败！');
                    }
                    break;

                case 2:
                    if (!is_file($lock)) {
                        $this->error('操作错误：备份锁定文件丢失！');
                    }
                    if (session('backup_step') != $step) {
                        unlink($lock);
                        session('backup_step', null);
                        $this->error('步骤错误！');
                    }
                    $table = input('table');
                    $start = input('start');
                    $database = new \ebcms\Database(session('backup_file'), $backup_config);
                    $start = $database->backup($table, $start);
                    if (false === $start) { //出错
                        unlink($lock);
                        $this->error('备份出错！');
                    } elseif (0 === $start) { //下一表
                        if (session('backup_tables')) {
                            $tables = session('backup_tables');
                            $pretable = $table;
                            $table = array_shift($tables);
                            session('backup_tables', $tables);
                            $data = array(
                                'step' => $step,
                                'pretable' => $pretable,
                                'table' => $table,
                                'start' => 0,
                                'rate' => 0,
                            );
                            $this->success('下一步', '', $data);
                        } else { //备份完成，清空缓存
                            unlink($lock);
                            session('backup_tables', null);
                            session('backup_step', null);
                            session('backup_file', null);
                            session('backup_config', null);
                            $this->success('下一步', '', array('step' => $step + 1, 'table' => $table, 'rate' => 100));
                        }
                    } else {
                        $data = array(
                            'step' => $step,
                            'table' => $table,
                            'start' => $start[0],
                            'rate' => floor(100 * ($start[0] / $start[1])),
                        );
                        $this->success('下一步', '', $data);
                    }

                    break;

                default:
                    # code...
                    break;
            }
        }
    }

}