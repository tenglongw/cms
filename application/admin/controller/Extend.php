<?php
namespace app\admin\controller;
class Extend extends \app\admin\controller\Common
{

    public function index()
    {
        $this->assign('group', urldecode(input('group')));
        $this->success('', '', $this->fetch());
    }

    public function add()
    {
        if (request()->isGet()) {
            $this->fetchform();
        } elseif (request()->isPost()) {
            $this->ebadd();
        }
    }

    public function edit()
    {
        $this->ebedit();
    }

    public function delete()
    {
        if (request()->isPost()) {
            $config = [
                'relation' => [
                    'extendfield' => [
                        'type' => 'hasmany',
                    ],
                ],
            ];
            $this->ebdelete($config);
        }
    }

}