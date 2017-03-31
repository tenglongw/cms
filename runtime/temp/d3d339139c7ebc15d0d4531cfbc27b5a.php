<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:62:"E:\workspace-php\l7cms\templates\default\content\newsInfo.html";i:1490331135;s:57:"E:\workspace-php\l7cms\templates\default\common\head.html";i:1488795468;s:59:"E:\workspace-php\l7cms\templates\default\common\header.html";i:1489038618;s:68:"E:\workspace-php\l7cms\templates\default\content\detail_comment.html";i:1490783621;s:59:"E:\workspace-php\l7cms\templates\default\common\footer.html";i:1487844022;}*/ ?>
<!DOCTYPE html><html lang="zh-CN"><head>
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
</head><body>	<header id="header">
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
         --><script>    Namespace.register("EBCMS.CONTENT");</script>	<!-- section.EvaluationOne -->
	<section class="EvaluationOne">		<div class="centerCon">			<div class="head"><?php echo $content['title']; ?></div>			<div class="About"><?php echo mb_substr($content['description'],0,100); ?></div>			<div class="time"><?php  								$obj = json_decode($content,true);								echo date('Y-m-d',$obj['create_time']); 							 ?>  &nbsp; By <?php echo $content['author']; ?> &nbsp; 			</div>			<div class="swiper_cn">				<div class="swiper-container" id="NewsInfoLs">					<div class="swiper-wrapper">					<?php if(is_array($content['ext']['pics']) || $content['ext']['pics'] instanceof \think\Collection): if( count($content['ext']['pics'])==0 ) : echo "" ;else: foreach($content['ext']['pics'] as $key=>$vs): ?>						<div class="swiper-slide"><div class="cne"><div class="td"><img src="<?php echo thumb($vs['img'],0,0); ?>"></div></div></div>					<?php endforeach; endif; else: echo "" ;endif; ?>					</div>					<div class="swiper-button-prev NewsInfoLs_prev"></div>					<div class="swiper-button-next NewsInfoLs_next"></div>									</div>			</div>			<div class="word"> 				<?php echo htmlspecialchars_decode($content['body']['body']); ?>			</div>			<div class="time" style="line-height: 0px">			<?php if(!(empty($content['source']) || ($content['source'] instanceof \think\Collection && $content['source']->isEmpty()))): ?>							Via <?php echo $content['source']; endif; ?>			</div>		<?php if(empty($content['ext']['ad']) || ($content['ext']['ad'] instanceof \think\Collection && $content['ext']['ad']->isEmpty())): else: ?>			<div class="guangg">				<a href="#"><img src="<?php echo thumb($content['ext']['ad'],1000,109.88); ?>"></a>			</div>		<?php endif; ?>		</div>	<div></div>	</section>	<!-- section.EvaluationOne end -->	<!-- section.comment -->	<?php if($content['comment_able'] && ebconfig('content.comment_able')): ?>           <script type="text/javascript" src="<?php echo get_root(); ?>/third/artTemplate/template.js"></script>
<script>
    Namespace.register("EBCMS.CONTENT");
</script>
<script type="text/javascript">

	//QQ登录
	//微信登录
	var href = window.location.href;
	$(function(){
		var wiloginUrl = 'https://open.weixin.qq.com/connect/qrconnect?appid=wx4e8abf24c91b1877&redirect_uri=http://www.long7.com/index.php/index/Auth/wxOauth2?source_url='+href+'&response_type=code&scope=snsapi_login&state=STATE#wechat_redirect';
		$('.wx').attr('href',wiloginUrl);
	});
</script>
<section class="comment">
		<div class="logoin" id="logoin">

			<div class="logoinCon">

				<div class="exit"><i class="iconfont">&#xe66c;</i></div>

				<a class="qq" href="<?php echo $qq_url; ?>" ">使用QQ直接登录</a>

				<!-- <a class="wx" href="">使用微信直接登录</a> -->
				<a class="wx" href="#">使用微信直接登录</a>

				<!-- <a class="wb" href="#">使用微博直接登录</a> -->

			</div>

		</div>

		<div class="centerCon">

			<div class="commentBottom clearfloat">

				<div class="name">分享：</div>

				<div class="bot clearfloat bdsharebuttonbox">

					<a href="#" class="bds_tsina" data-cmd="tsina" title="分享到新浪微博" style="background-image: none;padding-left: 30px;height: 28px; margin:0;"></></a>

					<a href="#"  class="bds_qzone" data-cmd="qzone" title="分享到QQ空间" style="background-image: none;padding-left: 30px;height: 28px; margin:0;"></a>

					<a href="#"  class="bds_weixin" data-cmd="weixin" title="分享到微信" style="background-image: none;padding-left: 28px;height: 28px; margin:0;"></a>

				</div>

			</div>



<?php if(session('?user_id') || ebconfig('content.comment_visitor')): ?> 
    <input type="hidden" id="log_state" value="1">
	<?php else: ?>
		<input type="hidden" id="log_state" value="2">
	<?php endif; ?>
	
	<form action="" id="comment_form" onsubmit="return EBCMS.CONTENT.comment();">
			<div class="import clearfloat">
	
					<div class="imgC">
						<?php if(session('?user_avatar')): ?> 
						    <img src="<?php  echo session('user_avatar') ?>">
							<?php else: ?>
								<img src="<?php echo get_root(); ?>/static/index/new/images/public/icon.jpg">
							<?php endif; ?>
						
					</div>
	
					<div class="text">
	
						<textarea class="form-control" rows="5" id="content" name="content" placeholder="随便说点什么吧...."></textarea>
			
					</div>
	
				</div>
	
				<div class="butC clearfloat">
	
					<div class="line"><span id="comment_count"><?php echo $content['comment_count']; ?></span>条评论</div>
	
					<button type="button" id="commit" class="but">评论</button>
				</div>
			
	        <input type="hidden" name="tid" value="<?php echo $content['id']; ?>">
	    </form>
	   <script>
        $(function(){
            EBCMS.CONTENT.comment = function(){
                $.ajax({
                    url: '<?php echo url('index/comment/add'); ?>',
                    type: 'POST',
                    dataType: 'json',
                    data: $('#comment_form').serialize(),
                    success:function(data){
                        if (data.code) {
                            $('#comment_form textarea').val('');
                            $('#comment_verify').val('');
                            EBCMS.CONTENT.param.page = 1;
                            EBCMS.CONTENT.reloadcomment();
                        }else{
                            alert(data.msg);
                        }
                    }
                });
                return false;
            };
            $('#commit').on('click',function(){
            	var log_state = $('#log_state').val();
            	var content = $('#content').val();
            	if(log_state == 1){
            		if('' != content && content.length>0){
	            		$('#comment_form').submit();
	            		var comment_count = $('#comment_count').html();
	            		$('#comment_count').html(parseInt(comment_count)+1);
            		}else{
            			CnAlert('评论内容不能为空！');
            		}
            	}else{
            		$('#logoin').show();
            	}
            });
            $('.exit').on('click',function(){
            	$('#logoin').hide();
            });
        });
    </script>
	
	<div id="comments"></div>
	<div id="comment_page"></div>
	<script>
    $(function(){
        template.config('openTag', '[[');
        template.config('closeTag', ']]');
        EBCMS.CONTENT.param = {
            page:1,
            size:5,
            tid:'<?php echo $content['id']; ?>',
        };
        EBCMS.CONTENT.loading = 0;
        EBCMS.CONTENT.reloadcomment = function(){
            $('#reply_media').appendTo('#reply_form_contain');
            EBCMS.CONTENT.param.page=1;
            $('#comments').html('');
            EBCMS.CONTENT.loadcomment();
        };
        EBCMS.CONTENT.loadcomment = function(page){
            if (page) {
                $('#reply_media').appendTo('#reply_form_contain');
                $.ajax({
                    url: '<?php echo url('index/comment/index'); ?>',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        page:page,
                        size:EBCMS.CONTENT.param.size,
                        tid:EBCMS.CONTENT.param.tid,
                    },
                    success:function(res){
                        if (res.code) {
                            var coms = template('comment-item', {
                                rows:EBCMS.FN.array2tree(res.data.comments.data.concat(res.data.subcomments))
                            });
                            $('#comment_page_'+page).html(coms);
                        }else{
                            alert(res.msg);
                        }
                    }
                });
                return false;
            }else{
                if (EBCMS.CONTENT.loading == 0) {
                    EBCMS.CONTENT.loading = 1;
                    $('#reply_media').appendTo('#reply_form_contain');
                    $('#comments_tips').html('加载中。。。');
                    $.ajax({
                        url: '<?php echo url('index/comment/index'); ?>',
                        type: 'POST',
                        dataType: 'json',
                        data: EBCMS.CONTENT.param,
                        success:function(res){
                            if (res.code) {
                                if (res.data.comments.data.length) {
                                    var coms = template('comment-item', {
                                        rows:EBCMS.FN.array2tree(res.data.comments.data.concat(res.data.subcomments))
                                    });
                                    $('#comments').append('<div class="comment_page" data-page="'+EBCMS.CONTENT.param.page+'" id="comment_page_'+EBCMS.CONTENT.param.page+'">'+coms+'</div>');
                                    EBCMS.CONTENT.param.page += 1;
                                    $('#comments_tips').html('');
                                }else{
                                    EBCMS.CONTENT.loadover = 1;
                                    $('#comments_tips').html('没有更多了');
                                }
                            }else{
                                alert(res.msg);
                            }
                            EBCMS.CONTENT.loading = 0;
                        }
                    });
                }
                return false;
            }
        };
        EBCMS.CONTENT.reply = function(id){
            $('#reply_id').val(id);
            if ($('#comment_id_'+id+' .media-body:eq(0) > p #reply_media').length) {
                $('#reply_media').toggle();
            }else{
                $('#reply_media').appendTo('#comment_id_'+id+' .media-body:eq(0) > p').show();
            }
        };
        EBCMS.CONTENT.replysubmit = function(){
            $.ajax({
                url: '<?php echo url('index/comment/reply'); ?>',
                type: 'POST',
                dataType: 'json',
                data: $('#reply_form').serialize(),
                success:function(data){
                    if (data.code) {
                        $('#reply_form textarea').val('');
                        $('#reply_verify').val('');
                        /*获取当前页page*/
                        var reply_id = $('#reply_id').val();
                        var c = $('#comment_id_'+reply_id).parents('div.comment_page')[0];
                        var page = $(c).data('page');
                        EBCMS.CONTENT.loadcomment(page);
                    }else{
                        alert(data.msg);
                    }
                }
            });
            return false;
        };
        // 若不要瀑布流滚动触发加载，可自行改用其他事件触发加载。。
        $(document).scroll(function(){
            if ($(document).scrollTop()>=$(document).height()-$(window).height()) {
                if (EBCMS.CONTENT.loadover != 1) {
                    EBCMS.CONTENT.loadcomment();
                }
            };
        });
        EBCMS.CONTENT.loadcomment();
    });
</script>
	<script id="comment-item" type="text/html">

 	<ul class="commentlist">

    [[each rows as v n]]
		

				<li class="clearfloat" id="comment_id_[[v.id]]">

					<div class="imgc"><img src="[[v.user.avatar]]"></div>

					<div class="word">

						<div class="name">[[v.user.nickname]]</div>

						<p>[[v.content]]</p>
							
						<span name="time_format" class="time">[[v.create_date]]</span>

					</div>

				</li>

    [[/each]]
</ul>
	</script>
	<script type="text/javascript">
	/* function updateDate(){
		$('span[name=time_format]').each(function(index,value){
			var date;
			if('/^\d+$/'.test($(value).html())){
				date = dateFormat1($(value).html());
			}else{
				date = $(value).html();
			}
			$(value).html(date);
		});
	}
	function dateFormat1(time){
			var current = new Date();
			var format_time = new Date(parseInt(time)*1000);
			return format_time.format("YYYY年MM月dd日hh小时mm分ss秒");
	} */
	</script>

		</div>

	</section>


       <?php endif; ?>	<!-- section.comment -->	<!-- section.Recommend -->	<section class="Recommend">		<div class="centerCon">			<div class="InHeader"><span>相关推荐</span></div>			<ul class="Recommendlist">                <?php if(is_array($content['relation']) || $content['relation'] instanceof \think\Collection): if( count($content['relation'])==0 ) : echo "" ;else: foreach($content['relation'] as $key=>$vo): ?>                    <li class="clearfloat">					<a href="<?php echo $vo['url']; ?>">						<div class="imgC"><img src="<?php echo thumb($vo['thumb'],335,251); ?>"></div>						<div class="word">							<div class="name">								<?php if(is_array($content['tag']) || $content['tag'] instanceof \think\Collection): if( count($content['tag'])==0 ) : echo "" ;else: foreach($content['tag'] as $key=>$vs): ?>								<?php echo $vs['tag']; endforeach; endif; else: echo "" ;endif; ?>							</div>							<div class="title"><?php echo $vo['title']; ?></div>							<div class="time">							<?php  								$obj = json_decode($vo,true);								echo date('Y-m-d',$obj['create_time']); 							 ?>  &nbsp;By <?php echo $vo['author']; ?></div>							<p><?php echo mb_substr($vo['description'],0,100); ?></p>						</div>					</a>				</li>                                    <?php endforeach; endif; else: echo "" ;endif; ?>			</ul>		</div>	</section>	<!-- section.Recommend end -->
	<!-- footer --><footer id="footer">
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
	<!-- footer end -->
	<!-- <script type="text/javascript" src="js/index.js"></script> -->
	<script>        
	var mySwiper = new Swiper ('#NewsInfoLs', {		loop: true,// 如果需要前进后退按钮nextButton: '.swiper-button-next',prevButton: '.swiper-button-prev',})    	$('.swiper-button-prev').click(function(){		mySwiper.swipePrev(); 	})	$('.swiper-button-next').click(function(){		mySwiper.swipeNext(); 	})    
  </script>