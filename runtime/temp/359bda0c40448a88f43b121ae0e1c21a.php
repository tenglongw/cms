<?php if (!defined('THINK_PATH')) exit(); /*a:11:{s:57:"E:\workspace-php\l7cms\templates\default\index\index.html";i:1488362403;s:57:"E:\workspace-php\l7cms\templates\default\common\head.html";i:1488795468;s:55:"E:\workspace-php\l7cms\templates\default\common\ad.html";i:1485165714;s:59:"E:\workspace-php\l7cms\templates\default\common\header.html";i:1489038618;s:67:"E:\workspace-php\l7cms\templates\default\common\index_big_news.html";i:1484639560;s:58:"E:\workspace-php\l7cms\templates\default\common\slide.html";i:1488359102;s:66:"E:\workspace-php\l7cms\templates\default\common\index_special.html";i:1489724546;s:74:"E:\workspace-php\l7cms\templates\default\common\index_video_selection.html";i:1488362033;s:65:"E:\workspace-php\l7cms\templates\default\common\index_digger.html";i:1488175682;s:73:"E:\workspace-php\l7cms\templates\default\common\index_chaijie_pingce.html";i:1490329217;s:59:"E:\workspace-php\l7cms\templates\default\common\footer.html";i:1487844022;}*/ ?>
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
<div class="videoCon" id="videoCon">

		<div class="Cn" id="video_embed">

			<div class="guanbi" id="guanbi"><i class="iconfont">&#xe614;</i></div>
			

		</div>
	</div>
<?php $data = [];$_where = [];$_where['mark'] = ['eq','index_top_advice'];$_where['status'] = ['eq',1];if($_cate = \app\admin\model\Recommendcate::where($_where) -> find()){ $data = $_cate -> recommend()  -> order('sort desc,id desc') -> limit('1') -> where('status',1) -> select(); } if(is_array($data) || $data instanceof \think\Collection): if( count($data)==0 ) : echo "" ;else: foreach($data as $key=>$vo): ?>
	<div class="InTopBanner"><a href="<?php echo $vo['url']; ?>"><img src="<?php echo thumb($vo['thumb'],1920,107); ?>"></a></div>
<?php endforeach; endif; else: echo "" ;endif; ?>
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
<!-- 首页弹出广告 -->
<?php $data = [];$_where = [];$_where['mark'] = ['eq','index_big_news'];$_where['status'] = ['eq',1];if($_cate = \app\admin\model\Recommendcate::where($_where) -> find()){ $data = $_cate -> recommend()  -> order('sort desc,id desc') -> limit('1') -> where('status',1) -> select(); } if(is_array($data) || $data instanceof \think\Collection): if( count($data)==0 ) : echo "" ;else: foreach($data as $key=>$vo): ?>      				<div id="advertisementWindow">					<div class="conImg">									<div class="cood"><i class="iconfont">&#xe614;</i></div>									<a href="<?php echo $vo['url']; ?>"><img src="<?php echo thumb($vo['thumb'],1000,620); ?>"></a>								</div>							</div> 			<?php endforeach; endif; else: echo "" ;endif; ?>
 <!-- 轮播 -->
<?php $data = [];$_where = [];$_where['mark'] = ['eq','index_slide'];$_where['status'] = ['eq',1];if($_cate = \app\admin\model\Recommendcate::where($_where) -> find()){ $data = $_cate -> recommend()  -> order('sort desc,id desc') -> limit('4') -> where('status',1) -> select(); } if(!(empty($data) || ($data instanceof \think\Collection && $data->isEmpty()))): ?>
	<section class="InBanner">
		<div class="swiper-container" id="InBannerSwiper">
			<div class="swiper-wrapper">
				<?php if(is_array($data) || $data instanceof \think\Collection): if( count($data)==0 ) : echo "" ;else: foreach($data as $key=>$vo): ?>
	                <div class="swiper-slide"><a href="<?php echo $vo['url']; ?>"><img src="<?php echo thumb($vo['thumb'],0,0); ?>"></a></div>
	            <?php endforeach; endif; else: echo "" ;endif; ?>
			</div>
			<!-- 如果需要分页器 -->
			<div class="swiper-pagination InBannerOnePagination"></div>
			<!-- 如果需要导航按钮 -->
			<div class="bocBotl">
				<div class="swiper-button-prev InBannerOnePrev"></div>
			</div>
			<div class="bocBotr">
				<div class="swiper-button-next InBannerOneNext"></div>
			</div>
			<!-- 如果需要滚动条 -->
			<!-- <div class="swiper-scrollbar"></div> -->
		</div>
	</section>
<?php endif; ?>
<!-- 专题 -->
		<?php $data = [];$_where = [];$_where['mark'] = ['eq','index_special'];$_where['status'] = ['eq',1];if($_cate = \app\admin\model\Recommendcate::where($_where) -> find()){ $data = $_cate -> recommend()  -> order('sort desc,id desc') -> where('status',1) -> select(); } ?>
<!-- section展示 -->
	<section class="exhibition">
		<div class="centerCon">
		<?php if(is_array($data) || $data instanceof \think\Collection): if( count($data)==0 ) : echo "" ;else: foreach($data as $key=>$vo): if($vo['locked'] == '1'): ?>
			<a href="<?php echo $vo['url']; ?>" class="InWindow clearfloat">

				<div class="text">

					<div class="line"></div>

					<div class="head"><?php echo $vo['title']; ?> </div>

					<div class="time">
						<?php  
								$obj = json_decode($vo,true);
								echo date('Y-m-d',$obj['create_time']); 
							 ?>  &nbsp; By <?php echo $vo['author']; ?> &nbsp; 
							<?php if(!(empty($vo['source']) || ($vo['source'] instanceof \think\Collection && $vo['source']->isEmpty()))): ?>
							Via <?php echo $vo['source']; endif; ?>
					
					</div>

					<p><?php echo $vo['description']; ?></p>

				</div>

				<div class="imgC">

					<img src="<?php echo thumb($vo['thumb'],490,370); ?>">

				</div>

			</a>
			<?php endif; endforeach; endif; else: echo "" ;endif; ?>

			<div class="slideSweiper">

				<div class="swiper-container" id="exhibitionSwiper">

					<div class="swiper-wrapper">
							<?php if(is_array($data) || $data instanceof \think\Collection): if( count($data)==0 ) : echo "" ;else: foreach($data as $key=>$vo): if($vo['locked'] == '0'): ?>
								<div class="swiper-slide clearfloat">

									<a href="<?php echo $vo['url']; ?>" class="wordin"><img src="<?php echo thumb($vo['thumb'],206,154); ?>"><div class="pcn"><p><?php echo $vo['title']; ?></p></div></a>
		
								</div>
								<?php endif; endforeach; endif; else: echo "" ;endif; ?>

					</div>

				</div>

				<div class="swiper-button-prev exhibitionPrev"></div>

				<div class="swiper-button-next exhibitionNext"></div>
				

			</div>
			<div class="IndMore">

				<a href="http://www.long7.com/index.php/news">more</a>

			</div>

		</div>

	</section>

	<!-- section展示 -->
<!-- section精选视频 -->
 <?php $data = [];$_where = [];$_where['mark'] = ['eq','index_video_selection'];$_where['status'] = ['eq',1];if($_cate = \app\admin\model\Recommendcate::where($_where) -> find()){ $data = $_cate -> recommend()  -> order('sort desc') -> limit('3') -> where('status',1) -> select(); } ?><section class="InVideo">		<div class="centerCon">			<div class="InHeader"><span>精选视频</span></div>			<div class="VideoCn" id="VideoCn">   			<?php if(is_array($data) || $data instanceof \think\Collection): if( count($data)==0 ) : echo "" ;else: foreach($data as $key=>$vo): if($key == '0'): ?>        				<div class="left" data-url="<?php echo $vo['video_pc']; ?>"><a href="javascript:void(0);"><img src="<?php echo thumb($vo['thumb'],680,450); ?>"/><div class="zid"></div></a></div>       				<?php endif; if($key == '1'): ?>        				<div class="center" data-url="<?php echo $vo['video_pc']; ?>"><a class="active" href="javascript:void(0);"><img src="<?php echo thumb($vo['thumb'],680,450); ?>"/><div class="zid"></div></a></div>       				<?php endif; if($key == '2'): ?>        				<div class="right" data-url="<?php echo $vo['video_pc']; ?>"><a href="javascript:void(0);"><img src="<?php echo thumb($vo['thumb'],680,450); ?>"/><div class="zid"></div></a></div>       				<?php endif; endforeach; endif; else: echo "" ;endif; ?>			</div>			<div class="IndMore">				<a href="http://www.long7.com/index.php/Video">more</a>			</div>		</div>			</section>
<!-- section精选视频 end -->

<!-- section广告 -->
<?php $data = [];$_where = [];$_where['mark'] = ['eq','index_digger'];$_where['status'] = ['eq',1];if($_cate = \app\admin\model\Recommendcate::where($_where) -> find()){ $data = $_cate -> recommend()  -> order('sort desc,id desc') -> limit('1') -> where('status',1) -> select(); } if(is_array($data) || $data instanceof \think\Collection): if( count($data)==0 ) : echo "" ;else: foreach($data as $key=>$vo): ?>				<section class="advertisement">					<a href="<?php echo $vo['url']; ?>"><img class="imgban" src="<?php echo thumb($vo['thumb'],1920,580); ?>"></a>					<div class="com">						<div class="Digger"></div>						<div class="headOne"><?php echo $vo['title']; ?></div>						<div class="text"><?php echo $vo['description']; ?></div>					</div>				</section> 			<?php endforeach; endif; else: echo "" ;endif; ?>
<!-- section广告 -->

<!-- section拆解评测 -->
	
<section class="dismantle">		<div class="centerCon">			<div class="InHeader"><span>拆解评测</span></div>			<ul class="list clearfloat">			<?php $data = [];$_where = [];$_where['mark'] = ['eq','index_chaijie_pingce'];$_where['status'] = ['eq',1];if($_cate = \app\admin\model\Recommendcate::where($_where) -> find()){ $data = $_cate -> recommend()  -> order('sort desc,id desc') -> limit('3') -> where('status',1) -> select(); } if(is_array($data) || $data instanceof \think\Collection): if( count($data)==0 ) : echo "" ;else: foreach($data as $key=>$vs): ?>	         			<li>							<a href="<?php echo $vs['url']; ?>">								<div class="imgC"><img src="<?php echo thumb($vs['thumb'],360,217); ?>"></div>								<div class="word">									<p><?php echo $vs['title']; ?></p>									<div class="ti"><i class="iconfont"></i>									 <span><?php  												$obj = json_decode($vs,true);												echo date('Y-m-d',$obj['create_time']); 											 ?></span> <i class="iconfont"></i>									 <?php if(empty($vs['comment_count']) || ($vs['comment_count'] instanceof \think\Collection && $vs['comment_count']->isEmpty())): ?>									 	0               							<?php else: ?>               							<?php echo $vs['comment_count']; endif; ?> Comments</div>								</div>							</a>						</li>					<?php endforeach; endif; else: echo "" ;endif; ?>			</ul>			<div class="IndMore">				<a href="http://www.long7.com/index.php/Special/Dismantling">more</a>			</div>		</div>	</section>
	<!-- section拆解评测 end -->

<!-- 页脚 -->
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
<script type="text/javascript" src="<?php echo get_root(); ?>/static/index/new/js/index.js"></script>