<?php
namespace app\index\controller;
class Space extends \app\index\controller\Common
{

    // 空间首页
    public function index($id)
    {
        if (request()->isGet()) {
            if ($user = \think\Db::name('user')->find($id)) {

                // 位置
                \ebcms\Position::add(['title' => $user['nickname'], 'url' => url('index/space/index', ['id' => $id])]);

                // seo设置
                $this->assign('seo', [
                    'title' => $user['nickname'] . ' - ' . $this->seo['sitename'],
                    'keywords' => $user['nickname'] . '的个人中心',
                    'description' => $user['nickname'] . '的个人中心',
                ]);

                if (1 != $user['status']) {
                    $this->error('用户被锁定！');
                }

                $this->assign('user', $user);
                return $this->fetch();
            } else {
                $this->error('用户不存在！');
            }
        }
    }

}