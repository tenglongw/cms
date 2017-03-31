$(function() {
    var cantext = true;
    var time = null;
    var currentPage = 1;
    var hasMore = true;
    var ConList = $('#data_list');
    var IfTop = 0;
    $('#Max_Con').scroll(function(){
        var scrollY = $(this)[0].scrollTop;
        var innerHeight =  $(window)[0].innerHeight;
        var documentHeight  = $(this)[0].scrollHeight; 
        var height = scrollY +innerHeight;

        if (height > (documentHeight-280) && cantext && IfTop < scrollY && hasMore) {
            IfTop = scrollY;
            ajaxFun();
            cantext = false;
            time = setTimeout(function(){cantext = true; console.log(cantext)}, 3000);
        }
    })
    ajaxFun()
    function ajaxFun(){
        if (hasMore && cantext) {
            $.ajax({
                url: url+currentPage,
                type: 'GET',
                dataType: 'JSONP'
            })
            .done(function(data) {
            	console.log(data);
                currentPage++;
                hasMore  = data.page.hasMore;
                addIndexHtml(data.lists);
                if (!hasMore) {
                    $('.IndMore').find('a').hide();
                    $('.IndMore').find('span').show().text('已经到底了！');
                }
            })
        }else{
        }
    }
})