var HomeCorporateSocialResponsibilitySwiper = null;

//首页banner开始方法
function HomeBannerStart(argument) {
    var mySwiper = new Swiper ('#HomeBanner', {

        // 如果需要分页器
        pagination: '.swiper-pagination',
        paginationClickable :true,
        onInit: function(swiper){ //Swiper2.x的初始化是onFirstInit
            swiperAnimateCache(swiper); //隐藏动画元素 
            swiperAnimate(swiper); //初始化完成开始动画
        }, 
        onSlideChangeEnd: function(swiper){ 
            swiperAnimate(swiper); //每个slide切换结束时也运行当前slide动画
        } 


    })  
 } 

//首页banner开始方法 end

HomeBannerStart();
//浏览器变化 方法

window.addEventListener('resize',function() {
    HomeCorporateSocialResponsibility();
},false)

//浏览器变化 方法





// HomeCorporateSocialResponsibility
    HomeCorporateSocialResponsibility();


function HomeCorporateSocialResponsibility(argument) {

    if (window.innerWidth <= 750) {
         HomeCorporateSocialResponsibilitySwiper = new Swiper ('#HomeCorporateSocialResponsibility', {
            loop: true,

        }) 

        // console.log(HomeCorporateSocialResponsibilitySwiper)


    }else{

        if (HomeCorporateSocialResponsibilitySwiper) {
            HomeCorporateSocialResponsibilitySwiper.destroy(false); 

            // console.log(HomeCorporateSocialResponsibilitySwiper)

            $('#HomeCorporateSocialResponsibility').find('.swiper-slide').removeAttr('style')


        }
    }
}

function HomeSubsidiariesSwiper(argument) {
     var myswiper = new Swiper ('#HomeSubsidiariesSwiper', {
            loop: true,
            nextButton: '.SubsidiariesNext',
            prevButton: '.SubsidiariesPrev',

        }) 

}
HomeSubsidiariesSwiper();
















 //KEY FIGURES 数据 缓冲效果
 function HomeKeyFiguresFun(data){
    if ($('#HomeKeyFigures').length>0) {

        var options = {
             useEasing : true,
              useGrouping : true,
              separator : '',
              decimal : '.',
              prefix : '',
              suffix : ''

        };

        $('#HomeKeyFigures').waypoint(function(){
            var numAnim = new CountUp("HomeKeyFigures_1", 0, 10.1, 1, 3.5, options);
            numAnim.start();
            var numAnim = new CountUp("HomeKeyFigures_2", 0, 22.4, 1, 3.5, options);
            numAnim.start();
            var numAnim = new CountUp("HomeKeyFigures_3", 0, 28, 0, 3.5, options);
            numAnim.start();
            var numAnim = new CountUp("HomeKeyFigures_4", 0, 19163, 0, 3.5, options);
            numAnim.start();
            var numAnim = new CountUp("HomeKeyFigures_5", 0, 15.28, 2, 3.5, options);
            numAnim.start();
        }, { offset: '100%' });
    };

 }
    
HomeKeyFiguresFun()

 //KEY FIGURES 数据 缓冲效果 end









 // 附属公司联系我们切换


 function HomeSubsidiariesAndContactUsFun() {
     var Cnav = $('#HomeSubsidiariesAndContactUsNav');



     Cnav.on('click', 'li', function(event) {
         console.log($(this));
         var index = $(this).index();

         $(this).addClass('active').siblings().removeClass('active');


         if (index == 0) {
            $('#SubsidiariesHomeCn').show();
            $('#ContactUsHoemCn').hide();
         }else{
            $('#ContactUsHoemCn').show();
            $('#SubsidiariesHomeCn').hide();
         }


     });


 }
 HomeSubsidiariesAndContactUsFun()


 // 附属公司联系我们切换 end