$(function(){
	//tab 
    function onSelectTab(){  
    	// $('.tab').removeClass('js_off');
        var myClass = $(this).parent('li').attr('class');
        $(this).parents('.tab:first').attr('class', 'tab '+ myClass);
        $('.tab').find('button').click(onSelectTab).focus(onSelectTab);
    }


    //bxslider의 slide width값 계산
    var bxSliderWidth = $(".spot-slides").width();
    $(".slide").find(".slide-col").width((bxSliderWidth - 30)/3);

    var smRowSlideWidth = $(".slide-col").width();
    $(".slide-two-col").find(".slide-big-row").width(bxSliderWidth - smRowSlideWidth - 15.5);
    if($(window).width() < 1280){
        var left = (418 - $(".slide").find(".slide-col").width())/2;
        $(".slide-col").find("img").css({"left":-left+"px"});
    }else{
        $(".slide-col").find("img").css({"left":"0px"});
    }
    $(window).resize(function(){
        var bxSliderWidth = $(".spot-slides").width();
        $(".slide").find(".slide-col").width((bxSliderWidth - 30)/3);
        var smRowSlideWidth = $(".slide-col").width();
        $(".slide-two-col").find(".slide-big-row").width(bxSliderWidth - smRowSlideWidth - 15.5);

        if($(window).width() < 1280){
            var left = (418 - $(".slide").find(".slide-col").width())/2;
            $(".slide-col").find("img").css({"left":-left+"px"});
        }else{
            $(".slide-col").find("img").css({"left":"0px"});
        }
    });


    $('.bxslider').bxSlider(); //bxslider 실행
    // $('.slider1').bxSlider({
    //     slideWidth: 200,
    //     minSlides: 4,
    //     maxSlides: 4,
    //     pager:false
    // }); //bxslider 실행
    onSelectTab(); //tab 실행
});