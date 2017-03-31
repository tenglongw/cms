<?php
namespace app\content\controller\admin;
class Category extends \app\admin\controller\Common
{

    public function index()
    {
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


        if (request()->isGet()) {
            $this->ebedit();
        } elseif (request()->isPost()) {
            $this->ebedit();
        }
    }

    public function delete()
    {
        if (request()->isPost()) {

            $config = [
                'model' => 'category',
                'relation' => [
                    'content' => [
                        'type' => 'hasmany',
                        'sub' => [
                            'model' => 'content',
                            'relation' => [
                                'body' => [
                                    'type' => 'hasone',
                                ],
                                'comment' => [
                                    'type' => 'hasmany',
                                ],
                                'tag' => [
                                    'type' => 'manytomany',
                                ],
                            ],
                        ],
                    ],
                ],
            ];
            $this->ebdelete($config);
        }
    }

    // 此操作不受锁定影响！
    public function merge()
    {
        if (request()->isGet()) {
            $this->fetchform();
        } elseif (request()->isPost()) {
            $ids = array_unique(explode(',', input('ids')));
            $id = input('id');
            if ($ids && $id && !in_array($id, $ids)) {
                // 判断目标栏目是否存在
                if ($category = \think\Db::name('content_category')->find($id)) {
                    // 移动内容
                    \think\Db::name('content_content')->where(['category_id' => ['in', $ids]])->setField('category_id', $id);
                    // 删除栏目
                    \think\Db::name('content_category')->where(['id' => ['in', $ids]])->delete();
                    $this->success('操作成功！');
                }
            }
            $this->error('操作失败！');
        }
    }

    public function status()
    {
        $this->ebstatus();
    }

}