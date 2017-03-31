<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:64:"E:\workspace-php\l7cms\templates\default_mobile\index\index.html";i:1487661317;s:64:"E:\workspace-php\l7cms\templates\default_mobile\common\head.html";i:1490606263;s:66:"E:\workspace-php\l7cms\templates\default_mobile\common\header.html";i:1489039139;s:66:"E:\workspace-php\l7cms\templates\default_mobile\common\footer.html";i:1488346300;}*/ ?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
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
<header id="headerPublic" class="clearfloat">

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
									<a href="<?php echo $sub['url']; ?>"><?php echo $sub['title']; ?></a>
									<div name='news_sub'  <?php if(($vo['title'] == '新闻')): ?>data-id='<?php echo $sub['id']; ?>' class="jian" {/else}data-id=''<?php endif; ?>  url="<?php echo $sub['url']; ?>" ></div>
								</li>
                               <?php endforeach; endif; else: echo "" ;endif; ?>
							</ul>
						</li>
                   <?php else: ?>
                       <li><a href="<?php echo $vo['url']; ?>"><?php echo $vo['title']; ?></a></li>
                   <?php endif; endforeach; endif; else: echo "" ;endif; ?>
		</ul>
	</div>
</section>

<section id="Max_Con">
	<ul class="firstPage" id="data_list">
		
	</ul>
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

</section>
<script type="text/javascript">
$(function(){
	var url = 'http://120.26.192.83/index.php/index/mobile/indexList';
	$.ajax({
        url: url,
        type: 'GET',
        dataType: 'JSONP'
    })
    .done(function(data) {
    	console.log(data);
        addIndexHtml(data.lists);
    })
});
//添加Html
function addIndexHtml(data){
	var html = '';
	for(var i=0;i < data.length;i++){
		if(data[i].category_id == 6){
			html+= '<li class="firstPage_li2"><a href="'+data[i].url+'">'
			+ '<P class="firstPage_p1"><img src="'+data[i].thumb+'"><span></span</P>'
			+ '<div class="firstPage_d">'
			+ '	<P class="firstPage_d_p1">'+data[i].position+'</P>'
			+ '	<P class="firstPage_d_p2">'+data[i].title+'</P>'
			+ '	<P class="firstPage_d_p3">'+data[i].description+'</P>'
			+ '</div>'
			+ '</a></li>';
			
		}else{
			html+= '<li class="firstPage_li1"><a href="'+data[i].url+'">'
			+ '<P class="firstPage_p1"><img src="'+data[i].thumb+'"></P>'
			+ '<div class="firstPage_d">'
			+ '	<P class="firstPage_d_p1">'+data[i].position+'</P>'
			+ '	<P class="firstPage_d_p2">'+data[i].title+'</P>'
			+ '	<P class="firstPage_d_p3">'+data[i].description+'</P>'
			+ '</div>'
			+ '</a></li>';
		}
		
	}
	$('#data_list').append(html);
}
</script>