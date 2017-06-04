<?php
namespace app\index\controller;
class Guestbook extends \app\index\controller\Common
{

    public function index()
    {
        if (request()->isGet()) {
            // 位置
            \ebcms\Position::add(['title' => '留言板', 'url' => url('index/guestbook/index')]);

            // seo设置
            $config = \ebcms\Config::get('guestbook');
            $this->assign('seo', [
                'title' => $config['title'] . ' - ' . $this->seo['sitename'],
                'keywords' => $config['keywords'],
                'description' => $config['description'],
            ]);

            $pagenum = \ebcms\Config::get('guestbook.pagenum');
            $lists = \app\admin\model\Guestbook::where(['status' => 1])->order('id desc')->paginate($pagenum ?: 20);
            $this->assign('page', $lists->render());
            $this->assign('lists', $lists);
            return $this->fetch();
        } elseif (request()->isPost()) {
            if (\ebcms\Config::get('guestbook.verify')) {
                // 验证验证码
                $verify = new \org\Verify([]);
                if (!$verify->check(input('verify'), 1)) {
                    $this->error('验证码错误！');
                }
            }

            $guestbook = new \app\admin\model\Guestbook();
            $data = input();
            $data['status'] = \ebcms\Config::get('guestbook.status') ? 1 : 99;
            $guestbook->allowField(['nickname', 'mobile', 'content', 'status'])->save($data);
            $this->success('留言成功！');
        }
    }
}