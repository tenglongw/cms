<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:64:"E:\workspace-php\l7cms\templates\default\content\index_news.html";i:1488174970;s:57:"E:\workspace-php\l7cms\templates\default\common\head.html";i:1488795468;s:59:"E:\workspace-php\l7cms\templates\default\common\header.html";i:1489038618;s:59:"E:\workspace-php\l7cms\templates\default\common\footer.html";i:1487844022;}*/ ?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
   	<meta name="renderer" content="Blink">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
    <title>龍柒-<?php if(!(empty($category) || ($category instanceof \think\Collection && $category->isEmpty()))): ?><?php echo $category['title']; else: ?>首页<?php endif; ?></title>
    <link rel="shortcut icon" href="<?php echo get_root(); ?>/favicon.ico" type="image/x-icon" /> 
	<link rel="stylesheet" type="text/css" href="<?php echo get_root(); ?>/static/index/new/css/style.css">
    <script type="text/javascript" src="<?php echo get_root(); ?>/static/index/js/home.js"></script>
	<script type="text/javascript" src="<?php echo get_root(); ?>/static/index/new/js/jquery-1.8.2.min.js"></script>
	<script type="text/javascript" src="<?php echo get_root(); ?>/static/index/new/js/countUp.js"></script>
	<script type="text/javascript" src="<?php echo get_root(); ?>/static/index/new/js/jquery.waypoints.min.js"></script>
    <script type="text/javascript" src="<?php echo get_root(); ?>/static/index/new/js/public.js"></script>
    <script type="text/javascript" src="<?php echo get_root(); ?>/static/index/new/js/share/share.js"></script>
    <link rel="stylesheet" href="<?php echo get_root(); ?>/static/index/new/css/idangerous.swiper.css">
	<script src="<?php echo get_root(); ?>/static/index/new/js/idangerous.swiper.min.js"></script>
	<script>
		var _hmt = _hmt || [];
		(function() {
		  var hm = document.createElement("script");
		  hm.src = "https://hm.baidu.com/hm.js?ed8ac418ac5e06a8c76d9a39d00132c8";
		  var s = document.getElementsByTagName("script")[0]; 
		  s.parentNode.insertBefore(hm, s);
		})();
	</script>
</head>
<body>
	<header id="header">
		<div class="centerCon clearfloat">
			<div class="Logo">
				<a href="#"><img src="<?php echo get_root(); ?>/static/index/new/images/public/Logo.jpg"></a>
			</div>
			<div class="NavAndSearch clearfloat">
				<nav class="clearfloat" id="nav">
				<?php $data = [];$data = \ebcms\Tree::tree(get_content_category()); ?>
					<a name="index" <?php if(('' == $category['id'])): ?> class="active" <?php endif; ?> href="<?php echo url('index/index/index'); ?>">首页</a>
					<?php if(is_array($data) || $data instanceof \think\Collection): if( count($data)==0 ) : echo "" ;else: foreach($data as $key=>$vo): if(($vo['title'] == '专题')): ?>
	                        <a name="<?php echo $vo['name']; ?>" <?php if((10 == $category['id'] || 11 == $category['id'] || 12 == $category['id'])): ?> class="active" <?php endif; ?> href="<?php echo url('/Special/Special'); ?>" ><?php echo $vo['title']; ?></a>
	                        <?php else: if(($vo['title'] == '新闻')): ?>
	                         	<a name="<?php echo $vo['name']; ?>" <?php if(($vo['id'] == $category['id'] || 7 == $category['id'] || 8 == $category['id'] || 9 == $category['id'])): ?> class="active" <?php endif; ?> href="<?php echo $vo['url']; ?>" ><?php echo $vo['title']; ?></a>
	                         	<?php else: if(($vo['title'] == '视频')): ?>
			                         	<a name="<?php echo $vo['name']; ?>" <?php if(($vo['id'] == $category['id'] || 14 == $category['id'] || 15 == $category['id'] || 26 == $category['id'])): ?> class="active" <?php endif; ?> href="<?php echo $vo['url']; ?>" ><?php echo $vo['title']; ?></a>
			                         	<?php else: ?>
					                    <a name="<?php echo $vo['name']; ?>" <?php if(($vo['id'] == $category['id'])): ?> class="active" <?php endif; ?> href="<?php echo $vo['url']; ?>" ><?php echo $vo['title']; ?></a>
			                         <?php endif; endif; endif; endforeach; endif; else: echo "" ;endif; ?>
				</nav>
                     <form id="head_search" class="Search" role="search" method="get" action="<?php echo url('index/content/search'); ?>">
						<input id="SearchInupt" type="text" name="q" >
						<button type="button" id="showSearch" class="iconCn"><i class="iconfont">&#xe63c;</i></button>
					</form>
			</div>
		</div>
	</header>
    <!-- 
        <div class="row">
            <div class="col-md-4">
                <div style="padding:10px;width: 250px;">
                    <img src="<?php echo get_root(); ?>/static/index/image/logo.png">
                </div>
            </div>
            <div class="col-md-8">
            </div>
        </div> -->
        <!-- �Ƿ��¼ -->
        <!-- 
        <?php if(session('?user_id')): ?>
        <li class="dropdown" id="x_userinfo" style="display:none;">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo mb_substr(session('user_nickname'),0,10); ?>&nbsp;<span class="caret"></span></a>
            <ul class="dropdown-menu">
                <li><a href="<?php echo url('index/user/index'); ?>">��Ա����</a></li>
                <li><a href="<?php echo url('index/user/notice'); ?>">��Ϣ&nbsp;<span class="badge"><?php echo \think\Session::get('user_notice'); ?></span></a></li>
                <li role="separator" class="divider"></li>
                <li><a href="<?php echo url('index/auth/logout'); ?>">�˳�</a></li>
            </ul>
        </li>
        <?php else: ?>
        <li id="x_userinfo" style="display:none;"><a href="<?php echo url('index/auth/login'); ?>">��¼</a></li>
        <?php endif; ?>
        <script>
            $(function() {
                $('#x_userinfo').appendTo('#user_info').show();
            });
        </script>
 -->

        <!-- ��ǰλ�� -->
       <!--  <?php $position = \ebcms\Position::get(); if(count($position) > 1): ?>
        <div class="row">
            <div class="col-md-12">
                <ol class="breadcrumb">
                <?php if(is_array($position) || $position instanceof \think\Collection): if( count($position)==0 ) : echo "" ;else: foreach($position as $key=>$vo): ?>
                    <li><a href="<?php echo $vo['url']; ?>"><?php echo $vo['title']; ?></a></li>
                <?php endforeach; endif; else: echo "" ;endif; ?>
                </ol>
            </div>
        </div>
        <?php endif; ?>
         -->
<script type="text/javascript" src="<?php echo get_root(); ?>/static/index/new/js/news_list.js"></script>
<!-- NewsList -->
	<section class="NewsList">
		<div class="centerCon clearfloat">
			<div class="leftC">
				<div class="Na clearfloat">
					<nav id="nav_clearfloat" class="clearfloat">
					<input id='category_id' value="<?php echo $category['id']; ?>" type="hidden">
					<input id='tag_id' value="" type="hidden">
					<?php $data = [];$data = \ebcms\Tree::sub(get_content_category(),'1'); ?>
					<a <?php if(($category['id'] == '1')): ?>
			        		class='active'
			        	<?php endif; ?> href="<?php echo url('../News'); ?>" >最新</a>
				        <?php if(is_array($data) || $data instanceof \think\Collection): if( count($data)==0 ) : echo "" ;else: foreach($data as $key=>$vo): ?>
				         	<a <?php if(($category['id'] == $vo['id'])): ?>
			        		class='active'
			        	<?php endif; ?> href="<?php echo $vo['url']; ?>" ><?php echo $vo['title']; ?></a>
				        <?php endforeach; endif; else: echo "" ;endif; ?>
					</nav>
					<div class="line"><span></span></div>
					<ul id="tag_list">
					</ul>
				</div>
				<?php $data = [];$_where = [];$_where['mark'] = ['eq','news_advice'];$_where['status'] = ['eq',1];if($_cate = \app\admin\model\Recommendcate::where($_where) -> find()){ $data = $_cate -> recommend()  -> order('sort desc,id desc') -> limit('5') -> where('status',1) -> select(); } if(is_array($data) || $data instanceof \think\Collection): if( count($data)==0 ) : echo "" ;else: foreach($data as $key=>$vo): ?>
					<div class="linkImg">
						<a href="<?php echo $vo['url']; ?>"><img src="<?php echo thumb($vo['thumb'],240,320); ?>"></a>
					</div>
	 			<?php endforeach; endif; else: echo "" ;endif; ?>
				
			</div>

			<div class="RightC">
				<ul class="newslistN">
				<?php if(is_array($lists) || $lists instanceof \think\Collection): if( count($lists)==0 ) : echo "" ;else: foreach($lists as $key=>$vs): ?>
                            <li>
								<a target="_blank" class="clearfloat" href="<?php echo $vs['url']; ?>">
									<div class="imgC"><img src="<?php echo thumb($vs['thumb'],0,0); ?>"></div>
									<div class="word">
										<div class="zhuoz">
										<?php if(is_array($tag_list) || $tag_list instanceof \think\Collection): if( count($tag_list)==0 ) : echo "" ;else: foreach($tag_list as $key=>$tag): if(($tag['c_id'] == $vs['id'])): ?>
				                            <?php echo $tag['tag']; endif; endforeach; endif; else: echo "" ;endif; ?>
										</div>
										<div class="title"><?php echo $vs['title']; ?></div>
										<div class="time">By <?php echo $vs['author']; ?> <!--  .  <span name="_time"><?php echo $vs['create_time']; ?></span> day ago --></div>
										<p><?php echo $vs['description']; ?></p>
									</div>
								</a>
							</li>
                       <?php endforeach; endif; else: echo "" ;endif; ?>
				</ul>
				<div class="fengye">
					<?php echo $page; ?>
				</div>
			</div>
		</div>
	</section>
	<!-- NewsList end -->

<footer id="footer">
	<div class="centerCon">
		<div class="imgC"><img src="<?php echo get_root(); ?>/static/index/new/images/public/logo_02.jpg"></div>
		<div class="link">
		    <?php $nav = [];$_where = [];$_where['status'] = ['eq',1];$_where['mark'] = ['eq','bottom'];if($_cate = \app\admin\model\Navcate::where($_where) -> find()){ $nav = $_cate -> nav() -> where('status',1) -> order('sort desc,id asc') -> select();$nav = \ebcms\Tree::tree($nav); } if(is_array($nav) || $nav instanceof \think\Collection): if( count($nav)==0 ) : echo "" ;else: foreach($nav as $key=>$vo): ?><a href="<?php echo $vo['url']; ?>"><?php echo $vo['title']; ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
		</div>

		<p>2016LONG7.COM ALL RIGHTS RESERVED / POWERED BY LONG7 PROFESSIONAL SNEAKER MEDIA 沪ICP备15526666号</p>
	</div>
</footer>
<!-- <script type="text/javascript">
    $youziku.load("body", "b20df310087445b9a2001396d1c92021", "PingFangSC_R");
    /*$youziku.load("#id1,.class1,h1", "b20df310087445b9a2001396d1c92021", "PingFangSC_R");*/
    /*．．．*/
    $youziku.draw();
</script> -->