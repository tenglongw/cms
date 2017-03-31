$(function() {
	// body...

	function NavFun(){
		var $but = $('#headerPublic').find('a.nav');
		var $suo = $('#headerPublic').find('a.suo');

		var $navCn = $('#pubnavCon');

		$but.toggle(function(){
			$navCn.show();
		},function(){
			$navCn.hide();
		})

		$suo.click(function(){
			$('#Indsearch').show();
		})
		$('#Indsearch').on('click','.txit',function(){
			$('#Indsearch').hide();
		})



		$('ul.NaOne').on('click','div.jian',function(){
			var datain = $(this).parent('li').attr('data-ind');
			if (datain == '0' || datain == undefined) {
				$(this).parent('li').addClass('active').siblings().removeClass('active');
				$(this).parent('li').attr('data-ind','1').siblings().attr('data-ind','0');

			}else if (datain == '1') {
				$(this).parent('li').removeClass('active').siblings().removeClass('active');
				$(this).parent('li').attr('data-ind','0').siblings().attr('data-ind','0');

			}
		})

		


	}


	NavFun();
})