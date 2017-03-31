$(function() {
	// body...
	changeyear();
})
function changeyear(){
		var TimeNav = $('#TimeNav');
		var cc = $('#TimeNav').find('.center');
		var llt,cct,rrt; 

		TimeNav.on('click','.befoer',function(){
			removeOne();
		})

		TimeNav.on('click','.after',function(){
			addOne();
		})

		TimeNav.on('click','.ll',function(){
			addOne();
		})
		TimeNav.on('click','.rr',function(){
			removeOne();
		})

		function addOne(){
			if((rrt+1)<=2018){
				thisind()
	
				TimeNav.find('.befoer').text(llt+1);
				TimeNav.find('.center').text(cct+1);
				showAndHide(cct+1);
				TimeNav.find('.after').text(rrt+1);
			}
		}

		function removeOne(){
			thisind()
			TimeNav.find('.befoer').text(llt-1);
			TimeNav.find('.center').text(cct-1);
			showAndHide(cct-1);
			TimeNav.find('.after').text(rrt-1);
		}

		function thisind(){
			llt = parseInt(TimeNav.find('.befoer').text());
		 	cct = parseInt(TimeNav.find('.center').text());
			rrt = parseInt(TimeNav.find('.after').text());
		}
		

	}

//日期切换时隐藏和显示
function showAndHide(showName){
	console.log(showName);
	$('#digger_list').find('li').each(function(index,val){
		var this_name = $(val).attr('name');
		if(this_name == showName){
			$(val).show();
		}else{
			$(val).hide();
		}
	});
}