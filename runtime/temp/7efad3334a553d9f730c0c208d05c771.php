<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:71:"E:\workspace-php\l7cms\templates\default_mobile\content\video_list.html";i:1487918331;s:64:"E:\workspace-php\l7cms\templates\default_mobile\common\head.html";i:1488347577;s:66:"E:\workspace-php\l7cms\templates\default_mobile\common\header.html";i:1489039014;s:75:"E:\workspace-php\l7cms\templates\default_mobile\common\video_selection.html";i:1487917908;s:66:"E:\workspace-php\l7cms\templates\default_mobile\common\footer.html";i:1488346300;}*/ ?>
<!DOCTYPE html><html lang="zh-CN"><head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,user-scalable=yes,minimum-scale=1.0,maximum-scale=1.0"/>
	<title><?php if(!(empty($category) || ($category instanceof \think\Collection && $category->isEmpty()))): ?><?php echo $category['title']; else: ?>首页<?php endif; ?></title>
    <link rel="shortcut icon" href="<?php echo get_root(); ?>/favicon.ico" type="image/x-icon" /> 
    <script type="text/javascript" src="<?php echo get_root(); ?>/static/index/mobile/js/Adaptive/Adaptive.js"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo get_root(); ?>/static/index/mobile/css/swiper3.06.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo get_root(); ?>/static/index/mobile/css/style.css">
	<link rel="stylesheet" type="text/css" href="<?php echo get_root(); ?>/static/index/mobile/css/index.css">
	<script type="text/javascript" src="<?php echo get_root(); ?>/static/index/js/home.js"></script>
	<script type="text/javascript" src="<?php echo get_root(); ?>/static/index/mobile/js/jquery/jquery-1.8.2.min.js"></script>
	<script type="text/javascript" src="<?php echo get_root(); ?>/static/index/mobile/js/navFun.js"></script>
	<script type="text/javascript" src="<?php echo get_root(); ?>/static/index/mobile/js/menu_tag.js"></script>
	<script type="text/javascript" src="<?php echo get_root(); ?>/static/index/mobile/js/index.js"></script>
	<script type="text/javascript" src="<?php echo get_root(); ?>/static/index/mobile/js/swiper/swiper.min.js"></script>
	<!-- <script type="text/javascript" src="<?php echo get_root(); ?>/static/index/mobile/js/underscore.js "></script> 
	<script type="text/javascript" src="<?php echo get_root(); ?>/static/index/mobile/js/pinchzoom.js"></script> -->
	<script src="http://res.wx.qq.com/open/js/jweixin-1.2.0.js"></script> 
</head><script type="text/javascript" src="<?php echo get_root(); ?>/static/index/mobile/js/pulldownload/pulldownload.js"></script><body><header id="headerPublic" class="clearfloat">

	<a href="<?php echo url('index/index/index'); ?>" class="logo"><img
		src="<?php echo get_root(); ?>/static/index/mobile/images/public/logo.png"></a>
		<?php if(!(empty($category) || ($category instanceof \think\Collection && $category->isEmpty()))): if($category['title'] != 'Digger'): ?>
		<span class="title"><span class="cn"><?php echo $category['title']; ?></span><br/><span class="en"><?php echo $category['name']; ?></span></span>
		<?php endif; endif; ?>
	<div class="but clearfloat">
		<a class="nav" href="javascript:void(0);"><i class="iconfont">&#xe648;</i></a>
		<a class="suo" href="javascript:void(0);"><i class="iconfont" style="font-size: 50px">&#xe63c;</i></a>
	</div>
	<form class="search clearfloat" id="Indsearch" role="search"
		method="get" action="<?php echo url('index/content/search'); ?>">

		<div class="inputC">

			<input id="SearchInupt" type="text" placeholder="Jordan brand "
				name="q">
			<button class="iconC" type="button" id="showSearch">
				<i class="iconfont">&#xe63c;</i>
			</button>
		</div>
		<div class="txit">取消</div>
	</form>
</header>
<section class="pubnavCon" id="pubnavCon">
	<div class="nav">
		<?php $data = [];$data = \ebcms\Tree::tree(get_content_category()); ?>
		<ul class="NaOne">
             <?php if(is_array($data) || $data instanceof \think\Collection): if( count($data)==0 ) : echo "" ;else: foreach($data as $key=>$vo): if(!(empty($vo['rows']) || ($vo['rows'] instanceof \think\Collection && $vo['rows']->isEmpty()))): ?>
                       <li class="ind">
							<a href="<?php echo $vo['url']; ?>"><?php echo $vo['title']; ?></a>
							<div class="jian"></div>
							<ul class="NaTwo">
								<?php if(is_array($vo['rows']) || $vo['rows'] instanceof \think\Collection): if( count($vo['rows'])==0 ) : echo "" ;else: foreach($vo['rows'] as $key=>$sub): ?>
                               <li class="ind">
									<a href="http://120.26.192.83/index.php/<?php echo $vo['name']; ?>/<?php echo $sub['name']; ?>"><?php echo $sub['title']; ?></a>
									<div name='news_sub'  <?php if(($vo['title'] == '新闻')): ?>data-id='<?php echo $sub['id']; ?>' class="jian" {/else}data-id=''<?php endif; ?>  url="<?php echo $sub['url']; ?>" ></div>
								</li>
                               <?php endforeach; endif; else: echo "" ;endif; ?>
							</ul>
						</li>
                   <?php else: ?>
                       <li><a href="http://120.26.192.83/index.php/<?php echo $vo['name']; ?>"><?php echo $vo['title']; ?></a></li>
                   <?php endif; endforeach; endif; else: echo "" ;endif; ?>
		</ul>
	</div>
</section>

	<section id="Max_Con">	<input type="hidden" id="category_id" value="<?php echo $category['id']; ?>"/>	
		<div class="videoList">			<?php $data = [];$_where = [];$_where['mark'] = ['eq','shipin_selection'];$_where['status'] = ['eq',1];if($_cate = \app\admin\model\Recommendcate::where($_where) -> find()){ $data = $_cate -> recommend()  -> order('sort desc,id desc') -> limit('1') -> where('status',1) -> select(); } if(is_array($data) || $data instanceof \think\Collection): if( count($data)==0 ) : echo "" ;else: foreach($data as $key=>$vo): ?>	<div class="videoList_d"><a href="<?php echo $vo['url']; ?>">        	<img class="videoList_d_img" src="<?php echo thumb($vo['thumb'],710,536); ?>">            <span class="videoList_d_span"></span>            <P class="videoList_d_p"><?php echo $vo['title']; ?></P>        </a></div><?php endforeach; endif; else: echo "" ;endif; ?>

             <div class="videoList_h3">            <?php $data = [];$data = \ebcms\Tree::sub(get_content_category(),'3'); ?>			<a <?php if(($category['id'] == '3')): ?>	        		class='cur'	        	<?php endif; ?> href="<?php echo url('../Video'); ?>" >最新</a>		        <?php if(is_array($data) || $data instanceof \think\Collection): if( count($data)==0 ) : echo "" ;else: foreach($data as $key=>$vo): if(($vo['title'] != '精选视频')): ?>		         	<a <?php if(($category['id'] == $vo['id'])): ?>	        		class='cur'	        	<?php endif; ?> href="<?php echo $vo['url']; ?>" ><?php echo $vo['title']; ?></a>	        	<?php endif; endforeach; endif; else: echo "" ;endif; ?>	        	<div class="clear"></div>                        </div>
            <ul class="videoList_ul" id="data_list">
            </ul>
        </div>
		<footer class="footerPublic">
	<div class="CoN">
		<div class="imgC"><img src="<?php echo get_root(); ?>/static/index/mobile/images/public/logo2.png"></div>
		<div class="nav">
			<?php $nav = [];$_where = [];$_where['status'] = ['eq',1];$_where['mark'] = ['eq','bottom'];if($_cate = \app\admin\model\Navcate::where($_where) -> find()){ $nav = $_cate -> nav() -> where('status',1) -> order('sort desc,id asc') -> select();$nav = \ebcms\Tree::tree($nav); } if(is_array($nav) || $nav instanceof \think\Collection): if( count($nav)==0 ) : echo "" ;else: foreach($nav as $key=>$vo): ?>
				<a href="<?php echo $vo['url']; ?>"><?php echo $vo['title']; ?></a>
			<?php endforeach; endif; else: echo "" ;endif; ?>
		</div>
		<p></p>
		<!-- <p>2016LONG7.COM ALL RIGHTS RESERVED / POWERED BY LONG7 PROFESSIONAL SNEAKER MEDIA 沪ICP备15526666号</p> -->
	</div>
	<script>  
    /* $(function () {  
        $('div.word img').each(function () {  
            new RTP.PinchZoom($(this), {});  
        });  
    }) */  
</script> 
<script type="text/javascript" src="<?php echo get_root(); ?>/static/index/mobile/js/weixin.js"></script>
</footer>
		<script type="text/javascript">			var url = 'http://120.26.192.83/index.php/index/comment/list_data?pid='+$('#category_id').val()+'&page=';			//添加Html			function addIndexHtml(data){				var html = '';				for(var i=0;i < data.length;i++){					html+= '<li><a href="'+data[i].url+'">'						+ '<img class="videoList_ul_img" src="'+data[i].thumb+'">'						+ '   <P class="videoList_ul_p">'+data[i].title+'</P>'						+ '</a></li>';				}				$('#data_list').append(html);			}		</script>
</body>
</html>