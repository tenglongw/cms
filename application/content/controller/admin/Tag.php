<?php
namespace app\content\controller\admin;
class Tag extends \app\admin\controller\Common
{

    public function index()
    {
        if (request()->isGet()) {
            $this->success('', '', $this->fetch());
        }
    }
    

    public function add()
    {
        if (request()->isGet()) {
            $this->fetchform();
        } elseif (request()->isPost()) {

            if (\think\Db::name('content_tag')->where('tag', 'eq', input('tag'))->find()) {
                $this->error('当前标签已经存在！');
            }

            $this->ebadd();
        }
    }

    public function edit()
    {
        if (request()->isGet()) {
            $this->ebedit();
        } elseif (request()->isPost()) {

            $where = [
                'id' => ['neq', input('id')],
                'tag' => ['eq', input('tag')],
            ];
            if (\think\Db::name('content_tag')->where($where)->find()) {
                $oldtag = \think\Db::name('content_tag')->find(input('id'));
                $this->error('当前标签已经存在！你要合并到该标签吗？', '', [
                    'action' => 'merges',
                    'namespace' => ns(),
                    'param' => [
                        'tag1' => $oldtag['tag'],
                        'tag2' => input('tag'),
                    ],
                ]);
            }

            $this->ebedit();
        }
    }

    // 改变标签样式
    public function style()
    {
        if (request()->isPost()) {
            $config = [
                'allowfield' => ['bold', 'size', 'color'],
                'validate_scene' => 'style',
            ];
            $this->ebedit($config);
        }
    }

    public function delete()
    {
        if (request()->isPost()) {
            $config = [
                'relation' => [
                    'content' => [
                        'type' => 'manytomany',
                    ],
                ],
            ];
            $this->ebdelete($config);

        }
    }

    // 标签合并
    public function merge()
    {
        if (request()->isGet()) {
            $this->fetchform();
        } elseif (request()->isPost()) {

            $tag1 = str_replace(' ', ',', input('tag1'));
            $tag1 = array_unique(explode(',', $tag1));
            if (false !== $key = array_search('', $tag1)) {
                unset($tag1[$key]);
            }

            $tag2 = str_replace(' ', ',', input('tag2'));
            $tag2 = array_unique(explode(',', $tag2));
            $tag2 = $tag2[0];

            if ($tag1 && $tag2 && $tag1[0] != $tag2) {

                // 获取tag1的ids
                $where = [];
                // 排除锁定项
                if (true != session('super_admin')) {
                    $where['locked'] = array('eq', 0);
                }
                $where['tag'] = ['in', $tag1];
                if ($tag1_ids = \think\Db::name('content_tag')->where($where)->column('id')) {

                    // 判断tag2是否存在，不存在就创建
                    if (!$tag2_id = \think\Db::name('content_tag')->where(['tag' => $tag2])->value('id')) {
                        // 创建tag2 并获取其id
                        $data = [
                            'tag' => $tag2,
                            'count' => 0,
                        ];
                        $tag = new \app\content\model\Tag();
                        $tag->allowField(true)->save($data);
                        $tag2_id = $tag->db()->getLastInsID();
                    }

                    // 获取内容id集
                    $tag_ids = $tag1_ids;
                    $tag_ids[] = $tag2_id;
                    $c_ids = \think\Db::name('content_tags')->where('tag_id', 'in', $tag_ids)->column('c_id');
                    $c_ids = array_unique($c_ids);

                    // 如果有关联内容id的话就删掉管理数据并添加新数据
                    if ($c_ids) {
                        // 删除旧数据 关联表
                        \think\Db::name('content_tags')->where('tag_id', 'in', $tag_ids)->delete();
                        // 插入新数据 关联表
                        $ins = [];
                        foreach ($c_ids as $value) {
                            $ins[] = [
                                'tag_id' => $tag2_id,
                                'c_id' => $value,
                            ];
                        }
                        \think\Db::name('content_tags')->insertAll($ins);
                        // 更新tag表
                        \think\Db::name('content_tag')->where(['id' => $tag2_id])->setField('count', count($c_ids));
                    }
                    // 删除旧数据
                    \think\Db::name('content_tag')->where(['id' => ['in', $tag1_ids]])->delete();
                    $this->success('合并成功！');
                }
            }
            $this->error('操作失败！');
        }
    }

    public function status()
    {
        // return;
    }

}