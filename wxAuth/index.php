<?php
if(isset($_GET['code'])){
	Header("HTTP/1.1 303 See Other");
	Header("Location: http://www.long7.com/index/auth/mobile_auth?code=".$_GET['code']."&source=".$_GET['source']);exit;
}else{
	echo 'NO CODE';
}
