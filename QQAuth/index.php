<?php
if(isset($_GET['code'])){
	// 从 URL 中取得主机名
	$matches = array();
	preg_match("/^(http:\/\/)?([^\/]+)/i", $_GET['source_url'], $matches);
	$host = $matches[2];
	if(empty($_GET['source_url'])){
		$host = 'www.long7.com';
	}
	Header("HTTP/1.1 303 See Other");
	
	Header("Location: http://".$host."/index/auth/qqLogin?code=".$_GET['code']."&source=".$_GET['source_url']);exit;
}else{
	echo 'NO CODE';
}
