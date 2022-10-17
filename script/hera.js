// JavaScript Document
$(function(){
$('.prev_btn').click(function(){ // 앞으로 버튼을 클릭하면 뭔가를 하겠다
$('.v_slide > li:eq(14)').prependTo('.v_slide'); // 마지막 이미지를 선택 ul태그
});
$('.next_btn').click(function(){ //1번째 이미지를 선택,ul태그의
$('.v_slide > li:eq(0)').appendTo('.v_slide');
});
});

$('.v_slide > li').mouseover(function(){
    $(this).children('.v_slide_sub').stop().slideDown('fast');
});

$('.v_slide > li').mouseleave(function(){
    $(this).children('.v_slide_sub').stop().slideUp('fast');
});

var scrollTop = 0;
		
$(window).scroll(function(){ // 브라우저 스크롤이 움직이면 뭔가를 하겠다
scrollTop = $('html, body').scrollTop();

if(scrollTop >= 100){ // 스크롤값이 100이상이면 실행문 적용하고 if문 탈출
$('#header p').css('display','block');
} else if(scrollTop < 100) { 
$('#header p').css('display','none');
}});


$('.wrap-autoplay-control button #img1').click(function(){
    $('#img1').hide();
    $('#img2').show();
});

$('.wrap-autoplay-control button #img2').click(function(){
    $('#img2').hide();
    $('#img1').show();
});

    //메인 스외이퍼
    var swiper = new Swiper('.swiper-container', {
        slidesPerView: 1,
        spaceBetween: 10,
        loop: true,
        loopFillGroupWithBlank: true,
        pagination: {
	el: ".swiper-pagination",
          clickable: true,
        },
        navigation: {
          nextEl: ".swiper-button-next",
          prevEl: ".swiper-button-prev",
        },
		autoplay: {
        delay: 5000, // 자동으로 화면 전환 2초
        disableOnInteraction: false	// 손님이 넘길 때는 오토플레이 정지
            },
        effect: 'fade', // slide, fade, cube, coverflow, flip
        on: {
        init: function () {
            thisSlide = this;
            autoPlayBtn = document.querySelector('.wrap-autoplay-control > button');
            autoPlayBtn.addEventListener('click', (e) => {
                autoPlayState = autoPlayBtn.getAttribute('aria-pressed');
                if (autoPlayState === 'false') {
                    autoPlayBtn.setAttribute('aria-pressed', 'true');
                    thisSlide.autoplay.stop();
                } else if (autoPlayState === 'true') {
                    autoPlayBtn.setAttribute('aria-pressed', 'false');
                    thisSlide.autoplay.start();
                };
            });
        },
    },
      });

    var swiper = new Swiper('swiper_m', {
        slidesPerView: 1,
        slidesPerGroup: 1,
        loop: true,
        pagination : {
        el : '.swiper-pagination',
        clickable : true, 
        type : 'bullets',
        },
        effect: 'fade', // slide, fade, cube, coverflow, flip
        speed: 2000
        });

		//모바일 스와이프
		var swiper3 = new Swiper(".m_swiper", {
        slidesPerView: 3,
        spaceBetween: 20,
        slidesPerGroup: 3,
        loop: true,
        loopFillGroupWithBlank: true,
        navigation: {
          nextEl: ".swiper-button-next",
          prevEl: ".swiper-button-prev",
        },
      });