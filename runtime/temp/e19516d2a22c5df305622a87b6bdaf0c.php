<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:62:"E:\workspace-php\l7cms/application/admin\view\index\index.html";i:1485153976;}*/ ?>
<?php $namespace = ns(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
    <title>内容管理系统</title>
    <script type="text/javascript" src="<?php echo get_root(); ?>/static/index/js/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo get_root(); ?>/static/core/js/admin.js"></script>
    <!-- Bootstrap -->
    <link href="<?php echo get_root(); ?>/third/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 flowers of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]]
    <script src="http://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="<?php echo get_root(); ?>/third/bootstrap/js/bootstrap.min.js"></script>
    <!-- multi_menu -->
    <script type="text/javascript" src="<?php echo get_root(); ?>/third/multi_menu/accordion.js"></script>
    <!-- arttemplate -->
    <script type="text/javascript" src="<?php echo get_root(); ?>/third/artTemplate/template.js"></script>
    <script type="text/javascript" src="<?php echo get_root(); ?>/static/core/js/template.helper.js"></script>
    <!-- artDialog -->
    <script type="text/javascript" src="<?php echo get_root(); ?>/third/artDialog/jquery.artDialog.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo get_root(); ?>/third/artDialog/skins/default.css">
    <script type="text/javascript" src="<?php echo get_root(); ?>/third/artDialog/artDialog.ext.js"></script>
    <!-- 引入百度编辑器 -->
    <script type="text/javascript" src="<?php echo get_root(); ?>/third/ueditor/ueditor.config.js"></script>
    <script type="text/javascript" src="<?php echo get_root(); ?>/third/ueditor/ueditor.all.js"></script>
    <!-- 引入webuploader -->
    <link rel="stylesheet" type="text/css" href="<?php echo get_root(); ?>/third/webuploader/webuploader.css">
    <script type="text/javascript" src="<?php echo get_root(); ?>/third/webuploader/webuploader.nolog.min.js"></script>
    <!-- 引入iconfont -->
    <link href="<?php echo get_root(); ?>/third/iconfont/iconfont.css" rel="stylesheet">
    <!-- 引入后台样式表 -->
    <link rel="stylesheet" type="text/css" href="<?php echo get_root(); ?>/static/core/css/core.css">
    <?php $namespace = ns(); ?>
    <script type="text/javascript">
        /*百度编辑器默认配置*/
        window.UEDITOR_CONFIG.initialFrameHeight = '300';
        window.UEDITOR_CONFIG.zIndex = '1500';
        window.UEDITOR_CONFIG.initialFrameWidth = 'auto';
        window.UEDITOR_CONFIG.UEDITOR_HOME_URL = '<?php echo get_root(); ?>/third/ueditor/';
        window.UEDITOR_CONFIG.serverUrl = '<?php echo url('admin/index/ueditor'); ?>';
        
        $(function(){
            Namespace.register("EBCMS.<?php echo $namespace; ?>");

            template.config('openTag', '[[');
            template.config('closeTag', ']]');
            
            EBCMS.<?php echo $namespace; ?>.asyncdata = function asyncdata(){
                EBCMS.CORE.load({
                    url:'<?php echo url('admin/api/index'); ?>',
                    queryParams:{
                        api:'asyncdata'
                    },
                    loadAfter:function(data){
                       EBCMS.DATA = data;
                       $.extend(window.UEDITOR_CONFIG, data.ueditor);
                       EBCMS.CORE.api({
                           queryParams:{
                               api:'mymenu',
                           },
                           tree:true,
                           tpl:'left_nav',
                           target:'#left-nav',
                           compileAfter:function(p){
                               $(".leftnav").accordion({
                                   accordion: false,
                                   speed: 100,
                                   closedIcon: 'iconfont icon-shouqi',
                                   openedIcon: 'iconfont icon-zhankai',
                                   renderAfter:function(){
                                       EBCMS.CORE.changemain('<?php echo url('admin/index/index?tpl=main'); ?>');
                                       $(".leftnav > li > a").trigger('click');
                                       $('.leftnav a').bind('click', function(event) {
                                           $('.leftnav a').removeClass('current');
                                           $(this).addClass('current');
                                       });
                                   }
                               });
                           }
                       });
                    }
                });
            };
            EBCMS.<?php echo $namespace; ?>.runtime = function runtime(p,msg){
                if (msg != false) {
                    msg = true;
                }
                EBCMS.CORE.submit({
                    url:'<?php echo url('runtime'); ?>',
                    queryParams:p,
                    loadAfter:function(data){
                       if (msg) {
                           EBCMS.MSG.notice('系统缓存已更新！');
                       };
                    }
                });
            };
            EBCMS.<?php echo $namespace; ?>.password = function password(){
                EBCMS.CORE.get({
                    url:'<?php echo url('password'); ?>',
                    target:'#lgModal .modal-content',
                });
            };
            /*系统配置*/
            EBCMS.<?php echo $namespace; ?>.config = function config(){
                EBCMS.CORE.get({
                    url:'<?php echo url('admin/config/index'); ?>',
                    target:'#main',
                });
            };
            art.dialog.notice({
                title: '欢迎！',
                width: 220,
                content: '欢迎使用内容管理系统！',
                icon: 'face-smile',
                time: 10
            });
            EBCMS.CORE.getconfig = function getconfig(type){
                EBCMS.CORE.get({
                    url:'<?php echo url('admin/config/setting'); ?>',
                    queryParams:{
                        type:type,
                    },
                    target:'#lgModal .modal-content',
                });
            };
            EBCMS.CORE.userinfo = function(id){
                EBCMS.CORE.get({
                    url:'<?php echo url('admin/user/info'); ?>',
                    queryParams:{
                        id:id,
                    },
                    target:'#mdModal .modal-content',
                });
            };
            EBCMS.<?php echo $namespace; ?>.tools = function(opt){
                switch (opt.tool) {
                    case 'jisuanqi':
                        art.dialog({
                            id:'jisuanqi',
                            title:'计算器',
                            time:0,
                            lock: false,
                            fixed: false,
                            drag: true,
                            content: '<iframe src="<?php echo get_root(); ?>/tools/jisuanqi/base.html" width="390" height="266" frameborder="0"></iframe>',
                            padding:'0px',
                            button: [{
                                name: '普通计算器',
                                callback: function () {
                                    this.content('<iframe src="<?php echo get_root(); ?>/tools/jisuanqi/base.html" width="390" height="266" frameborder="0"></iframe>');
                                    return false;
                                }
                            },{
                                name: '科学计算器',
                                callback: function () {
                                    this.content('<iframe src="<?php echo get_root(); ?>/tools/jisuanqi/ext.html" width="700" height="360" frameborder="0"></iframe>');
                                    return false;
                                }
                            }],
                        });
                        break;
                    case 'replace_attach_baseurl':
                        EBCMS.CORE.get({
                            url:'<?php echo url('replaceattachbaseurl'); ?>',
                            target:'#lgModal .modal-content',
                        });
                        break;
                    default:
                        /*statements_def*/
                        break;
                }
            };
            EBCMS.<?php echo $namespace; ?>.asyncdata();
        });
    </script>
</head>
<body>
    <div class="header" style="height:50px;padding:0px;z-index:1001;">
        <nav class="navbar navbar-static-top navbar-default navbar-inverse" style="margin-bottom:0;">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="javascript:void(0);" target="_blank"><b>内容管理系统</b></a>
                </div>

                <div class="collapse navbar-collapse" id="navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="javascript:EBCMS.CORE.changemain('<?php echo url('admin/index/index?tpl=main'); ?>');">主页</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><b>设置中心</b> <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="javascript:EBCMS.<?php echo $namespace; ?>.config();">系统配置</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="javascript:EBCMS.CORE.changemain('<?php echo url('admin/config/custom'); ?>');">自定义配置</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="javascript:EBCMS.CORE.changemain('<?php echo url('admin/datadict/index'); ?>');">数据源</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="javascript:EBCMS.CORE.changemain('<?php echo url('admin/upgrade/index'); ?>');">系统更新</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><b>常用工具</b> <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="javascript:EBCMS.<?php echo $namespace; ?>.tools({tool:'jisuanqi'});">计算器</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="javascript:EBCMS.<?php echo $namespace; ?>.tools({tool:'replace_attach_baseurl'});">附件地址替换</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><b>清理缓存</b> <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="javascript:EBCMS.<?php echo $namespace; ?>.runtime({type:'cache'});">数据缓存</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="javascript:EBCMS.<?php echo $namespace; ?>.runtime({type:'tpl'});">模板缓存</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="javascript:EBCMS.<?php echo $namespace; ?>.runtime({type:'all'});">全部</a></li>
                            </ul>
                        </li>
                        <li><a href="<?php echo url('index/index/index'); ?>" target="_blank">前台</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><b><?php echo session('user_nickname'); ?></b> <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="javascript:EBCMS.<?php echo $namespace; ?>.password();">修改密码</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="<?php echo url('admin/auth/logout'); ?>">退出</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    <div class="body" style="top:50px;padding:0px;bottom:25px;">
        <div class="layout">
            <div class="layout-left" style="margin-right:-180px;width:180px;background:#222;">
                <div id="left-nav" class="box"></div>
                <script id="left_nav" type="text/html">
                    <ul class="leftnav">
                        [[include 'nav_item']]
                    </ul>
                </script>
                <script id="nav_item" type="text/html">
                    [[each rows as v n]]
                        <li>
                        [[if v.rows]]
                            <a href="#"><i class="[[v.iconcls]]"></i> [[v.title]]</a>
                            <ul>
                            [[include 'nav_item' v]]
                            </ul>
                        [[else]]
                            <a href="javascript:EBCMS.CORE.changemain('[[v.url]]');"><i class="[[v.iconcls]]"></i> [[v.title]]</a>
                        [[/if]]
                        </li>
                    [[/each]]
                </script>
            </div>
            <div class="layout-rightbox">
                <div class="layout-right" style="height:100%;overflow:auto;margin-left:180px;">
                    <div id="main" class="box">
                    </div>
                    <div id="main_edit" class="box" style="display: none;"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer" style="height:25px;padding:0px;">
        <!-- <div style="height:23px;text-align:right;line-height:23px;margin:0px;">2014-2016 四川易贝网络科技有限公司. 版权所有&nbsp;&nbsp;</div> -->
    </div>
    <!-- 三个模态框 -->
    <!-- 超大模态框 -->
    <div class="modal fade" id="xlgModal" data-backdrop="static" tabindex="-1">
        <div class="modal-dialog modal-lg" style="width:90%;max-width:1300px;">
            <div class="modal-content">

            </div>
        </div>
    </div>
    <div class="modal fade" id="lgModal" data-backdrop="static" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

            </div>
        </div>
    </div>
    <div class="modal fade" id="mdModal" data-backdrop="static" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                
            </div>
        </div>
    </div>
    <div class="modal fade" id="smModal" data-backdrop="static" tabindex="-1">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                
            </div>
        </div>
    </div>
    <!-- //三个模态框 -->
</body>
</html>