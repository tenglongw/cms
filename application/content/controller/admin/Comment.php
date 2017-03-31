<?php
namespace app\content\controller\admin;
class Comment extends \app\admin\controller\Common
{

    public function index()
    {
        if (request()->isGet()) {
            $this->success('', '', $this->fetch());
        } elseif (request()->isPost()) {
            if (input('tid')) {
                $lists = \app\content\model\Comment::with('touser,user')->where(['pid' => 0, 'tid' => input('tid')])->order('comment.id', 'desc')->paginate(5);
                $ids = [];
                foreach ($lists as $v) {
                    $ids[] = $v->id;
                }
                $sublists = [];
                if ($ids) {
                    $x = \app\content\model\Comment::with('touser,user')->where(['topid' => ['in', $ids]])->order('comment.id', 'desc')->select();
                    foreach ($x as $key => $v) {
                        $sublists[] = $v->toArray();
                    }
                }
                $this->success('加载成功！', '', [
                    'page' => $lists->render(),
                    'comments' => $lists->toArray(),
                    'subcomments' => $sublists,
                ]);
            }
        }
    }

    public function edit()
    {
        $this->ebedit();
    }

    public function pingbi()
    {
        if (request()->isPost()) {
            $ids = explode(',', input('ids'));
            $value = input('value', 0, 'intval') ? 1 : 0;
            $this->ebfield($ids, 'status', $value);
        }
    }

    public function delete()
    {
        if (request()->isPost()) {
            $this->ebdelete();
        }
    }

}