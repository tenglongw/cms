<?php
namespace app\admin\controller;
class Tongji extends \app\admin\controller\Common
{

    public function index()
    {
        if (request()->isGet()) {
            $tpl = input('type') == 2 ? 'type2' : 'type1';
            $this->success('', '', $this->fetch($tpl));
        } elseif (request()->isPost()) {
            $rows = input('rows', 0, 'intval') ?: 1000;
            $where = [];
            if ($times = input('times')) {
                switch ($times) {
                    case 'jinri':
                        $start = strtotime(date('Y-m-d'));
                        $where = [
                            'create_time' => ['between', [$start, time()]],
                        ];
                        break;
                    case 'zuori':
                        $start = strtotime(date('Y-m-d') . ' -1 days');
                        $end = strtotime(date('Y-m-d'));
                        $where = [
                            'create_time' => ['between', [$start, $end]],
                        ];
                        break;
                    case 'benzhou':
                        $date = date('Y-m-d');
                        $w = date('w', strtotime($date));
                        $start = strtotime("$date -" . ($w ? $w - 1 : 6) . ' days');
                        $where = [
                            'create_time' => ['between', [$start, time()]],
                        ];
                        break;
                    case 'shangzhou':
                        $date = date('Y-m-d');
                        $w = date('w', strtotime($date));
                        $end = strtotime("$date -" . ($w ? $w - 1 : 6) . ' days');
                        $start = $end - 7 * 24 * 3600;
                        $where = [
                            'create_time' => ['between', [$start, $end]],
                        ];
                        break;

                    default:
                        if ($times && is_numeric($times)) {
                            $where = [
                                'create_time' => ['gt', time() - 3600 * 24 * $times]
                            ];
                        }
                        break;
                }
            }
            $result = \think\Db::name('tongji')->group('url,title')->where($where)->field('count(*) as num,url,title')->order('num desc')->paginate($rows, true);
            
            $result_total = \think\Db::name('tongji')->where($where)->field('count(*) as total')->select();
            $result = $result->toArray();
            $result['rows']['data'] = $result['data'];
            $result['rows']['total_num'] = $result_total[0]['total'];
            unset($result['data']);

            $this->success('获取成功！', '', $result);
        }
    }

    public function delete()
    {
        if (request()->isPost()) {
            $day = input('type', 0, 'intval');
            if ($day) {
                $end = time() - $day * 24 * 3600;
                $where = [
                    'create_time' => ['between', [0, $end]],
                ];
                if (false !== \think\Db::name('tongji')->where($where)->delete()) {
                    $this->success('删除成功！');
                } else {
                    $this->error('删除失败！');
                }
            }
        }
    }

    public function add()
    {
    }

    public function edit()
    {
    }

    public function status()
    {
    }

    public function resort()
    {
    }

    public function lock()
    {
    }


}