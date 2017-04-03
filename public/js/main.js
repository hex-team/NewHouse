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
    $('.menu').addClass('push_menu_left');
    setTimeout(function () {
        $('.menu').removeClass('push_menu_left');
        $('.menu').addClass('push_menu_right');
    }, 400);
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
            InnerPageInit();
            ActiveMenu('#project');
            break;
        case "news":
            InnerPageInit();
            ActiveMenu('#news');
            break;
        case "about":
            InnerPageInit();
            ActiveMenu('#about');
            break;
        case "contact":
            InnerPageInit();
            ActiveMenu('#contact');
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

    $(this).unbind('hover');
    var State = $(this).attr('href').replace('#', '');
    if (State !== "home") {
        $('.logo').addClass('fadeout');
        InnerPageInit();
        $(this).parent().addClass('active');
    }

});

/****************************
*							*
*   Inner Menu Click Event  *
*							*
****************************/

$(document).on('click', '.menu li div.inner_menu', function (event) {

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
*      Responsive Event     * 
*							*
****************************/

function CheckForWidth(){
    if($(window).width() <= 815 && $(window).width() > 550){
        $('nav.menu').css('width',$('.logo').width()+"px");
    }
}

$( window ).resize(function(e) {
  if(e.target.outerWidth <= 815 && $(window).width() > 550){
      $('nav.menu').css('width',$('.logo').width()+"px");
  }
});