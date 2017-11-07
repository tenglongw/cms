$(function(){
	changeyear();
//	$('span[name="span_date"]').on('click',function(){
//		$('span[name="span_date"]').each(function(index,val){
//			$(val).removeClass('cc');
//		});
//		$(this).addClass('cc');
//		showAndHide($(this).text());
//	});
//	selectDate ();
	var myDate = new Date();
	currentYear = myDate.getFullYear(); 
//	$('#TimeNav').find('.cc').html(currentYear);
//	$('#TimeNav').find('.ll').html(currentYear+1);
//	$('#TimeNav').find('.rr').html(currentYear-1);
	showAndHide(currentYear);
})


//日期切换时隐藏和显示
function showAndHide(showName){
//	console.log(showName);
	$('#digger_list').find('li').each(function(index,val){
		var this_name = $(val).attr('name');
		if(this_name == showName){
			$(val).show();
		}else{
			$(val).hide();
		}
	});
}

function changeyear(){
	var TimeNav = $('#TimeNav');
	var cc = $('#TimeNav').find('.cc');
	var llt,cct,rrt; 

	TimeNav.on('click','.left',function(){
		removeOne();
	})

	TimeNav.on('click','.right',function(){
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
			TimeNav.find('.ll').text(llt+1);
			TimeNav.find('.cc').text(cct+1);
			showAndHide(cct+1);
			TimeNav.find('.rr').text(rrt+1);
		}
	}

	function removeOne(){
		thisind()
		if((llt-1)>=2013){
			TimeNav.find('.ll').text(llt-1);
			TimeNav.find('.cc').text(cct-1);
			showAndHide(cct-1);
			TimeNav.find('.rr').text(rrt-1);
		}
	}

	function thisind(){
		llt = parseInt(TimeNav.find('.ll').text());
	 	cct = parseInt(TimeNav.find('.cc').text());
		rrt = parseInt(TimeNav.find('.rr').text());
	}
	

}