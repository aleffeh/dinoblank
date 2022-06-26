// header.blade.php
function SetGnbOn() {
    var gnb = $('.gnb').children('nav').children('ul').eq(0);
    var locationHref = window.location.href;
    var gnbChildren = gnb.children('li');

    $.each(gnbChildren, function (index, value) {
        $(this).children('a').eq(0).removeAttr('class');
    });

    $(".dep01-2, .dep01-4, .dep01-5").each(function(idx, element) {
        $(this).hover(function() {
            $(this).children("a").addClass("over");
        }, function() {
            $(this).children("a").removeClass("over");
        });
    });

    if (locationHref.indexOf('/news') > -1) {
        gnbChildren.eq(0).children('a').eq(0).attr('class', 'on');
        return;
    }
    if(locationHref.indexOf('/media') > -1){
        gnbChildren.eq(1).children('a').eq(0).attr('class', 'on');
        return;
    }
    if(locationHref.indexOf('/schedule') > -1){
        gnbChildren.eq(2).children('a').eq(0).attr('class', 'on');
        return;
    }
    if(locationHref.indexOf('/stats') > -1){
        gnbChildren.eq(3).children('a').eq(0).attr('class', 'on');
        return;
    }
    if(locationHref.indexOf('/about') > -1){
        gnbChildren.eq(4).children('a').eq(0).attr('class', 'on');
        return;
    }
}

function SetGnbDepthOn() {
    var locationHref = window.location.href;
    var gnbDepth = $('.dep01-2 > .dep02').next('ul').eq(0);

    if(locationHref.indexOf('/stats') > -1){
        gnbDepth = $('.dep01-4 > .dep02').next('ul').eq(0);
    }
    if(locationHref.indexOf('/about') > -1){
        gnbDepth = $('.dep01-5 > .dep02').next('ul').eq(0);
    }

    var gnbDepthChildren = gnbDepth.children('li');

    $.each(gnbDepthChildren, function (index, value) {
        $(this).children('a').eq(0).removeAttr('class');
    });

    if(locationHref.indexOf('/media/vod') > -1){
        gnbDepthChildren.eq(0).children('a').eq(0).attr('class', 'on');
        return;
    }
    if(locationHref.indexOf('/media/photo') > -1){
        gnbDepthChildren.eq(1).children('a').eq(0).attr('class', 'on');
        return;
    }
    if(locationHref.indexOf('/media/download') > -1){
        gnbDepthChildren.eq(2).children('a').eq(0).attr('class', 'on');
        return;
    }
    if(locationHref.indexOf('/stats/teams') > -1){
        gnbDepthChildren.eq(0).children('a').eq(0).attr('class', 'on');
        return;
    }
    if(locationHref.indexOf('/stats/players') > -1){
        gnbDepthChildren.eq(1).children('a').eq(0).attr('class', 'on');
        return;
    }
    if(locationHref.indexOf('/stats/tournament') > -1){
        gnbDepthChildren.eq(2).children('a').eq(0).attr('class', 'on');
        return;
    }
    if(locationHref.indexOf('/about/flow') > -1){
        gnbDepthChildren.eq(0).children('a').eq(0).attr('class', 'on');
        return;
    }
    if(locationHref.indexOf('/about/history') > -1){
        gnbDepthChildren.eq(1).children('a').eq(0).attr('class', 'on');
        return;
    }
    if(locationHref.indexOf('/about/fund') > -1){
        gnbDepthChildren.eq(2).children('a').eq(0).attr('class', 'on');
        return;
    }
}
SetGnbOn(); //gnb 활성화
SetGnbDepthOn();

//global-pblink 탭
$(".global-pb-list").find("button").click(function(){
    $(".global-pblink").find("button").removeClass("active");
    $(".global-pblink").find("ul").removeClass("active");
    
    if($(this).next("ul").css("display")=="none"){
        $(".global-pblink").find("ul").slideUp();
        $(".global-pblink").find("ul").hide();
        $(this).next("ul").slideDown();
        $(this).addClass("active");
        $(this).next("ul").addClass("active");
    }else{
        $(".global-pblink").find("ul").slideUp();
    }
});

//share
function shareFacebook(url){
	window.open('https://www.facebook.com/sharer/sharer.php?u=' + url, 'shareFacebook', 'width=600px, height=400px');
}

function shareTwitter(url){
	window.open('https://twitter.com/intent/tweet?url=' + url, 'shareTwitter', 'width=600px, height=400px');
}

// Youtube 오브젝트 가져오기
function getYoutubeObject(videoUrl){
    var youtubeObject;

    if(document.documentMode || /Edge/.test(navigator.userAgent)){
        if (getInternetExplorerVersion() <= 8.0) {
            youtubeObject = '<iframe src="http://www.youtube.com/embed/' + videoUrl + '" frameborder="0" allowfullscreen=""></iframe>';
        }
        else{
            youtubeObject = '<object width="100%" height="100%" data="http://www.youtube.com/v/' + videoUrl + '"></object>';
        }
    }
    else if(navigator.userAgent.indexOf('Firefox') > -1 || navigator.userAgent.indexOf('Safari') > -1){
        youtubeObject = '<embed width="100%" height="100%" src="http://www.youtube.com/embed/' + videoUrl + '" frameborder="0" allowfullscreen=""></embed>';
    }
    else{
        youtubeObject = '<iframe src="http://www.youtube.com/v/' + videoUrl + '" frameborder="0" allowfullscreen=""></iframe>';
    }

    return youtubeObject;
}

//팝업 레이어 사이즈 설정
function setLayerPopupSize(marginTop)
{
    var contentHeight = $(".layer-pop").find(".content").height();
    var layerPopHeight = contentHeight+73;

    if($(window).height() < layerPopHeight){
        $(".pop-content").css({"margin-top":-(contentHeight/marginTop)+"px"});
        $(".pop-content").find(".content").css({"width":"90%"});
    }else if( $(window).width() < 1280){
        $(".pop-content").css({"margin-top":-(contentHeight/marginTop)+"px"});
        $(".pop-content").find(".content").css({"width":"90%"});
    }else{
        $(".pop-content").css({"margin-top":-(contentHeight/marginTop)+"px"});
        $(".pop-content").find(".content").css({"width":"100%", "max-width":"1024px"});
    }
}

//IE 버전체크
function getInternetExplorerVersion()
{
  var rv = -1;
  if (navigator.appName == 'Microsoft Internet Explorer')
  {
    var ua = navigator.userAgent;
    var re  = new RegExp("MSIE ([0-9]{1,}[\.0-9]{0,})");
    if (re.exec(ua) != null)
      rv = parseFloat( RegExp.$1 );
  }
  return rv;
}

// 라이브온 이미지 left 값
function liveImgLeft(){
    var winWidth = $(window).width();
    var liveonImgLeft = (winWidth - 1280)/2;
    if(winWidth < 976){
        $(".liveon-img").css({"left":"-150px"});
    }else if(winWidth < 1280){
        $(".liveon-img").css({"left":liveonImgLeft+"px"});
    }else{
        $(".liveon-img").css({"left":"0px"});
    }
}

$(window).resize(function(){
    liveImgLeft();
});

// 실시간중계 보기
function showLiveOn(url, type){
    $('#liveOnVod').html(getLiveOnObject(url, type));
    $('#liveOnContent').slideDown();
}

// 실시간중계 숨기기
function hideLiveOn(){
    $('#liveOnContent').slideUp();
    setTimeout("$('#liveOnVod').html('')", 1000);
}

// 실시간중계 닫기
function closeLiveOn(){
    $('#liveOnVod').html('');
    $('.live-on .bnr, .live-on .live-content').hide();
}

// 실시간중계 VOD 오브젝트 가져오기
function getLiveOnObject(url, type){
    var liveOnObject;

    if(type == '1'){
        if(document.documentMode || /Edge/.test(navigator.userAgent)){
            if (getInternetExplorerVersion() <= 8.0) {
                liveOnObject = '<iframe src="http://www.youtube.com/embed/' + url + '" frameborder="0" allowfullscreen=""></iframe>';
            }
            else{
                liveOnObject = '<object width="100%" height="100%" data="http://www.youtube.com/v/' + url + '"></object>';
            }
        }
        else if(navigator.userAgent.indexOf('Firefox') > -1 || navigator.userAgent.indexOf('Safari') > -1){
            liveOnObject = '<embed width="100%" height="100%" src="http://www.youtube.com/embed/' + url + '" frameborder="0" allowfullscreen=""></embed>';
        }
        else{
            liveOnObject = '<iframe src="http://www.youtube.com/v/' + url + '" frameborder="0" allowfullscreen=""></iframe>';
        }
    }

    if(type == '0'){
        if(document.documentMode || /Edge/.test(navigator.userAgent)){
            if (getInternetExplorerVersion() <= 8.0) {
                liveOnObject = '<iframe src="http://player.twitch.tv/?channel=' + url + '" frameborder="0" allowfullscreen=""></iframe>';
            }
            else{
                liveOnObject = '<object width="100%" height="100%" data="http://player.twitch.tv/?channel=' + url + '"></object>';
            }
        }
        else if(navigator.userAgent.indexOf('Firefox') > -1 || navigator.userAgent.indexOf('Safari') > -1){
            liveOnObject = '<embed width="100%" height="100%" src="http://player.twitch.tv/?channel=' + url + '" frameborder="0" allowfullscreen=""></embed>';
        }
        else{
            liveOnObject = '<iframe src="http://player.twitch.tv/?channel=' + url + '" frameborder="0" allowfullscreen=""></iframe>';
        }
    }

    liveOnObject = liveOnObject + '<button type="button" class="cls-content" onclick="hideLiveOn()">liveOn content close</button>';

    return liveOnObject;
}


//select-box blur시 셀렉트버튼 이미지 변환
$('.select-form select').each(function(idx, elem){
    $(elem).on({        
        focusin: function(){
            $(elem).addClass('focus');
            $(elem).on({
                mousedown: function(){
                    $(elem).toggleClass('focus');
                }
            });
        },
        change: function(){
            $(elem).removeClass('focus');
        },
        blur: function(){
            $(elem).removeClass('focus');
            $(elem).unbind('mousedown');
        }
    });
});

//footer partners 슬라이드
$('.slider-p').bxSlider({
    slideWidth: 75,
    minSlides: 1,
    maxSlides: 2,
    pager:false,
    infiniteLoop:false
});

 //footer sponsors 슬라이드
$('.slider-s').bxSlider({
    slideWidth: 75,
    minSlides: 1,
    maxSlides: 2,
    pager:false,
    infiniteLoop:false
});