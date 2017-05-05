<?php
session_start();

include_once( 'config.php' );
include_once( 'saetv2.ex.class.php' );

$o = new SaeTOAuthV2( WB_AKEY , WB_SKEY );

if (isset($_REQUEST['code'])) {
	$keys = array();
	$keys['code'] = $_REQUEST['code'];
	$keys['redirect_uri'] = WB_CALLBACK_URL;
	try {
		$token = $o->getAccessToken( 'code', $keys ) ;
	} catch (OAuthException $e) {
	}
}

if ($token) {
	// 从 URL 中取得主机名
	$matches = array();
	preg_match("/^(http:\/\/)?([^\/]+)/i", $_GET['source_url'], $matches);
	$host = $matches[2];
	if(empty($_GET['source_url'])){
		$host = 'www.long7.com';
	}
	Header("HTTP/1.1 303 See Other");
	
	Header("Location: http://".$host."/index/auth/sinaLogin?code=".$_REQUEST['code']."&token=".$token['access_token']);exit;
// 	$c = new SaeTClientV2( WB_AKEY , WB_SKEY , $token['access_token'] );
// 	$ms  = $c->home_timeline(); // done
// 	$uid_get = $c->get_uid();
// 	$uid = $uid_get['uid'];
// 	$user_message = $c->show_user_by_id( $uid);//根据ID获取用户等基本信息
	echo json_encode($user_message);exit;
} else {
?>
授权失败。
<?php
}
?>
