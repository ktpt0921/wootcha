$(function () {
    // 객체참조변수선언
    var container = $(".slideShow");
    var slideGroup = container.find(".slideShow_slides");
    var slides = slideGroup.find("a");
    var slideCount = slides.length;
    var nav = container.find(".slideShow_nav");
    var prev = nav.find(".css-jxbkzh-StyledJumbotronArrowButton-StyledJumbotronArrowPrevButton");
    var next = nav.find(".css-1kvaztz-StyledJumbotronArrowButton-StyledJumbotronArrowNextButton");
    var indicator = container.find(".slideShow_indicator");
    var aIndicator = indicator.find("a");
    var title = $(".movie_title_main > h1");
    var subTitle = $(".movie_title_main > h2");
    var aIndicatorCount = aIndicator.length; //배열길이 4개
    var currentIndex = 0;

    // 1. 슬라이드를 자동으로 움직이는 기능을 구현.
    //    이미지를 가로로 배치시켜야한다.
    // for(var index =0; index<slides.length; index++){
    //   var indexLeft = index*100+"%";
    //   slides.eq(index).css("left", indexLeft);
    // }
    slides.each(function (i) {
        var indexLeft = i * 100 + "%";
        $(this).css({left: indexLeft});
    });

    //  자동으로 애니메이션으로 보이는 방법구현
    function gotoSlide(index) {
        // 애니메이션주는방법 객체.animate(구현내용, 걸리는시간, 보여주는방법)
        // 구현내용 : left : 0%, -100%, -200%, -300%
        // 걸리는시간 : 1초를 진행하고
        // 보여주는방법 : 한칸씩.. 움직이는데. 절도있게 움직인다
        slideGroup.animate({left: -100 * index + '%'}, 500, 'swing');
        // index : 0번일때 왼쪽은 안보이고 ,오른쪽은 보이고
        // index : 3번일때 왼쪽은 보이고, 오른쪽은 안보이고
        title.text(movie_title[index]);
        subTitle.text(movie_subtitle[index]);
        currentIndex = index;

        indexDisplay();
    }

    function indexDisplay() {
        if (currentIndex === 0) {
            prev.addClass("disabled");
        } else {
            prev.removeClass("disabled");
        }

        if (currentIndex === slides.length - 1) {
            next.addClass("disabled");
        } else {
            next.removeClass("disabled");
        }

        // indicator를 배경화면을 셋팅한다.
        aIndicator.removeClass('active');
        aIndicator.eq(currentIndex).addClass('active');
    }

    function startTimer() {
        timer = setInterval(function () {
            var nextIndex = (currentIndex + 1) % slideCount;
            currentIndex = nextIndex;
            gotoSlide(nextIndex);
        }, 3500);
    }

    function stopTimer() {
        clearInterval(timer);
    }

//=====마우스 올렸을때 이벤트======
    container.mouseenter(function () {
        stopTimer();
    });

    container.mouseleave(function () {
        startTimer();
    });

//======이전 다음 버튼 이벤트======
    prev.on("click", function (e) {
        // e.preventDefault(); 원래 anker 기능을 하지못하도록 막는다.
        if (currentIndex !== 0) {
            currentIndex -= 1;
        }
        gotoSlide(currentIndex);
    });

    next.on("click", function (e) {
        if (currentIndex !== slideCount - 1) {
            currentIndex += 1;
        }
        gotoSlide(currentIndex);
    });

    aIndicator.on("click", function (e) {
        e.preventDefault();
        var index = $(this).index();
        gotoSlide(index);
    });

// 맨처음진행시 초기화시킨 함수
    startTimer();

});


// 스크롤 버튼
$(document).ready(function () {
    $('#movetopbt').bind('click', function () {
        $('html, body').animate({scrollTop: '0'}, 680);
    });
    // 애니메이션 효과로 자연스럽게 이동됨, 0.68초

    $('#movetopbt').on('click', function () {
        $('html').scrollTop('0');
    });
    // 애니메이션 효과없이 즉시 해당 위치 0 지점으로 이동함
});

