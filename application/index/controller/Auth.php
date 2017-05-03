<?php
namespace app\index\controller;
require_once(QQ_CLASS_PATH."API/class/QC.class.php");
class Auth extends \app\index\controller\Common
{

    // 登录
    public function login()
    {
        // 登陆页面
        if (request()->isGet()) {
            if (!session('?go')) {
                if (input('?server.HTTP_REFERER')) {
                    session('go', input('server.HTTP_REFERER'));
                }
            }
            // 位置
            \ebcms\Position::add(['title' => '登录', 'url' => url('index/auth/login')]);
            // seo设置
            $this->assign('seo', [
                'title' => '登录 - ' . $this->seo['sitename'],
                'keywords' => '登录',
                'description' => '登录',
            ]);
            return $this->fetch();
        } elseif (request()->isPost()) {
            // 验证验证码
            if (\ebcms\Config::get('user.login_verify')) {
                $verify = new \org\Verify([]);
                if (!$verify->check(input('verify'), 1)) {
                    $this->error('验证码错误！');
                }
            }
            // 读取该账户
            $where = array(
                'email' => input('email'),
            );
            $m = new \app\admin\model\User();
            if ($user = $m->where($where)->find()) {
                // 判断账户状态
                if ($user['status'] != 1) {
                    $this->error('账户未通过审核！');
                }

                // 判断密码是否正确
                if ($user['password'] !== crypt_pwd(input('password'), $user['salt'])) {
                    $this->error('密码不匹配！');
                }

                // 更新数据库
                $data = array(
                    'login_ip' => request()->ip(),
                    'login_time' => time(),
                    'id' => $user['id'],
                    'login_times' => $user['login_times'] + 1
                );
                $user->save($data);
                $url = session('?go') ? session('go') : url('index/index/index');
                // 清空session
                \think\Session::clear();
                // 超级管理员识别
                if ($user['email'] == config('super_admin')) {
                    session('super_admin', true);
                }
                // 写入新session
                session('user_id', $user['id']);
                session('user_email', $user['email']);
                session('user_nickname', $user['nickname']);
                session('user_avatar', $user['avatar']);
                session('user_notice', $user['notice']);
                \think\Session::clear('go');
                $this->success('登陆成功!', $url);
            } else {
                $this->error('该邮箱未注册！');
            }

        }
    }
    
    public function wechat(){
    	include('Wechat.php');
    	$wechat = new \Wechat();
    	$result = $wechat->valid();
    	print($result);exit;
    }
    
    public function getSignPackage(){
    	include('JSSDK.php');
    	$jssdk = new \JSSDK('wx037f50b90883a846', '077b8f55057c5a6ca0ab7c6544bd1944');
    	$data = $jssdk->getSignPackage();
    	$result['data'] = $data;
    	echo json_encode($result);exit;
    }
    
    public function qqCallBack(){
    	if (isset($_GET['code'])){
    		$qc = new \QC();
    		$acess_toke = $qc->get_access_token();
    		echo print_r($acess_toke);exti;
    		if($acess_toke){
    			$openid = $qc->get_openid();
//     			$userInfo = $jssdk->getUserInfo($res['access_token'],$res['openid']);
//     			$id = $this->updateUserInfo($userInfo);
    			// 清空session
    			\think\Session::clear();
    			// 写入新session
//     			session('user_id', $id);
//     			session('user_nickname', $row['nickname']);
//     			session('user_avatar', $row['headimgurl']);
//     			$this->assign('user',$row);
    			\think\Session::clear('go');
    			Header("HTTP/1.1 303 See Other");
    		}else{
    			$this->error('授权出错,请重新授权!');
    		}
    	}else{
			echo "NO CODE";
		}
    }
    
    public function mobile_auth(){
    	include('class_weixin_adv.php');
    	$weixin= new \class_weixin_adv("wx037f50b90883a846", "077b8f55057c5a6ca0ab7c6544bd1944");
    	$source = $_GET['source'];
    	if (isset($_GET['code'])){
    		$url="https://api.weixin.qq.com/sns/oauth2/access_token?appid=wx037f50b90883a846&secret=077b8f55057c5a6ca0ab7c6544bd1944&code=".$_GET['code']."&grant_type=authorization_code";
    		$res = $weixin->https_request($url);
    		$res=(json_decode($res, true));
    		$row=$weixin->get_user_info($res['openid'],$res['access_token']);
    		if ($row['openid']) {
    			$id = $this->updateUserInfo($row);
    			// 清空session
    			\think\Session::clear();
    			// 写入新session
    			session('user_id', $id);
    			session('user_nickname', $row['nickname']);
    			session('user_avatar', $row['headimgurl']);
    			$this->assign('user',$row);
    			\think\Session::clear('go');
    			Header("HTTP/1.1 303 See Other");
    			Header("Location: $source");exit;
    		}else{
    			$this->error('授权出错,请重新授权!');
    		}
    	}else{
    		echo "NO CODE";
    	}
    	
    	
    	$result['data'] = $data;
    	echo json_encode($result);exit;
    }
    
    public function qqLogin(){
    	include('QQSDK.php');
    	$qqsdk = new \QQSDK();
    	$source = $_GET['source'];
    	if(empty($source)){
    		$source = 'http://www.long7.com';
    	}
    	if (isset($_GET['code'])){
    		$token = $qqsdk->get_access_token($_GET['code']);
    		$openid = $qqsdk->get_open_id($token['access_token']);
    		if ($openid) {
    			$user = $qqsdk->get_user_info($token['access_token'], $openid['openid']);
    			$row = array();
    			$row['nickname'] = $user['nickname'];
    			$row['headimgurl'] = $user['figureurl_qq_2'];
    			$row['openid'] = $openid['openid'];
    			$id = $this->updateUserInfo($row);
    			// 清空session
    			\think\Session::clear();
    			// 写入新session
    			session('user_id', $id);
    			session('user_nickname', $row['nickname']);
    			session('user_avatar', $row['headimgurl']);
    			$this->assign('user',$row);
    			\think\Session::clear('go');
    			Header("HTTP/1.1 303 See Other");
    			Header("Location: $source");exit;
    		}else{
    			$this->error('授权出错,请重新授权!');
    		}
    	}else{
    		echo "NO CODE";
    	}
    	$result['data'] = $data;
    	echo json_encode($result);exit;
    }
    
    public function wxLogin(){
    	include('class_weixin_adv.php');
    	$redirect_uri = 'http://120.26.192.83/index.php/index/auth/wxOauth2';
    	$weixin= new \class_weixin_adv("wx3170b4c5935665b4", "a3a8869b9906d62031d1247ac2165c8f");
    	$result = $weixin->get_request_code($redirect_uri);
    	echo json_encode($result);exit;
    }
    
    public function wxOauth2(){
    	include('class_weixin_adv.php');
	 	$weixin=new \class_weixin_adv("wx4e8abf24c91b1877", "87847ec05e27c907c27733a454509f46");
	 	$source_url = $_GET['source_url'];
	  	if (isset($_GET['code'])){
			$url="https://api.weixin.qq.com/sns/oauth2/access_token?appid=wx4e8abf24c91b1877&secret=87847ec05e27c907c27733a454509f46&code=".$_GET['code']."&grant_type=authorization_code";
			$res = $weixin->https_request($url);
			$res=(json_decode($res, true));
			$row=$weixin->get_user_info($res['openid'],$res['access_token']);
			if ($row['openid']) {
				$id = $this->updateUserInfo($row);
				// 清空session
				\think\Session::clear();
				// 写入新session
				session('user_id', $id);
				session('user_nickname', $row['nickname']);
				session('user_avatar', $row['headimgurl']);
				$this->assign('user',$row);
				\think\Session::clear('go');
				Header("HTTP/1.1 303 See Other");
				Header("Location: $source_url");exit;
			}else{
				$this->error('授权出错,请重新授权!');
			}
		}else{
			echo "NO CODE";
		}
		
    }

    public function updateUserInfo($row){
//     	$row = array('openid'=>'oSTsMwaUM8KkEHCeTNK5fwLdLIhI','nickname'=>'王腾龙','sex'=>'1','language'=>'zh_CN','city'=>'Chaoyang','province'=>'Beijing','country'=>'CN','headimgurl'=>'http://wx.qlogo.cn/mmopen/ajNVdqHZLLBa8ANAFMKbLhkNM7ytiaibfibj86IByDD6SelTsiatxKLvEKrMJ7atC3SeIK12UsGsvgU795uNUqVujw/0','unionid'=>'oFezHw3mKkyA0ClTemz_AsK-6-WQ');
    	$m = \think\Db::name('user');
    	
    	$where = array(
    			'openid' => $row['openid'],
    	);
    	$m1 = new \app\admin\model\User();
    	if ($user = $m1->where($where)->find()) {
    		//修改用户信息
    		$data1 = array(
    				'login_time' => time(),
    				'id' => $user['id'],
    				'login_times' => $user['login_times'] + 1,
    				'nickname' => $row['nickname'],
    				'avatar' => $row['headimgurl']
    		);
    		$user->save($data1);
    		
    		$id = $user['id'];
    	}else{
    		//新增
    		$salt = md5(rand());
    		$data = array(
    				'nickname' => $row['nickname'],
    				'email' => 'weixin@qq.com',
    				'avatar' => $row['headimgurl'],
    				'openid' => $row['openid'],
    				'salt' => 'weixin',
    				'password' => crypt_pwd($row['nickname'], $salt),
    				'create_time' => time(),
    		);
    		$id = $m->insertGetId($data);
    		if (!$id) {
    			$this->error($m->getDbError());
    		}
    		// 添加默认角色
    		\think\Db::name('auth_access')->insert(['uid' => $id, 'group_id' => \ebcms\Config::get('user.reg_group')]);
    	}
    	return $id;
    }
    
    // 退出
    public function logout()
    {
        if (request()->isGet()) {
            \think\Session::clear();
            $this->success('退出成功');
        }
    }

    // 注册
    public function reg()
    {
        if (!\ebcms\Config::get('user.reg_on')) {
            $this->error('系统关闭新注册！');
        }
        if (request()->isGet()) {
            \ebcms\Position::add(['title' => '注册', 'url' => url('index/auth/reg')]);
            // seo设置
            $this->assign('seo', [
                'title' => '注册 - ' . $this->seo['sitename'],
                'keywords' => '注册',
                'description' => '注册',
            ]);
            if ($code = input('code')) {
                if ($email = \ebcms\Crypt::decode(base64_decode($code), config('safe_code'))) {
                    $m = \think\Db::name('user');
                    $password = substr(md5(rand(10000, 99999)), 0, 8);
                    // 判断是否已经注册
                    if ($m->where(['email' => $email])->find()) {
                        $this->error('该邮箱已经注册过了！', url('index/index/index'));
                    }
                    // 添加用户
                    $salt = md5(rand());
                    $data = array(
                        'nickname' => $email,
                        'email' => $email,
                        'salt' => $salt,
                        'password' => crypt_pwd($password, $salt),
                        'create_time' => time(),
                    );
                    if (!$id = $m->insertGetId($data)) {
                        $this->error($m->getDbError());
                    }
                    // 添加默认角色
                    \think\Db::name('auth_access')->insert(['uid' => $id, 'group_id' => \ebcms\Config::get('user.reg_group')]);
                    // 发送注册成功信息！
                    $tpldata = array(
                        'email' => $email,
                        'password' => $password,
                    );
                    // 尊敬的会员，你好，你注册的邮箱是 {email} 密码是 {password} 请妥善保管！ 谢谢！
                    $str = str_preg_parse(\ebcms\Config::get('user.reg_success'), $tpldata);
                    if (!sendmail($email, '尊敬的用户', '会员信息', $str)) {
                        sendmail($email, '尊敬的用户', '会员信息', $str);
                    }

                    $url = session('?go') ? session('go') : url('index/index/index');
                    // 清空session
                    \think\Session::clear();
                    // 写入新session
                    session('user_id', $id);
                    session('user_email', $email);
                    session('user_avatar', '');
                    session('user_nickname', $email);
                    // 超级管理员识别
                    if ($email == config('super_admin')) {
                        session('super_admin', true);
                    }
                    if ($url) {
                        $this->success('恭喜你注册成功！', $url);
                    } else {
                        $this->assign('email', $email);
                        $this->assign('password', $password);
                        return $this->fetch('reg_2');
                    }
                }
            }
            if (session('?reg_send')) {
                return $this->fetch('reg_1');
            }
            if (!session('?go')) {
                if (input('?server.HTTP_REFERER')) {
                    session('go', input('server.HTTP_REFERER'));
                }
            }
            return $this->fetch('reg_0');
        } elseif (request()->isPost()) {

            // 验证验证码
            if (\ebcms\Config::get('user.reg_verify')) {
                $verify = new \org\Verify();
                if (!$verify->check(input('verify'), 1)) {
                    $this->error('验证码错误!');
                }
            }

            $email = input('email');
            // 判断是否是邮箱
            // 判断是否已经注册
            $_where = array(
                'email' => array('eq', $email),
            );
            if (\think\Db::name('user')->where($_where)->find()) {
                $this->error('该邮箱已经注册，请登录！');
            }

            // 发送连接到邮箱
            $params = array(
                'code' => base64_encode(\ebcms\Crypt::encode($email, config('safe_code'), 3600 * 24)),
            );
            $url = request()->domain() . url('index/auth/reg', $params);
            // 你的注册链接地址是： {url} 点击链接或复制到浏览器打开即可注册成功！
            $str = str_preg_parse(\ebcms\Config::get('user.reg_url'), array('url' => $url));
            if (sendmail($email, '尊敬的用户', '注册连接', $str)) {
                session('reg_send', true);
                $this->success('你好，注册连接已经发送到您的邮箱，请登录邮箱完成注册！', url('index/auth/reg'));
            } else {
                $this->error('邮件发送失败！请联系管理员！');
            }
        }
    }

    // 找回密码
    public function password()
    {
        if (request()->isGet()) {
            \ebcms\Position::add(['title' => '找回密码', 'url' => url('index/auth/password')]);
            // seo设置
            $this->assign('seo', [
                'title' => '找回密码 - ' . $this->seo['sitename'],
                'keywords' => '找回密码',
                'description' => '找回密码',
            ]);
            if ($code = input('code')) {
                if ($code = \ebcms\Crypt::decode(base64_decode($code), config('safe_code'))) {

                    $safe_code = substr($code, 0, 32);
                    $email = substr($code, 33);

                    // 获取安全码
                    $_where = array(
                        'email' => array('eq', $email),
                    );
                    if (!$user = \think\Db::name('user')->where($_where)->find()) {
                        $this->error('非法操作！');
                    }
                    if (!$user['safe_code'] || $safe_code != $user['safe_code']) {
                        $this->error('非法操作！');
                    }
                    session('re_password', true);
                    session('re_id', $user['id']);
                    return $this->fetch('password_success');
                }

            } else {
                if (!session('?go')) {
                    if (input('?server.HTTP_REFERER')) {
                        session('go', input('server.HTTP_REFERER'));
                    }
                }
                return $this->fetch('password');
            }
        } elseif (request()->isPost()) {

            // 验证验证码
            if (\ebcms\Config::get('user.password_verify')) {
                $verify = new \org\Verify([]);
                if (!$verify->check(input('verify'), 1)) {
                    $this->error('验证码错误！');
                }
            }

            if (session('?re_password') && session('re_password')) {
                $password = input('password');
                if (input('password') != input('password2')) {
                    $this->error('两次密码输入不一致!');
                }
                if (strlen($password) < 6 || strlen($password) > 10) {
                    $this->error('密码长度请控制在6-10位!');
                }
                $_where = array(
                    'id' => array('eq', session('re_id')),
                );
                $salt = md5(rand());
                if (false !== \think\Db::name('user')->where($_where)->update(['password' => crypt_pwd($password, $salt), 'salt' => $salt])) {
                    // 清除安全操作码
                    \think\Db::name('user')->where($_where)->setField('safe_code', '');
                    // 读取跳转url
                    $url = session('?go') ? session('go') : url('index/index/index');
                    // 设置session
                    $user = \think\Db::name('user')->find(session('re_id'));
                    // 清空session
                    \think\Session::clear();
                    session('user_id', $user['id']);
                    session('user_email', $user['email']);
                    session('user_avatar', $user['avatar']);
                    session('user_nickname', $user['nickname']);
                    $this->success('密码修改成功！', $url);
                } else {
                    $this->error('密码修改失败！');
                }
            } else {

                // 发送连接
                $email = input('email');
                $_where = array(
                    'email' => array('eq', $email),
                );
                if (!$data = \think\Db::name('user')->where($_where)->find()) {
                    $this->error('你的邮箱输入有误，请确认是否正确！');
                }

                // 禁止超级管理员找回密码
                if ($data['email'] == config('super_admin')) {
                    $this -> error('超级管理员禁止找回密码！忘记密码请到官网下载密码找回工具！');
                }

                // 更新safe_code
                $safe_code = md5(rand());
                \think\Db::name('user')->where($_where)->setField('safe_code', $safe_code);

                // 发送连接到邮箱
                $pars = array(
                    'code' => base64_encode(\ebcms\Crypt::encode($safe_code . '_' . $email, config('safe_code'), 3600 * 24)),
                );
                $url = request()->domain() . url('index/auth/password', $pars);
                // 尊敬的会员，你好，点击下面的连接找回密码 {url} 谢谢！
                $str = str_preg_parse(htmlspecialchars_decode(\ebcms\Config::get('user.password_url')), array('url' => $url));
                if (sendmail($email, '尊敬的用户', '找回密码', $str)) {
                    session('password_send', true);
                    $this->success('你好，更改密码连接已经发送到您的邮箱，请登录邮箱完成操作！');
                } else {
                    $this->error('邮件发送失败！请联系管理员！');
                }
            }
        }
    }

    
}