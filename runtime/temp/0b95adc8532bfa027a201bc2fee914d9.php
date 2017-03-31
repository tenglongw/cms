<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:61:"E:\workspace-php\l7cms/application/admin\view\auth\login.html";i:1483436431;}*/ ?>
<!DOCTYPE html>
<html lang="zh-CN" class="bg">
<head>
    <title>欢迎来到内容管理系统</title>
    <meta name="keywords" content="<?php echo $seo['keywords']; ?>">
    <meta name="description" content="<?php echo $seo['description']; ?>">
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
    <!-- Bootstrap -->
    <link href="<?php echo get_root(); ?>/third/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 flowers of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="http://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <script src="<?php echo get_root(); ?>/static/index/js/jquery.min.js"></script>
    <script src="<?php echo get_root(); ?>/third/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo get_root(); ?>/static/core/js/admin.js"></script>
    <script>
        function change_verify(selecter) {
            $("#" + selecter).attr("src", "<?php echo url('index/api/verify'); ?>#" + Math.random());
            return false;
        };
        function login(){
            $.ajax({
                url: '<?php echo url('admin/auth/login'); ?>',
                type: 'POST',
                dataType: 'json',
                data: $('#loginform').serialize(),
                success:function(res){
                    if (res.code) {
                        window.location.href=res.url; 
                    }else{
                        alert(res.msg);
                        change_verify('verifyimage');
                        $('#verify').val('');
                        // $('#loginform')[0].reset();
                    };
                }
            });
            return false;
        };
    </script>
</head>
<body style="margin:0;padding:0;height:100%;background:#022948;">
<div style="width:400px;position:absolute;top:50%;left:50%;margin-left:-200px;margin-top:-250px;overflow:auto;">
    <div class="well well-lg" style="width:100%;margin-bottom:0px;">
        <div class="text-center"><img src="<?php echo get_root(); ?>/static/core/image/logo.png" ></div>
        <br>
        <form id="loginform" onsubmit="return login();">
            <div class="form-group form-group-lg">
                <div class="input-group">
                    <div class="input-group-addon">邮 <span style="color:#eee;">一</span> 箱:</div>
                    <input type="text" name="email" class="form-control" id="email" placeholder="">
                </div>
            </div>
            <div class="form-group form-group-lg">
                <div class="input-group">
                    <div class="input-group-addon">密 <span style="color:#eee;">一</span> 码:</div>
                    <input type="password" name="password" class="form-control" id="password" placeholder="">
                </div>
            </div>
            <div class="form-group form-group-lg">
                <div class="input-group">
                    <div class="input-group-addon">验 证 码:</div>
                    <input type="text" name="verify" class="form-control" id="verify" placeholder="">
                    <div class="input-group-addon" style="width:150px;padding:0px;"><img class="img-rounded" id="verifyimage" onclick="change_verify('verifyimage');" src="<?php echo url('index/api/verify'); ?>" alt="验证码" style="width:150px;height:44px;cursor: pointer; "></div>
                </div>
            </div>
            <hr>
            <button type="submit" class="btn btn-danger btn-lg btn-block">登陆</button>
        </form>
        <br>
        <!-- <p class="text-muted" style="border: 1px #D0D0D0 dotted;padding: 10px;background: #FFF;">易贝内容管理系统是由四川易贝网络科技公司开发，欢迎使用！</p> -->
    </div>
</div>
</body>
</html>