<?php
if(isset($_GET['code'])){
	// 从 URL 中取得主机名
	$matches = array();
	preg_match("/^(http:\/\/)?([^\/]+)/i", $_GET['source'], $matches);
	$host = $matches[2];
	Header("HTTP/1.1 303 See Other");
	Header("Location: http://".$host."/index/auth/mobile_auth?code=".$_GET['code']."&source=".$_GET['source']);exit;
}else{
	echo 'NO CODE';
}
