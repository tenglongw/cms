function isWeiXin(){
    var ua = window.navigator.userAgent.toLowerCase();
    if(ua.match(/MicroMessenger/i) == 'micromessenger'){

        $('#fengxxiangOne').show();
        return true;
    }else{

        $('#fengxxiangTwo').show();
        return false;
    }
}
isWeiXin()


$('#fengxxiangOne').on('click', '.weinfenx', function() {
    $('#weixinMenfd').show();

    setTimeout(function(){$('#weixinMenfd').hide()},1500)

    /* Act on the event */
});

window._bd_share_config={
    "common":{
        "bdPopTitle":"您的自定义pop窗口标题",  
        "bdSnsKey":{},
        "bdText":"此处填写自定义的分享内容",
        "bdMini":"2",
        "bdMiniList":false,
        "bdPic":"http://www.linkloud.cn/L7new/images/public/Logo.jpg",
        "bdStyle":"2",
        "bdSize":"24"},
        "share":{}
    };
    with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];