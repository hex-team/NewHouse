/****************************
*							*
*      Load Config 			*
*							*
****************************/

window.addEventListener('load', Load, !1);

/****************************
*							*
*      Main Page Config     *
*							*
****************************/

function MainPageInit(){
    $('html').removeClass('inner_content');
    $('.menu').addClass('hide_animation');
    $('.logo').addClass('hide_animation');
    $('.logo_img').addClass('show_again');
    $('.logo_img').get(0).outerHTML = $('.logo_img').get(0).outerHTML;
    setTimeout(function(){
        $('body').removeClass('inner_page');
        $('.logo').removeClass('inner_logo');
        $('body').addClass('main_page');
        $('.menu').removeClass('push_menu_right');
        $('.menu').removeClass('hide_animation');
        $('.logo').removeClass('hide_animation');
        
    }, 350);
    setTimeout(function(){
        $('.logo_img').removeClass('show_again');
    },1900);
}

/****************************
*							*
*      Inner Page Config 	*
*							*
****************************/

function InnerPageInit(){
    $('.menu li').removeClass('active');
    if ($('body').hasClass('main_page')) {
        $('body').removeClass('main_page');
        $('body').addClass('inner_page');
    }
    if($(window).width() > 815 ){
        $('.menu').addClass('push_menu_left');
        setTimeout(function () {
            $('.menu').removeClass('push_menu_left');
            $('.menu').addClass('push_menu_right');
        }, 400);
    }
    setTimeout(function() {
        $('.logo').removeClass('fadeout');
        $('.logo').addClass('inner_logo');
    }, 600);
}

/****************************
*							*
*      Route Config 	    *
*							*
****************************/

function Load() {

    CheckForWidth();

    $('#Main').addClass('loaded');

    $('body').addClass('show_border');

    setTimeout(function() {
        $('.main').addClass('no_selector');
    }, 1300);

    var State = window.location.hash.replace('#','');

    switch (State) {
        case "":
            break;
        case "project":
            return InnerPageInit(),ActiveMenu('#project');
            break;
        case "innerproject":
            return $('html').addClass('inner_content'),InnerPageInit(),ActiveMenu('#project'),GetSingleProject();
            break;
        case "news":
            return InnerPageInit(),ActiveMenu('#news');
            break;
        case "about":
            return InnerPageInit(),ActiveMenu('#about');
            break;
        case "contact":
            return InnerPageInit(),ActiveMenu('#contact');
            break;
        case "home":
            break;
    }
}

/****************************
*							*
*      Menu Click Event 	*
*							*
****************************/

$(document).on('click', '.menu li a', function (event) {

    if($(window).width() <= 815 ){
        $('#CloseMenu').removeClass('show_btn');
        $('.menu').removeClass('push_from_right');
        $(this).unbind('hover');
        var State = $(this).attr('href').replace('#', '');
        document.location.hash = State;
        if (State == "home") {
            MainPageInit();
        } else {
            InnerPageInit()
            $('.menu li').removeClass('active');
            $(this).parent().addClass('active');
        }
    }else{
        $(this).unbind('hover');
        var State = $(this).attr('href').replace('#', '');
        if (State !== "home") {
            $('.logo').addClass('fadeout');
            InnerPageInit();
            $(this).parent().addClass('active');
        }
    }

});

$(document).on('click','#MenuButton',function(event){
    $('#CloseMenu').addClass('show_btn');
    $('.menu').addClass('push_from_right');
});

$(document).on('click','#CloseMenu',function(event){
    $(this).removeClass('show_btn');
    $('.menu').removeClass('push_from_right');
});

/****************************
*							*
*   Inner Menu Click Event  *
*							*
****************************/

$(document).on('click', '.menu li div.inner_menu', function (event) {
    
    // $('.content').removeClass('data_loaded');
    // $('.content').html('');
    $(this).unbind('hover');
    var State = $(this).attr('href').replace('#', '');
    document.location.hash = State;
    if (State == "home") {
        MainPageInit();
    } else {
        $('.menu li').removeClass('active');
        $(this).parent().addClass('active');
    }
});

/****************************
*							*
*   Loaded Menu Event       *
*							*
****************************/

function ActiveMenu(href){
    $('.menu li').each(function(){
        if($(this).children('a').attr('href') == href){
            $(this).addClass('active');
        }
    });
}

/****************************
*							*
*   Catch Hash Event       *
*							*
****************************/

$(window).bind('hashchange', function() {

    $('.content').html('');
    $('html').removeClass('inner_content');
    $('.content').removeClass('data_loaded');

    var State = window.location.hash.replace('#','');

    switch (State) {
        case "":
            break;
        case "project":
            return InnerPageInit(),ActiveMenu('#project');
            break;
        case "innerproject":
            return $('html').addClass('inner_content'),InnerPageInit(),ActiveMenu('#project'),GetSingleProject();
            break;
        case "news":
            return InnerPageInit(),ActiveMenu('#news');
            break;
        case "about":
            return InnerPageInit(),ActiveMenu('#about');
            break;
        case "contact":
            return InnerPageInit(),ActiveMenu('#contact');
            break;
        case "home":
            break;
    }
});

/****************************
*							*
*      Get Page Data        * 
*							*
****************************/

function GetSingleProject(){

    var source = $("#InnerProject").html(); 
    var template = Handlebars.compile(source); 

    var data = {
        title:'پروژه مسکونی کـژال',
        date:'تهــران ۱۳۸۶',
        description:'پول هدف اصلی همه‌ی کسب و کارهاست. اگر پولی نتوانیم از مشتری دریافت کنیم عملاً انگار کسب و کاری نداریم.                     باید دنبال پول مشتریان خود باشیم. پولی که به اندازه‌ای باشد که به ما منفعت برساند. هزینه‌های ما را پوشش داده و سرمایه‌ای برای ما اندوخته کند.                     به این فکر کنید که یک سازنده، پول خودش را که با هزار زحمت به دست آورده، چگونه خرج می‌کند. کار سختیه! می‌دونم. به این راحتی نمیشه از سازنده‌ها پول دریافت کرد؛ اونم تو این بازار رکود.                     اما در نهایت این سازنده باید پروژه ساختمانی خودش را به انجام برساند و حتماً خریدهای خود را انجام دهد.                     به این فکر کنید چگونه می‌توانید این شما باشید که از او پول دریافت می‌کنید.                    پول هدف اصلی همه‌ی کسب و کارهاست. اگر پولی نتوانیم از مشتری دریافت کنیم عملاً انگار کسب و کاری نداریم.                     باید دنبال پول مشتریان خود باشیم. پولی که به اندازه‌ای باشد که به ما منفعت برساند. هزینه‌های ما را پوشش داده و سرمایه‌ای برای ما اندوخته کند.                     به این فکر کنید که یک سازنده، پول خودش را که با هزار زحمت به دست آورده، چگونه خرج می‌کند. کار سختیه! می‌دونم. به این راحتی نمیشه از سازنده‌ها پول دریافت کرد؛ اونم تو این بازار رکود.                     اما در نهایت این سازنده باید پروژه ساختمانی خودش را به انجام برساند و حتماً خریدهای خود را انجام دهد.                     به این فکر کنید چگونه می‌توانید این شما باشید که از او پول دریافت می‌کنید.پول هدف اصلی همه‌ی کسب و کارهاست. اگر پولی نتوانیم از مشتری دریافت کنیم عملاً انگار کسب و کاری نداریم.                     باید دنبال پول مشتریان خود باشیم. پولی که به اندازه‌ای باشد که به ما منفعت برساند. هزینه‌های ما را پوشش داده و سرمایه‌ای برای ما اندوخته کند.                     به این فکر کنید که یک سازنده، پول خودش را که با هزار زحمت به دست آورده، چگونه خرج می‌کند. کار سختیه! می‌دونم. به این راحتی نمیشه از سازنده‌ها پول دریافت کرد؛ اونم تو این بازار رکود.                     اما در نهایت این سازنده باید پروژه ساختمانی خودش را به انجام برساند و حتماً خریدهای خود را انجام دهد.                     به این فکر کنید چگونه می‌توانید این شما باشید که از او پول دریافت می‌کنید.',
        images:[{source:'public/data/photo_2017-01-29_14-44-15.jpg'},
        {source:'public/data/photo_2017-01-29_14-44-33.jpg'},
        {source:'public/data/photo_2017-01-29_14-44-39.jpg'},
        {source:'public/data/photo_2017-01-29_12-45-36.jpg'},
        {source:'public/data/photo_2017-01-29_11-59-02.jpg'}]
    };

    $('.content').append(template(data));

    setTimeout(function(){
        $('.content').addClass('data_loaded');
        var $grid = $('.grid').imagesLoaded( function() {
            $grid.masonry({
                itemSelector: '.grid-item',
                percentPosition: true,
                gutter: 10,
                columnWidth: '.grid-sizer'
            }); 
        });
    },1200);
};

/****************************
*							*
*      Responsive Event     * 
*							*
****************************/

function CheckForWidth(){
    if($(window).width() <= 815 && $(window).width() > 550){
        //$('nav.menu').css('width',$('.logo').width()+"px");
    }
}

$( window ).resize(function(e) {
  if(e.target.outerHeigth <= 815 && $(window).height() > 550){
      //$('nav.menu').css('width',$('.logo').width()+"px");
  }
});