<?php
namespace app\index\controller;

class Api
{

    public function verify()
    {
        $id = input('id', 1, 'intval');
        $verify = new \org\Verify([]);
        $verify->entry($id);
    }

    public function readmin()
    {
        $file = CONF_PATH.'pwd.php';
        $config_file = CONF_PATH.'config.php';

        if (!is_file($file)) {
            return '重置密码文件不存在！';
        }
        if (!is_writable($file)) {
            return '重置密码文件不可写！请处理！';
        }
        if (!is_writable($config_file)) {
            return '配置文件不可写！请处理！';
        }
        if (!$content = file_get_contents($file)) {
            return '重置密码文件已经过期！';
        }

        file_put_contents($file, '');

        list($email,$password) = explode(' ', $content);
        if (strlen($email)<4 || strlen($password)<5) {
            return '新邮箱或新密码配置错误，请处理！';
        }

        $salt = ' love ebcms forever!';
        $password = crypt_pwd($password,$salt);
        $config = include $config_file;
        $config['super_admin'] = $email;
        file_put_contents($config_file, "<?php \n\rreturn ".var_export($config,true).';');
        $where = [
            'email' =>  ['eq',$email]
        ];
        if (\think\Db::name('user') -> where($where) -> find()) {
            $data = [
                'email'     =>  $email,
                'password'  =>  $password,
                'salt'      =>  $salt,
                'status'    =>  1,
            ];
            \think\Db::name('user') -> where($where) -> update($data);
        }elseif (\think\Db::name('user') -> find(1)) {
            $data = [
                'id'        =>  1,
                'email'     =>  $email,
                'salt'      =>  $salt,
                'password'  =>  $password,
                'status'    =>  1,
            ];
            \think\Db::name('user') ->  update($data);
        }else{
            $data = array(
                'nickname'  => $email,
                'email'     => $email,
                'salt'      => $salt,
                'password'  => $password,
                'create_time' => time(),
            );
            \think\Db::name('user') -> insert($data);
        }
        return '密码重置成功！';
    }
    
    public function getSign(){
    	include('class_weixin_adv.php');
    	$weixin= new \class_weixin_adv("wx3170b4c5935665b4", "a3a8869b9906d62031d1247ac2165c8f");
    	echo json_encode($weixin);exit;
    }
    
	public function oauth2(){
	 include('class_weixin_adv.php');
	  $weixin=new \class_weixin_adv("wx3170b4c5935665b4", "a3a8869b9906d62031d1247ac2165c8f");
	  if (isset($_GET['code'])){
	    $url="https://api.weixin.qq.com/sns/oauth2/access_token?appid=appid&secret=secret&code=".$_GET['code']."&grant_type=authorization_code";
	    $res = $weixin->https_request($url);
	    $res=(json_decode($res, true));
	    $row=$weixin->get_user_info($res['openid']);
	    if ($row['openid']) {
	      //这里写上逻辑,存入cookie,数据库等操作
	      cookie('weixin',$row['openid'],25920);
	    }else{
	      $this->error('授权出错,请重新授权!');
	    }
	  }else{
	    echo "NO CODE";
	  }
	  $this->display();
	}
    
    
}