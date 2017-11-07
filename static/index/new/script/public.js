var serverPath = '';
var footerSwiper = null;




function windowScrollFun(){

	var navCon = $('#header');



	$(window).scroll(function(){

		var before = $(window).scrollTop();
		navCon.find('.Mnav').hide();
		$(window).scroll(function() {
			var after = $(window).scrollTop();

			if (before<after) {
                // console.log('下');
                before = after;
                // console.log(after);
                if (after <= 150 ) {
                	navCon.css('top', (-after)+'px');
                }else if (after >= 500){

                	navCon.css('top', '-120px');

                }
            };

            if (before>after) {
                // console.log('上');
                before = after;
                navCon.css({
                	'top': '0px',
                	'transition': 'all 0.7s',
                });
            };
            if (after >700) {
            	$('#goTop').show();
            }else{
            	$('#goTop').hide();
            }
        });
	});

	$("html,body").on('click','#goTop',function() {
    	// body...
    	$("html,body").animate({scrollTop: 0}, 300);

    })



}

windowScrollFun();




   //NAV导航控制
   function NAVset(){
   	var header = $('#header');
   	var NaW = header.find('.nav');
   	var pullDown = header.find('.pullDown');


   	var MRn = header.find('.MRn');
   	var Mnav = header.find('.Mnav');
   	var SetTime = null;
   	var Oind = 0;

   	NaW.on("mouseover mouseout",'li',function(event){
   		Oind = $(this).index();

   		if (Oind) {
   			if(event.type == "mouseover"){
		  		//鼠标悬浮
		  		clearTimeout(SetTime);
		  		pullDown.show();

		  		event.stopPropagation();
		  	}else if(event.type == "mouseout"){
		 		 //鼠标离开
		 		 settimeFun();
		 		 event.stopPropagation();
		 	}

		 }



		 })

    header.on('click', '.searchBtn', function(event) {
      header.find('.searchCon').show();
    });
    header.find('.searchCon').on('click', '.close', function(event) {
       header.find('.searchCon').hide();
    });

   	pullDown.hover(function() {
   		clearTimeout(SetTime);
   	}, function() {
   		settimeFun();
   	});

   	MRn.find('#toggleNav').click(function(event) {
   		Mnav.toggle();
   	});

    Mnav.find('ul.list').on('click', '.ToNavTwo', function(event) {
      event.preventDefault();
      /* Act on the event */
      $(this).parent('li').addClass('active').siblings().removeClass('active');
      
    });

   	Mnav.find('.One').on('click', '>li .jian', function(event) {
   		event.preventDefault();
   		$(this).parent('li').addClass('active').siblings().removeClass('active');
   		/* Act on the event */
   	});







   	function settimeFun(){
   		SetTime = setTimeout(function(){
   			pullDown.hide();
   		},500)
   	}

   }

   NAVset();
   //NAV导航控制 end//NAV导航控制 end




// window.onresize = function(){

// }

window.addEventListener('resize',function() {
  iSwindowWid();
  
},false)

function iSwindowWid() {
  if (window.innerWidth <= 750) {
      footerSwiper.params.slidesPerView=3;
  }else{
      footerSwiper.params.slidesPerView=5;
  }
  footerSwiper.reLoop();
  footerSwiper.slideTo(0, 0, false);

}


//公用底部sweiper
function footerSwiperSwiper() {
  
    var footerSlidesPerView = 5;
     if (window.innerWidth <= 750) {
          footerSlidesPerView =3;
      }else{
          footerSlidesPerView =5;

      }

      footerSwiper = new Swiper ('#footerSwiper', {
            loop: true,
            slidesPerView : footerSlidesPerView,
            nextButton: '.FooterSwiperNext',
            prevButton: '.FooterSwiperPrev',

        }) 

}
footerSwiperSwiper();


//公用底部sweiper end

