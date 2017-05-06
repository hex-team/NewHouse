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
setTimeout(function() {
    particlesJS('particles-js', {
    "particles": {
        "number": {
            "value": 160,
            "density": {
                "enable": true,
                "value_area": 800
            }
        },
        "color": {
            "value": "#bebebe"
        },
        "shape": {
            "type": "circle",
            "stroke": {
                "width": 0,
                "color": "#000000"
            },
            "polygon": {
                "nb_sides": 5
            },
            "image": {
                "src": "img/github.svg",
                "width": 100,
                "height": 100
            }
        },
        "opacity": {
            "value": 1,
            "random": true,
            "anim": {
                "enable": true,
                "speed": 1,
                "opacity_min": 0,
                "sync": false
            }
        },
        "size": {
            "value": 3,
            "random": true,
            "anim": {
                "enable": false,
                "speed": 4,
                "size_min": 0.3,
                "sync": false
            }
        },
        "line_linked": {
            "enable": false,
            "distance": 150,
            "color": "#ffffff",
            "opacity": 0.4,
            "width": 1
        },
        "move": {
            "enable": true,
            "speed": 14,
            "direction": "none",
            "random": true,
            "straight": false,
            "out_mode": "out",
            "bounce": false,
            "attract": {
                "enable": false,
                "rotateX": 600,
                "rotateY": 600
            }
        }
    },
    "interactivity": {
        "detect_on": "canvas",
        "events": {
            "onhover": {
                "enable": true,
                "mode": "bubble"
            },
            "onclick": {
                "enable": true,
                "mode": "repulse"
            },
            "resize": true
        },
        "modes": {
            "grab": {
                "distance": 400,
                "line_linked": {
                    "opacity": 1
                }
            },
            "bubble": {
                "distance": 250,
                "size": 0,
                "duration": 2,
                "opacity": 0,
                "speed": 3
            },
            "repulse": {
                "distance": 400,
                "duration": 0.4
            },
            "push": {
                "particles_nb": 4
            },
            "remove": {
                "particles_nb": 2
            }
        }
    },
    "retina_detect": true
});
},700);


function MainPageInit() {
    $('html').removeClass('inner_content');
    $('.menu').addClass('hide_animation');
    $('.logo').addClass('hide_animation');
    $('.logo_img').addClass('show_again');
    $('.logo_img').get(0).outerHTML = $('.logo_img').get(0).outerHTML;
    setTimeout(function () {
        $('body').removeClass('inner_page');
        $('.logo').removeClass('inner_logo');
        $('body').addClass('main_page');
        $('.menu').removeClass('push_menu_right');
        $('.menu').removeClass('hide_animation');
        $('.logo').removeClass('hide_animation');

    }, 350);
    setTimeout(function () {
        $('.logo_img').removeClass('show_again');
    }, 3000);
}

/****************************
 *							*
 *      Inner Page Config 	*
 *							*
 ****************************/

function InnerPageInit() {
    $('.menu li').removeClass('active');
    if ($('body').hasClass('main_page')) {
        $('body').removeClass('main_page');
        $('body').addClass('inner_page');
    }
    if ($(window).width() > 815) {
        $('.menu').addClass('push_menu_left');
        setTimeout(function () {
            $('.menu').removeClass('push_menu_left');
            $('.menu').addClass('push_menu_right');
        }, 400);
    }
    setTimeout(function () {
        $('.logo').removeClass('fadeout');
        $('.logo').addClass('inner_logo');
    }, 600);
}

/****************************
 *							*
 *      Menu Click Event 	*
 *							*
 ****************************/

$(document).on('click', '.menu li a', function (event) {

    if ($(window).width() <= 815) {
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
    } else {
        $(this).unbind('hover');
        var State = $(this).attr('href').replace('#', '');
        if (State !== "home") {
            $('.logo').addClass('fadeout');
            InnerPageInit();
            $(this).parent().addClass('active');
        }
    }

});

$(document).on('click', '#MenuButton', function (event) {
    $('#CloseMenu').addClass('show_btn');
    $('.menu').addClass('push_from_right');
});

$(document).on('click', '#CloseMenu', function (event) {
    $(this).removeClass('show_btn');
    $('.menu').removeClass('push_from_right');
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

function ActiveMenu(href) {
    $('.menu li').each(function () {
        if ($(this).children('a').attr('href') == href) {
            $(this).addClass('active');
        }
    });
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
    
    setTimeout(function () {
        $('.logo_circle').addClass('start_circle_animation');
    },200);

    setTimeout(function () {
        $('.main').addClass('no_selector');
        $('.logo_circle').remove();
    }, 630);

    var State = window.location.hash.replace('#', '');

    switch (State) {
        case "":
            break;
        case "project":
            return InnerPageInit(), ActiveMenu('#project'), GetProject();
            break;
        case "innerproject":
            return InnerPageInit(), ActiveMenu('#project'), GetSingleProject();
            break;
        case "about":
            return InnerPageInit(), ActiveMenu('#about'), GetAboutTemplate();
            break;
        case "contact":
            return InnerPageInit(), ActiveMenu('#contact'), ShowTest();
            break;
        case "home":
            break;
    }
}

/****************************
 *							*
 *   Catch Hash Event       *
 *							*
 ****************************/

$(window).bind('hashchange', function () {

    $('.content').html('');
    $('html').removeClass('inner_content');
    $('.content').removeClass('data_loaded');

    var State = window.location.hash.replace('#', '');

    switch (State) {
        case "":
            break;
        case "project":
            return InnerPageInit(), ActiveMenu('#project'), GetProject();
            break;
        case "innerproject":
            return InnerPageInit(), ActiveMenu('#project'), GetSingleProject();
            break;
        case "about":
            return InnerPageInit(), ActiveMenu('#about'), GetAboutTemplate();
            break;
        case "contact":
            return InnerPageInit(), ActiveMenu('#contact'), ShowUnderconsideration();
            break;
        case "underconsideration":
            return InnerPageInit(), ShowUnderconsideration();
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

function GetProject() {

    var source = $("#ProjectPage").html();
    var template = Handlebars.compile(source);

    var data = [{
            image: 'data/photo_2017-01-29_14-44-15.jpg',
            title: 'Kajal Residential Project',
            date: 'Tehran 1386'
        },
        {
            image: 'data/photo_2017-01-29_14-44-39.jpg',
            title: 'Kajal Residential Project',
            date: 'Tehran 1386'
        },
        {
            image: 'data/photo_2017-01-29_14-44-33.jpg',
            title: 'Kajal Residential Project',
            date: 'Tehran 1386'
        },
        {
            image: 'data/photo_2017-01-29_12-45-36.jpg',
            title: 'Kajal Residential Project',
            date: 'Tehran 1386'
        },
        {
            image: 'data/photo_2017-01-29_11-59-02.jpg',
            title: 'Kajal Residential Project',
            date: 'Tehran 1386'
        },
        {
            image: 'data/photo_2017-01-29_14-44-15.jpg',
            title: 'Kajal Residential Project',
            date: 'Tehran 1386'
        }
    ];

    setTimeout(function () {
        $('html').addClass('inner_content');
        $('.content').append(template(data));
        $('.project_list').attr('data-page', 0);
    }, 500);

    setTimeout(function () {
        $('.content').addClass('data_loaded');
    }, 1200);
};

function GetSingleProject() {

    var source = $("#InnerProject").html();
    var template = Handlebars.compile(source);

    var data = {
        title: 'Kajal Residential Project',
        date: 'Tehran 1386',
        location: 'North Dibaji',
        client: 'Babak Sedaghat Kamal , Sepehr Oshagh',
        architect: 'Hootan Karoobe',
        ai: 'Hooman Faridi',
        description: 'Lorem ipsum dolor sit amet, quisque ipsum massa augue in nulla. Maecenas dui lorem dolor interdum in etiam. Euismod consectetuer imperdiet odio, nostrum viverra eu molestie amet id, ac mattis quis mi enim curabitur in, eget vestibulum erat nostra rhoncus sed laoreet. Tellus sed, a et ultrices libero ultricies dui, nulla id et, aliquet et felis tortor id dignissim nec. Ut wisi sit at beatae nullam, sed egestas in, turpis vestibulum etiam, lectus aliquam. Tincidunt vestibulum non natoque nonummy sit, etiam orci ullamcorper tempus nibh vivamus nunc, ornare interdum praesent. Suspendisse sed at euismod eget, imperdiet integer vehicula diam wisi magna sed, libero sociis a dolor, quisque eget, rhoncus vestibulum at feugiat augue. Nunc non velit suspendisse porttitor elementum, nam quisque pellentesque curae ornare, in iaculis. Sed tincidunt, proin cum, parturient eu sodales ut. Volutpat mi libero. Consequat non auctor dis ut pharetra vitae. Rutrum lectus commodo venenatis tristique sollicitudin nam, dui magna risus. Vitae ad adipiscing justo non ante in, velit suspendisse proin pellentesque mi faucibus, parturient neque enim. Libero bibendum arcu tellus dapibus, parturient et. Non eu vestibulum placerat, eu morbi nunc donec, aliquam vitae a praesent blandit, euismod et curabitur, euismod ridiculus proin erat. Ullamco elementum elementum, quis maecenas accumsan nonummy in, sem luctus lacinia sollicitudin accumsan ligula fringilla, mollis nullam donec volutpat ante eleifend dui, sed lectus varius etiam purus arcu. Turpis vitae urna aliquet ornare mauris nisl, eu lorem quis dui erat. Convallis enim rutrum nibh etiam, arcu rhoncus donec class pulvinar aenean. Sed est ut pede, conubia elit arcu erat libero consequat aenean, molestie turpis donec aute vitae vitae, vitae eu in wisi interdum vehicula consequat, quis blandit urna rutrum. Feugiat nisl ac et proin, magnis neque nibh ultricies, sagittis cras, elit suscipit, ac suspendisse curabitur. Egestas et et et fringilla, hendrerit non malesuada nec.',
        images: [{
                source: 'data/photo_2017-01-29_14-44-15.jpg'
            },
            {
                source: 'data/photo_2017-01-29_14-44-33.jpg'
            },
            {
                source: 'data/photo_2017-01-29_14-44-39.jpg'
            },
            {
                source: 'data/photo_2017-01-29_12-45-36.jpg'
            },
            {
                source: 'data/photo_2017-01-29_11-59-02.jpg'
            }
        ]
    };

    setTimeout(function () {
        $('html').addClass('inner_content');
        $('.content').append(template(data));
    }, 500);

    setTimeout(function () {
        $('.content').addClass('data_loaded');
        $('#Loader').remove();
        $('#Gallery').css('opacity', '1');
    }, 1200);
};

function GetAboutTemplate() {

    var source = $("#AboutPage").html();
    var template = Handlebars.compile(source);

    var data = {
        title: 'About Us',
        description: 'Lorem ipsum dolor sit amet, quisque ipsum massa augue in nulla. Maecenas dui lorem dolor interdum in etiam. Euismod consectetuer imperdiet odio, nostrum viverra eu molestie amet id, ac mattis quis mi enim curabitur in, eget vestibulum erat nostra rhoncus sed laoreet. Tellus sed, a et ultrices libero ultricies dui, nulla id et, aliquet et felis tortor id dignissim nec. Ut wisi sit at beatae nullam, sed egestas in, turpis vestibulum etiam, lectus aliquam. Tincidunt vestibulum non natoque nonummy sit, etiam orci ullamcorper tempus nibh vivamus nunc, ornare interdum praesent. Suspendisse sed at euismod eget, imperdiet integer vehicula diam wisi magna sed, libero sociis a dolor, quisque eget, rhoncus vestibulum at feugiat augue. Nunc non velit suspendisse porttitor elementum, nam quisque pellentesque curae ornare, in iaculis. Sed tincidunt, proin cum, parturient eu sodales ut. Volutpat mi libero. Consequat non auctor dis ut pharetra vitae. Rutrum lectus commodo venenatis tristique sollicitudin nam, dui magna risus. Vitae ad adipiscing justo non ante in, velit suspendisse proin pellentesque mi faucibus, parturient neque enim. Libero bibendum arcu tellus dapibus, parturient et. Non eu vestibulum placerat, eu morbi nunc donec, aliquam vitae a praesent blandit, euismod et curabitur, euismod ridiculus proin erat. Ullamco elementum elementum, quis maecenas accumsan nonummy in, sem luctus lacinia sollicitudin accumsan ligula fringilla, mollis nullam donec volutpat ante eleifend dui, sed lectus varius etiam purus arcu. Turpis vitae urna aliquet ornare mauris nisl, eu lorem quis dui erat. Convallis enim rutrum nibh etiam, arcu rhoncus donec class pulvinar aenean. Sed est ut pede, conubia elit arcu erat libero consequat aenean, molestie turpis donec aute vitae vitae, vitae eu in wisi interdum vehicula consequat, quis blandit urna rutrum. Feugiat nisl ac et proin, magnis neque nibh ultricies, sagittis cras, elit suscipit, ac suspendisse curabitur. Egestas et et et fringilla, hendrerit non malesuada nec.',
        header: {
            source: 'data/about_1.jpg'
        },
        images: [{
                source: 'data/about_2.jpg',
                name: 'Eng.Mehdi Mohammadi',
                position: 'CEO'
            },
            {
                source: 'data/about_3.jpg',
                name: 'Eng.Mehdi Mohammadi',
                position: 'CEO'
            }
        ]
    };

    setTimeout(function () {
        $('html').addClass('inner_content');
        $('.content').append(template(data));
    }, 500);

    setTimeout(function () {
        $('.content').addClass('data_loaded');
    }, 1200);
};

function ShowUnderconsideration() {
    $('.content').addClass('data_loaded');
    $('.content').html('<p class="alert">این قسمت در دست ساخت است.</p>');
};

/****************************
 *							*
 *      Responsive Event     * 
 *							*
 ****************************/

function CheckForWidth() {}

$(window).resize(function (e) {});

/****************************
 *							*
 *  Project Carousel Event   * 
 *							*
 ****************************/

var Page = 0;

$(document).on('click', '#LeftArrow', function () {

    $('.right').removeClass('disabled');

    Page = parseInt($('.project_list').attr('data-page'));

    if (Page !== 0) {
        $('.project_list').attr('data-page', Page - 1);
        $('.page_number').text(Page - 1);

        $('.project_list').removeClass('righttoleft');
        $('.project_list').removeClass('lefttoright');

        setTimeout(function () {
            $('.project_list').addClass('righttoleft');
        }, 100);
    }
    if (Page - 1 == 0) {
        $(this).parent().addClass('disabled');
    }
});

$(document).on('click', '#RightArrow', function () {

    $('.left').removeClass('disabled');

    Page = parseInt($('.project_list').attr('data-page'));
    $('.project_list').attr('data-page', Page + 1);
    $('.page_number').text(Page + 1);

    $('.project_list').removeClass('lefttoright');
    $('.project_list').removeClass('righttoleft');

    setTimeout(function () {
        $('.project_list').addClass('lefttoright');
    }, 100);

    if (Page + 1 == 2) {
        $(this).parent().addClass('disabled');
    }

});