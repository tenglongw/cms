var cantext = true;
var time = null;

var currentPage = 1;

var hasMore = true;

var IfTop = 0;
$(function() {
    ajaxFun()

})
$(window).scroll(function(){
	
	var scrollY = $(this)[0].scrollY;
	var innerHeight =  $(this)[0].innerHeight;
	var documentHeight  = $(document).height(); 
	var height = scrollY +innerHeight;
	if (height > (documentHeight-420) && cantext && IfTop < scrollY && hasMore) {
		IfTop = scrollY;
		console.log('触发');
		ajaxFun();
		cantext = false;
		time = setTimeout(function(){cantext = true; console.log(cantext)}, 3000);
		
	}
})
function ajaxFun(){

    	var pid = $('#more').attr('data-id');
        if (hasMore && cantext) {

            $.ajax({
                url: 'http://120.26.192.83/index.php/index/comment/list_data?pid='+pid+'&page='+currentPage,
                type: 'GET',
                dataType: 'JSONP',
                async :false
            })
            .done(function(data) {

                currentPage++;
                hasMore  = data.page.hasMore;
                addDoem(data.lists);
                if (!hasMore) {
                    $('.IndMore').find('a').hide();
                    $('.IndMore').find('span').show().text('已经到底了！');

                }
            })
        }else{
            // CnAlert('已经到底了！');
        }
                
    }
    