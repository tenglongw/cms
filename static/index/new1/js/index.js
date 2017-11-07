$(function() {

				
				embedHtml();
				function embedHtml(){
					var html = '<embed id="player" src="" allowFullScreen="true" quality="high" align="middle" allowScriptAccess="always" type="application/x-shockwave-flash"></embed>';
					$('#video_embed').append(html);
				}

				VideoCnFun()
				//VideoCnFun 试图切换
				function VideoCnFun(){
					var $VideoCn = $('#VideoCn');

					$VideoCn.on('click','.left',function(){
						$VideoCn.find('.right').addClass('left').removeClass('right');
						$VideoCn.find('.center').addClass('right').removeClass('center').find('a').removeClass('active');
						$(this).addClass('center').removeClass('left').find('a').addClass('active');
						var url = $(this).attr('data-url');
						$('#player').attr('src',url);
					})

					$VideoCn.on('click','.right',function(){
						$VideoCn.find('.left').addClass('right').removeClass('left');
						$VideoCn.find('.center').addClass('left').removeClass('center').find('a').removeClass('active');
						$(this).addClass('center').removeClass('right').find('a').addClass('active');
						var url = $(this).attr('data-url');
						$('#player').attr('src',url);
					})

					$VideoCn.on('click','.center',function(){
						var url = $(this).attr('data-url');

						console.log(url);

						$('#videoCon').show();
						$('#player').attr('src',url);
//						$('#videoCon').find('embed').attr('src',url);
					})


				}
				
				addVideoUrl()
				function addVideoUrl(){
					var url = $('#VideoCn .center').attr('data-url');
					$('#player').attr('src',url);
				}
				
				//VideoCnFun 试图切换 end


				InBannerSwiperFun();
				
				function InBannerSwiperFun(){


					// alert('执行 swiper InBannerSwiperFun')
					var InBannerSwiper = new Swiper ('#InBannerSwiper', {
						    // direction: 'vertical',
						    loop: true,
						    autoplay:3000,
						    
						    // 如果需要分页器
						    // paginationClickable :true,
						    pagination: '.InBannerOnePagination',
						    
						    // 如果需要前进后退按钮
						    // nextButton: '.InBannerOneNext',
						    // prevButton: '.InBannerOnePrev',
						    
						    
						}) 


						$('.InBannerOnePrev').click(function(){
							InBannerSwiper.swipePrev(); 
						})
						$('.InBannerOneNext').click(function(){
							InBannerSwiper.swipeNext(); 
						}) 
				}


				
				exhibitionSwiperFun();

				function exhibitionSwiperFun(){

					// alert('执行 swiper exhibitionSwiperFun')

					var exhibitionSwiper = new Swiper('#exhibitionSwiper', {
						    loop: true,

						    slidesPerView : 4,
					    
						}) 

					$('.exhibitionPrev').click(function(){
							exhibitionSwiper.swipePrev(); 
						})
					$('.exhibitionNext').click(function(){
							exhibitionSwiper.swipeNext(); 
						}) 
				}
				













			})

