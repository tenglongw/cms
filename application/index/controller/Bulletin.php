<?php
namespace app\index\controller;
class Bulletin extends \app\index\controller\Common
{

    public function index()
    {
        if (request()->isGet()) {
            // 位置
            \ebcms\Position::add(['title' => '公告', 'url' => url('index/bulletin/index')]);

            // seo设置
            $this->assign('seo', [
                'title' => '公告 - ' . $this->seo['sitename'],
                'keywords' => '公告',
                'description' => '公告',
            ]);

            $pagenum = \ebcms\Config::get('bulletin.pagenum');
            $lists = \app\bulletin\model\Bulletin::where(['status' => 1])->order('id desc')->paginate($pagenum ?: 20);
            $this->assign('page', $lists->render());
            $this->assign('lists', $lists);

            return $this->fetch();
        }
    }

    public function detail($id)
    {
        if (request()->isGet()) {
            $data = \app\bulletin\model\Bulletin::get($id);

            if (!$data) {
                $this->error('内容不存在！');
            }
            if (1 != $data['status']) {
                $this->error('内容未审核！');
            }

            if ($data['ebcms_url']) {
                $this->redirect(htmlspecialchars_decode($data['ebcms_url']), 302);
            }

            // 位置
            \ebcms\Position::add(['title' => '公告', 'url' => url('index/bulletin/index')]);
            \ebcms\Position::add(['title' => $data['title'], 'url' => $data['url']]);

            // seo设置
            $this->assign('seo', [
                'title' => $data['metatitle'] . ' - 公告 - ' . $this->seo['sitename'],
                'keywords' => $data['keywords'],
                'description' => $data['description'],
            ]);

            $ext = $data['ext'] ?: [];
            if (isset($ext['__config__'])) {
                unset($ext['__config__']);
            }
            $data->setAttr('ext', $ext);

            $this->assign('bulletin', $data);
            return $this->fetch($data['tpl']);
        }
    }
}