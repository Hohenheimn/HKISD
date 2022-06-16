var isMobile = {
  Android: function () {
    return navigator.userAgent.match(/Android/i);
  },
  BlackBerry: function () {
    return navigator.userAgent.match(/BlackBerry/i);
  },
  iOS: function () {
    return navigator.userAgent.match(/iPhone|iPad|iPod/i);
  },
  Opera: function () {
    return navigator.userAgent.match(/Opera Mini/i);
  },
  Windows: function () {
    return navigator.userAgent.match(/IEMobile/i);
  },
  any: function () {
    return (
      isMobile.Android() ||
      isMobile.BlackBerry() ||
      isMobile.iOS() ||
      isMobile.Opera() ||
      isMobile.Windows()
    );
  }
};

function closeCookie() {
  $('.cookiePolicy')
    .removeClass('.cookiePolicy')
    .addClass('cookiePolicy-2');
}

(function () {
  $(document).ready(function () {    
    $('.multiple-items').slick({
      infinite: true,
      // variableWidth: true,
      slidesToShow: 3,
      slidesToScroll: 3,
      responsive: [{
          breakpoint: 1024,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 2
          }
        },
        {
          breakpoint: 768,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 2
          }
        },
        {
          breakpoint: 690,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1
          }
        }
        // You can unslick at a given breakpoint now by adding:
        // settings: "unslick"
        // instead of a settings object
      ]
    });
    $('.multiple-items-2').slick({
      infinite: true,
      adaptiveHeight: true,
      // variableWidth: true,
      slidesToShow: 1,
      slidesToScroll: 1,
      responsive: [{
          breakpoint: 1024,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1
          }
        },
        {
          breakpoint: 768,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1
          }
        },
        {
          breakpoint: 690,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1
          }
        }
        // You can unslick at a given breakpoint now by adding:
        // settings: "unslick"
        // instead of a settings object
      ]
    });

    $('.item-carousel-fours').slick({
      infinite: true,
      // variableWidth: true,
      slidesToShow: 4,
      slidesToScroll: 4,
      responsive: [{
          breakpoint: 1130,
          settings: {
            slidesToShow: 3,
            slidesToScroll: 1
          }
        },
        {
          breakpoint: 991,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 2
          }
        },
        {
          breakpoint: 690,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1
          }
        }
        // You can unslick at a given breakpoint now by adding:
        // settings: "unslick"
        // instead of a settings object
      ]
    });

    $('.item-carousel-fours-mobile').slick({
      infinite: false,
      // variableWidth: true,
      slidesToShow: 1,
      slidesToScroll: 1
    });
    // setIframe();

    $('.scroll-down-wrap .scroll-down').on('click', function(e){
        var scrollVal = $(this).parents('section').next('section').offset().top - 50; 

        

        $('html, body').animate({
          scrollTop: scrollVal
        },500, 'easeOutExpo');

        console.log(scrollVal)
    });
  });
})();

$(window).on('load', function () {
  // setIframe();
  checkIfGlobeIsVisible();
  slimScroll();
  slimScrollSnapshot();
  // heroResize();
});
$(window).scroll(function () {
  checkIfGlobeIsVisible();
});
$(document).on('ready', function () {
  // videoRemove();
  $(window).resize();
  slideSubMenu();
  socialButton();
  elementAnimation();
  mobileMenu();
  // socialMedia();
  social();
  newHeader();
  headingBg();
  browseMenu();
  collapseMegaMenu();
  industryArticle();
  cityBriefing();
  showGlobeDesc();
  mobileGlobeList();
  snapShotImage();
  infographicIframe();
  exploreDataNow();
  disableScroll();
  scrollInteractive();
  translucentheader();
  headerScroll();
  interactiveToolClicker();
  inView();
  darkMenu();
  stickyHeader()
  

  function stickyHeader() {
    
    var header = $('.header-container');
    var lastScrollTop = 0;
    
    $(window).scroll(function(){
        var yPos = $(this).scrollTop();

        if(yPos > $('.main-header').outerHeight() - 16) {
            header.addClass('sticky');
            $('body').css('padding-top', $('.header-container').outerHeight())
        } else {
            header.removeClass('sticky');
            $('body').css('padding-top', 0);
        }
        lastScrollTop = yPos;
    });
};
  function darkMenu(){
    var $btnMenu = $('.btn__menu');
    var $closeMenu = $('.btn__close-menu')
    var $mainHeader = $('.main-header')


    var $mobileChevronHandles = $('.nav-dark-mobile li div.mobile-list h2');

    $btnMenu.on('click', function(){
        if(!$mainHeader.hasClass('is-active')){
            $mainHeader.addClass('is-active')
        }
    })
    $closeMenu.on('click', function(){
        if($mainHeader.hasClass('is-active')){
            $mainHeader.removeClass('is-active')
        }
    })

    $mobileChevronHandles.on('click', function(){
        //console.log('Clicked')
        //$(this).parents('.nav-dark-mobile-wrapper').find('.mobile-list').not($(this).parents('.mobile-list')).removeClass('expanded-mobile-item');            
        $(this).parents('.mobile-list').toggleClass('expanded-mobile-item');
        
        
        

    });
}


  $('.btn_back-to-top').click(function() {
    $("html, body").animate({scrollTop: 0}, 500);
    });
  function inView() {
    $('.animated').one('inview', function(event, isInView) {
        var _this = $(this);
        var animatedChildren = _this.find('.animated-child');
        if(isInView){
            if(animatedChildren.length > 0) {
                var animateElement;
                if(_this.hasClass('animated-reverse')) {
                    animateElement = animatedChildren.toArray().reverse();
                } else {
                    animateElement = animatedChildren;
                }
  
                TweenMax.staggerTo(animateElement, 0.4, { y: 0, x:0, opacity: 1, delay: 0.1}, 0.1)
            }
        }
    });
  
    $(".img-wrapper").one("inview", function(event, isInView){
        var _this = $(this);
        var animatedChildren = _this.find('img');
  
        if(isInView){
            if(animatedChildren.length > 0) {
                TweenMax.to(animatedChildren, 1.3, { scale: 1, opacity: 1, delay: 0.3, ease: Expo.easeOut}, 0.1)
            }
        }
    })
  
    $(".section-qoute .quote").one("inview", function(event, isInView){
        var _this = $(this);
        var textWrapper = $(this).find("blockquote p .hide").text().split(" ");
        var sp = 1;
        textWrapper.map(function(word){
            _this.find("blockquote p .show").append("<span class='letter'> " +word + " </span>")
        })
        
        // textWrapper.innerHTML = textWrapper.textContent.replace(/\S/g, "<span class='letter'>$&</span>");
        TweenMax.set(_this.find("blockquote p .show .letter"), {opacity: 0 , x: 40, z: 0})
  
        if(isInView){
            
            TweenMax.staggerTo(_this.find("blockquote p .show .letter"), sp, {x:0,opacity:1,y:0, ease: Expo.easeOut}, 0.1)
            
        }
    })
  }
  
  function translucentheader(){
    var nav = $('.container__translucent-header');
    $('.js-burger').on('click', function(){
      if (!nav.hasClass('active')){
        nav.addClass('active');
      }else{
        nav.removeClass('active');
      }
    })
  }

  $(".social-button").addClass("social-button-hide")

  // slideSubMenu()
  // slideSubMenu();

  // if ($(window).innerWidth() < 769) {
  //   slideSubMenuMobile()
  // } else {
  //   slideSubMenu()
  // }
  // mapItems();

  $('#back-to-top').on('click', function (e) {
    console.log('test');
    e.preventDefault();
    $('html,body').animate({
        scrollTop: 0
      },
      700
    );
  });

  $('#advert-once').on('click', function () {
    $('#advert-once').hide();
  });
  $('#advert-btn').on('click', function () {
    $('.feature-content').slideToggle();
  });

  $('.icon-close').on('click', function () {
    $('.feature-content').slideUp();
  });
  $(window).scroll(function () {
    if ($(this).scrollTop() > 100) {
      $('.scrollup').fadeIn();
    } else {
      $('.scrollup').fadeOut();
    }
  });
  $(window).resize(function () {
    // if ($(window).innerWidth() < 769) {
    //   slideSubMenuMobile()
    // } else {
    //   slideSubMenu()
    // }
    slideSubMenu();
    // videoRemove();
    if ($(window).width() > 480) {
      $('body').addClass('mobile-vp');
    } else {
      $('body').removeClass('mobile-vp');
    }
    // hideSocialMediaMenu();
  });
  $('.scrollup').click(function () {
    $('html, body').animate({
        scrollTop: 0
      },
      600
    );
    return false;
  });

  $('.cross').hide();
  $('.menu').hide();
  $('.hamburger').on('click', function () {
    $('.menu').slideToggle('slow', function () {
      $('.hamburger').hide();
      $('.cross').show();
    });
  });

  $('.cross').on('click', function () {
    $('.menu').slideToggle('slow', function () {
      $('.cross').hide();
      $('.hamburger').show();
    });
  });

  if (sessionStorage.getItem('advertOnce') !== 'true') {
    $('.cookie-container').append(
      '<section class="section-cookie"><div id="advert-once" class="cookiePolicy" style="z-index:100;"> <div style="background-color:#D7EAF4;border-bottom:2px solid #C0D1DA;font-size:12px;text-align:center;color:#333;position:relative;"> <p style="padding:6px 50px 6px 10px;margin:0;">This website uses cookies to store your data, for more information see our  <a href="http://www.economistgroup.com/results_and_governance/governance/privacy" target="_blank" style="text-decoration:underline;color:#0D394D;font-weight:bold;">privacy policy</a> and <a style="text-decoration:underline;color:#0D394D;font-weight:bold;" target="_blank" href="http://www.economist.com/cookies-info">change your settings</a> at any time<a id="close-cookie" onClick="closeCookie();" style="cursor: pointer; cursor: hand;text-decoration:none;color:#0D394D;font-weight:bold;position:absolute;top:6px;right:10px;">Close</a></p></div></div></section>'
    );
    sessionStorage.setItem('advertOnce', 'true');
  }

  $('#advert-once .advert-button').on('click', function () {
    $('#advert-once').hide();
  });

  $('#reset-session').on('click', function () {
    sessionStorage.setItem('advertOnce', '');
  });

  $('#close-cookie').on('click', function () {
    $('.cookie-container').css({
      'margin-top': '0px',
      'transition-duration': '0.5s'
    });
  });
});


function checkIfGlobeIsVisible() {
  if ($('body').hasClass('page-id-6')) {
    if ($(window).scrollTop() > $('#section-3').offset().top) {
      if (!$('.globe').hasClass('active')) {
        $('.globe')
          .addClass('active')
          .show();
      }
    } else {
      $('.globe')
        .removeClass('active')
        .hide();
    }
  }
}

function slimScroll() {
  var postChoices = $('.industry-briefing .title-list, .industry-briefing .title-list-mobile ul');
  $('.industry-briefing .title-list ul li').click(function (e) {
    var activePostHeight = $('.industry-briefing .post-info.active-article').height()
    var scrollHeight = $(window).innerWidth() < 414 ? 200 : activePostHeight;
    postChoices.slimScroll({
      color: '#6381a2',
      size: '5px',
      height: scrollHeight,
      alwaysVisible: true
    });
  })
  var activePostHeight = $('.industry-briefing .post-info.active-article').height()
  var scrollHeight = $(window).innerWidth() < 414 ? 200 : activePostHeight;
  postChoices.slimScroll({
    color: '#6381a2',
    size: '5px',
    height: scrollHeight,
    alwaysVisible: true
  });
}

function slimScrollSnapshot() {
  var postChoices2 = $('.city-snapshots .title-list, .city-snapshots .title-list-mobile ul');

  $('.city-snapshots .title-list ul li').click(function (e) {
    var activePostHeight2 = $('.city-snapshots .post-info.active-article').height()
    var scrollHeight2 = $(window).innerWidth() < 414 ? 200 : activePostHeight2;
    postChoices2.slimScroll({
      color: '#6381a2',
      size: '5px',
      height: scrollHeight2,
      alwaysVisible: true
    });
    console.log(activePostHeight2)
  })
  var activePostHeight2 = $('.city-snapshots .post-info.active-article').height()
  var scrollHeight2 = $(window).innerWidth() < 414 ? 200 : activePostHeight2;
  postChoices2.slimScroll({
    color: '#6381a2',
    size: '5px',
    height: scrollHeight2,
    alwaysVisible: true
  });
}

function socialButton() {
  $(window).scroll(function () {
    var scroll = $(window).scrollTop();
    if (scroll >= 300) {
      if(window.innerWidth > 767){
        $('.social-button').addClass('scrolled');
      }
    } else {
      $('.social-button').removeClass('scrolled');
    }
  });
}

function elementAnimation() {
  var $animation_elements = $('.animation-element');
  var $window = $(window);

  function check_if_in_view() {
    var window_height = $window.height();
    var window_top_position = $window.scrollTop();
    var window_bottom_position = window_top_position + window_height;

    $.each($animation_elements, function () {
      var $element = $(this);
      var element_height = $element.outerHeight();
      var element_top_position = $element.offset().top;
      var element_bottom_position = element_top_position + element_height;

      // check to see if this current container is within viewport
      if (
        element_bottom_position >= window_top_position &&
        element_top_position <= window_bottom_position
      ) {
        $element.addClass('in-view');
      } else {
        $element.removeClass('in-view');
      }
    });
  }

  $window.on('scroll resize', check_if_in_view);
  $window.trigger('scroll');
}

// function videoRemove() {

//     if ($('body').hasClass('homepage2')) {
//         if (isMobile.any()) {
//             $(".article-image > a > img").removeClass('hide');
//             $(".article-image > a > video").addClass('hide');
//         } else {
//             $(".article-image > a > img").addClass('hide');
//             $(".article-image > a > video").removeClass('hide');
//         }
//     } else if ($('body').hasClass('heroVideo')) {
//         if (isMobile.any()) {
//             $(".hero-image > .background img").removeClass('hide');
//             $(".hero-image > .background video").addClass('hide');
//         } else {
//             $(".hero-image > .background img").addClass('hide');
//             $(".hero-image > .background video").removeClass('hide');
//         }
//     }

// }

function mobileMenu() {
  var menuItem = $('.main-menu .menu-bar nav ul li:nth-child(3) a');

  $('.hamburger-menu').on('click', function () {
    $('.hamburger-menu').toggleClass('active');
  });
  menuItem.on('click', function (event) {
    event.stopPropagation();
    if ($('.sub-menu').hasClass('active')) {
      $('.sub-menu').removeClass('active');
    } else {
      $('.sub-menu').addClass('active');
    }
  });
  // menuItem.on('click', function(event) {
  //     if ($(this).find('ul.submenu').length != 0) {
  //         console.log('meron');

  //     }else{
  //         console.log('wala');

  //     }
  // });
}

// /** STICKY HEADER **/

// $(document).ready(function () {
//     var s = $("#stickyHeader");
//     var pos = s.position();
//     $(window).scroll(function () {
//         var windowpos = $(window).scrollTop();
//         if (windowpos >= pos.top) {
//             s.addClass("stick");
//         } else {
//             s.removeClass("stick");
//         }
//     });
// });

function mapItems() {
  var mapItem = $('.carousel-inner .item');
  mapItem.on('click', function () {
    if ($(this).hasClass('active')) {
      mapItem.removeClass('active');
    } else {
      $('.carousel-inner .item.active').removeClass('active');
      $(this).addClass('active');
    }
  });
}

function socialMedia() {
  // jQuery
  $(location).attr('href');

  // Pure JavaScript
  var pathname = window.location.pathname;

  $('.twitter-share').sharrre({
    share: {
      // twitter: true
    },
    enableHover: false,
    enableTracking: true,
    click: function (api, options) {
      ga('send', 'event', 'Social-Media-Shares', 'Twitter-Share', options.text);
      api.simulateClick();
      api.openPopup('twitter');
    }
  });
  $('.linkedin-share').sharrre({
    share: {
      // linkedin: false
    },
    enableHover: false,
    enableTracking: true,
    click: function (api, options) {
      ga(
        'send',
        'event',
        'Social-Media-Shares',
        'Linked-In-Share',
        options.text
      );
      api.simulateClick();
      api.openPopup('linkedin');
    }
  });
  $('.facebook-share').sharrre({
    share: {
      // facebook: false
    },
    enableHover: false,
    enableTracking: true,
    click: function (api, options) {
      ga(
        'send',
        'event',
        'Social-Media-Shares',
        'Facebook-Share',
        options.text
      );
      api.simulateClick();
      api.openPopup('facebook');
    }
  });
  $('.google-plus-share').sharrre({
    share: {
      // googlePlus: true
    },
    enableHover: false,
    enableTracking: true,
    click: function (api, options) {
      ga(
        'send',
        'event',
        'Social-Media-Shares',
        'Google-Plus-Share',
        options.text
      );
      api.simulateClick();
      api.openPopup('googlePlus');
    }
  });

  $('.email-share').click(function () {
    ga('send', 'event', 'Social-Media-Shares', 'Email-Share', document.title);
  });
}
function social(){
  $('.social-item').on('click', function(e) {

    // var section = $('.section.section-active').index();

    var linkedinLink = 'https://www.linkedin.com/shareArticle?mini=true&url=' + window.location.host + window.location.pathname;
    var twitterLink = 'https://twitter.com/share?text=&url=http://' + window.location.host + window.location.pathname;
    var fbLink = 'https://www.facebook.com/sharer/sharer.php?u=' + window.location.host + window.location.pathname
    var fbLink = 'https://www.facebook.com/sharer/sharer.php?u=' + window.location.host + window.location.pathname
    var gplusLink = 'https://plus.google.com/share?url=' + window.location.host + window.location.pathname
    var emailLink = 'mailto:?&body=' + window.location.host + window.location.pathname
    $('.social-linkedin').attr('href', linkedinLink);
    $('.social-twitter').attr('href', twitterLink);
    $('.social-facebook').attr('href', fbLink);
    $('.social-googleplus').attr('href', gplusLink);
    $('.social-mail').attr('href', emailLink);

})
}

// New header scripts
function newHeader() {
  $('.topics-menu').click(function () {
    newHeaderEvt($('.more-menu, .login-menu'), $(this));
  });

  $('.more-menu').click(function () {
    newHeaderEvt($('.topics-menu, .login-menu'), $(this));
  });

  $('.login-menu').click(function () {
    newHeaderEvt($('.more-menu, .topics-menu'), $(this));
  });

  $('.hamburger-mobile').click(function () {
    newHeaderEvt($('.more-menu, .topics-menu'), $(this));
  });
}

function newHeaderEvt(hideMenus, clickedMenu) {
  var visible = 'balloon--visible';
  var invisible = 'balloon--not-visible';

  hideMenus.removeClass(visible).addClass(invisible);
  if (clickedMenu.hasClass(invisible)) {
    clickedMenu.removeClass(invisible).addClass(visible);
  } else {
    clickedMenu.removeClass(visible).addClass(invisible);
  }
}

// homepage new heading background
function headingBg() {
  // var hero = $('section#hero .background').slick({
  //   arrows: false,
  //   autoplay: true,
  //   autoplaySpeed: 6000,
  //   slidesToScroll: 1
  // });
}

// function hideSocialMediaMenu() {
//   if ($(window).innerWidth() < 690) {
//     if ($('#browse-menu-bar').hasClass('expanded')) {
//       $('.social-button').addClass('hide-element');
//     } else {
//       $('.social-button').toggleClass('hide-element');
//     }
//   }
// }

// browse menu
function browseMenu() {
  var trigger = $('.browse-trigger-menu');
  var browse_menu = $('#new-main-menu');
  var menuContainer = $('.browse-menu-main');
  var browse_trigger = $('.browse-trigger');
  var hamburger = $('.hamburger-icon');
  var closeMenu = $('.close-menu');

  var new_main_menu = $('ul#new-main-menu li.menu-item');
  var sub_menu = $('ul.sub-menu');

  // trigger.click(function () {
  //   menuContainer.slideToggle(400, 'linear')
  //   browse_trigger.toggleClass('browse-trigger-toggle')
  //   hamburger.toggleClass('hamburger-icon-toggle')
  //   closeMenu.toggleClass('show-element')
  //   $('.browse-menu').toggleClass('expanded')
  //   // if ($(window).innerWidth() < 690) {
  //   //   if ($('#browse-menu-bar').hasClass('expanded')) {
  //   //     $('.social-button').addClass('hide-element')
  //   //   } else {
  //   //     $('.social-button').toggleClass('hide-element')
  //   //   }
  //   // }
  //   hideSocialMediaMenu()
  // })

  trigger.click(function (event) {
    event.stopPropagation();
    var browseMenu = $('.browse-menu');
    console.log('menu is clicked')
    if (!browseMenu.hasClass('expanded')) {
      var menuItems = $(
        '#new-main-menu .menu-item-has-children > a:first-child'
      );
      var subMenu = $('#new-main-menu .sub-menu');
      menuContainer.slideDown(400, 'linear');
      browse_trigger.addClass('browse-trigger-toggle');
      hamburger.addClass('hamburger-icon-toggle');
      closeMenu.addClass('show-element');
      var browseMenu = $('.browse-menu');
      $('.browse-menu').addClass('expanded');
      $('.mega-menu li a')
        .next(subMenu)
        .slideUp();
      $(this)
        .parent()
        .siblings()
        .find('a')
        .next(subMenu)
        .slideUp();
      console.log('slidedown');
    } else {
      menuContainer.slideUp(400, 'linear');
      setTimeout(function () {
        browse_trigger.removeClass('browse-trigger-toggle');
        hamburger.removeClass('hamburger-icon-toggle');
        closeMenu.removeClass('show-element');
        $('.browse-menu').removeClass('expanded');
      }, 400);
    }

    // if ($(window).innerWidth() < 690) {
    //   if ($('#browse-menu-bar').hasClass('expanded')) {
    //     $('.social-button').addClass('hide-element')
    //   } else {
    //     $('.social-button').toggleClass('hide-element')
    //   }
    // }

    // hideSocialMediaMenu();
  });

  // closeMenu.click(function () {
  //   menuContainer.slideToggle(400, 'linear')
  //   browse_trigger.toggleClass('browse-trigger-toggle')
  //   hamburger.toggleClass('hamburger-icon-toggle')
  //   closeMenu.toggleClass('show-element')
  // })

  // new_main_menu.click(function () {
  //     if ($(this).has(sub_menu)) {
  //         // $(this).find('active-sub').hide().toggleClass('active-sub');
  //         $(this).find(sub_menu).slideToggle(500, 'linear');
  //     }
  // });
}
// browse_trigger.toggleClass('browse-trigger-toggle');

function collapseMegaMenu() {
  var $win = $(window); // or menu parent container
  var $box = $('#pageBackground');

  $win.on('click.Bst', function (e) {
    var box = document.getElementById('browse-menu-bar');
    var menuContainer = $('.browse-menu-main');
    var browseTrigger = $('.browse-trigger');
    var hamburger = $('.hamburger-icon');
    var closeMenu = $('.close-menu');
    var browseMenu = $('.browse-menu');

    if (
      $box.has(e.target).length == 0 && //checks if descendants of menu was clicked
      !$box.is(e.target) //checks if the menu itself was clicked
    ) {
      $('.browse-menu-main').slideUp();
      browseMenu.removeClass('expanded');
      browseTrigger.removeClass('browse-trigger-toggle');
      hamburger.removeClass('hamburger-icon-toggle');
      closeMenu.removeClass('show-element');
     
    } else {

     
    }
  });
}
// industry article --
function industryArticle() {
  // click events for desktop
  var articleTitle = $('.title-list ul li');

  articleTitle.click(function (e) {
    var data = $(this).data('article');
    var post = $(this)
      .parents()
      .find("[data-post='" + data + "']");

    articleTitle.removeClass('active-article-link');
    $(e.currentTarget).addClass('active-article-link');

    if (post.hasClass('inactive-article')) {
      post.removeClass('inactive-article').addClass('active-article');
    }
    post
      .siblings('.post-info')
      .removeClass('active-article')
      .addClass('inactive-article');
  });
  // click events for mobile
  var list_mobile = $('.mobile-trigger');
  var articleTitleMobile = $('.title-list-mobile ul li');

  $.each($('.mobile-trigger'), function () {
    var list = $(this).siblings();
    var section = list.find("ul").data("id");
    var title = list.find("ul li:nth-child(1)").attr("title");
    $("." + section).find(".mobile-trigger").text(title);
  });

  list_mobile.click(function () {
    $(this).closest('section').find('.title-list-mobile').slideToggle();
    $(this).closest('section').find('.title-list-mobile').toggleClass("active");
  });


  list_mobile.next('.title-list-mobile').find('li').click(function (e) {
    var data = $(this).data('article');
    var post = $(this)
      .closest('section')
      .find("[data-post='" + data + "']");
    var setText = post.find('.post-title').text();


    var data_id = $(this).parent().data("id");
    var value = $(this).attr("title");

    console.log(value)
    $(this).closest('section').find('.mobile-trigger').text(value);
    // if (articleTitleMobile.hasClass('active')) {
    //   $("." + data_id).find(".mobile-trigger").text(value);
    // }

    $(this).closest('section').find('.title-list-mobile').slideUp();
    $(this).closest('section').find('.title-list-mobile').removeClass("active");

    $(this).closest('section').find('.title-list-mobile ul li').removeClass('active-article-link');
    // articleTitleMobile.removeClass('active-article-link');
    $(this).addClass('active-article-link');

    if (post.hasClass('inactive-article')) {
      post.removeClass('inactive-article').addClass('active-article');
    }
    post
      .siblings('.post-info')
      .removeClass('active-article')
      .addClass('inactive-article');
  });

  //
}


function slideMenu() {

}

// city briefing --
function cityBriefing() {
  // TweenMax.set('.cardWrapper', { perspective: 800 });
  // TweenMax.set('.card', { transformStyle: 'preserve-3d' });
  // TweenMax.set($('.country-item.orig .back:even'), {
  //   rotationY: -180,
  //   zIndex: 4
  // });
  // TweenMax.set($('.country-item.flip .back:odd'), {
  //   rotationY: -180,
  //   zIndex: 4
  // });
  // TweenMax.set($('.country-item.flip .front:even'), {
  //   rotationY: -180,
  //   zIndex: 4
  // });
  // TweenMax.set($('.country-item.orig .front:odd'), {
  //   rotationY: -180,
  //   zIndex: 4
  // });
  // TweenMax.set(['.front', '.back'], { backfaceVisibility: 'visible' });
  // // $('.cardWrapper').hover(
  // //   function() {
  // //     TweenMax.to($(this).find('.card'), 1.6, {
  // //       rotationY: 180,
  // //       ease: Back.easeOut,
  // //       force3D: true
  // //     });
  // //   },
  // //   function() {
  // //     TweenMax.to($(this).find('.card'), 1.6, {
  // //       rotationY: 0,
  // //       ease: Back.easeOut,
  // //       force3D: true
  // //     });
  // //   }
  // // );
}

// globe click funcs (home) -l
function showGlobeDesc() {
  var city_list = $('.city-list-item');
  var country = $('.country-info');

  city_list.on('click', function () {
    var city_list_data = $(this).data('city');
    // var cityglobe_list_data = $(this).data('cityglobe');
    var city_desc = $(this)
      .parents()
      .find("[data-desc='" + city_list_data + "']");

    var city_snap_shot = $(this)
      .parents()
      .find("[data-snap='" + city_list_data + "']");

    if (city_desc.hasClass('inactive-city')) {
      city_desc.removeClass('inactive-city').addClass('active-city');
    }

    if (city_snap_shot.hasClass('inactive-city')) {
      city_snap_shot.removeClass('inactive-city').addClass('active-city');
    }

    city_desc
      .siblings('.country-info')
      .removeClass('active-city')
      .addClass('inactive-city');
    city_snap_shot
      .siblings('.country-image')
      .removeClass('active-city')
      .addClass('inactive-city');

    updateHistory('#/tab/3/value/' + city_list_data);
  });
  var tabCities = city_list
    .parents()
    .parents()
    .parents()
    .parents()
    .parents()
    .prev('ul')
    .find('.city-tab');
  var tabIndustries = city_list
    .parents()
    .parents()
    .parents()
    .parents()
    .parents()
    .prev('ul')
    .find('.industry-tab');

  tabCities.on('click', function () {
    var value = $(this).data('value');
    updateHistory('#/tab/3/value/' + value);
  });

  // tabIndustries.on('click', function () {
  //   var value = $(this).data('value');
  //   updateHistory('#/tab/4/value/' + value);
  // })

  country.each(function (index, item) {
    $(item).attr('data-cinfo', 'c-info-' + index);
  });
}

function snapShotImage() {
  var city_img = $('.country-image img'),
    container = $('.snap-shot-container'),
    _close = $('.snap-shot-container p'),
    _closewrap = $('.light-box-close-wrap'),
    snapShotWrap = $('.snap-shot-wrap');

  city_img.on('click', function () {
    $('html, body').animate({
        scrollTop: $('#section-1').offset().top
      },
      1,
      function () {
        container.addClass('snap-shot-fixed active');
        $('html').css('overflow', 'hidden');
      }
    );

    $('body').on('mousewheel touchmove', function (e) {
      e.preventDefault();
    });

    $('.social-button').addClass('hide');

    snapShotWrap.addClass('no-border');
  });

  _close.on('click', function () {
    container.removeClass('snap-shot-fixed active');
    $('html').css('overflow', 'auto');
    $('body').unbind();
    $('.social-button').removeClass('hide');
    snapShotWrap.removeClass('no-border');
  });

  _closewrap.on('click', function () {
    container.removeClass('snap-shot-fixed active');
    $('html').css('overflow', 'auto');
    $('body').unbind();
    $('.social-button').removeClass('hide');
    snapShotWrap.removeClass('no-border');
  });
}

// mobile globe
function mobileGlobeList() {
  var mobTrigger = $('.mobile-city-wrapper'),
    mobNav = $('#mob-city-nav'),
    activeCity = $('#mob_city'),
    cityListItem = $('.city-list-item');
  // var

  activeCity.text($('.active-city .country-name').text());

  activeCity.click(function () {
    console.log('clicked');
    mobNav.toggle();
    exploreDataNow();

    // temporary fix
    mobTrigger.toggleClass('remove-border-radius');
  });

  cityListItem.click(function () {
    mobNav.toggle();
    exploreDataNow();
    activeCity.text($('.active-city .country-name').text());
    // window.scrollTo(0, 1627);
    if (window.matchMedia('(max-width: 768px)').matches) {
      var offset = 0;
      offset = $('.active-city').offset().top;
      $('html, body').animate({
          scrollTop: offset
        },
        'slow'
      );
    }
  });
}

// dynamic href Explore data now
function exploreDataNow() {
  var cityDataLink = $('.active-city #cityDataLink').attr('href'),
    exploreDataNow = $('#exploreDataNow');

  exploreDataNow.attr('href', cityDataLink);
}

// disable scroll when snapshot is active
function disableScroll() {
  var snapContainer = $('.snap-shot-container');

  // if(snapContainer.hasClass('snap-shot-fixed')) {
  // if (window.addEventListener) { // older FF
  //   window.addEventListener('DOMMouseScroll', preventDefault, false);
  //   window.onwheel = preventDefault; // modern standard
  //   window.onmousewheel = document.onmousewheel = preventDefault; // older browsers, IE
  //   window.ontouchmove  = preventDefault; // mobile
  //   document.onkeydown  = preventDefaultForScrollKeys;
  // }
  //   console.log('test')
  // }
}

// globe clicks (home) -- l

// function globeLocationData () {
//   var city_list = $('.city-list-item')
//   var location = $('.location')
//   console.log(city_list.length)

//   location.each(function (index, item) {
//     $(item).attr('data-location', index)
//   })
// }

// function clickGlobeLocations () {
//   var location = $('.location')

//   location.click(function () {
//     var _this = $(this)
//     var location_data = _this.data('location')

//     var city_data = _this.parents().find("[data-cinfo='c-info-" + location_data + "']")

//     if (city_data.hasClass('inactive-city')) {
//       city_data.removeClass('inactive-city').addClass('active-city')
//     }

//     city_data.siblings('.country-info').removeClass('active-city').addClass('inactive-city')
//   })
// }
function infographicIframe() {
  $('#demo-iframe').load(function () {
    setTimeout(function () {
      var iframe = $('#demo-iframe').contents();
      var tabCities = iframe.find(
        '.tabbed-navs .tabbed-nav--cities .nav-group .js-route'
      );
      var tabIndustries = iframe.find(
        '.tabbed-navs .tabbed-nav--industries .nav-group .js-route'
      );
      var tabContainer = iframe.find(
        '.sk-tabs .js-tab-container-auto-init .tab-city.sk-tabs__nav .sk-tabs__nav-item '
      );
      var tabCityMap = iframe.find(
        '.sk-tabs__nav-item.sk-tabs__nav-item--city-map.js-tab-nav-item.js-track-tab-map'
      );
      var tabBarometer = iframe.find(
        '.sk-tabs__nav-item.sk-tabs__nav-item--ind.js-tab-nav-item.js-track-tab-industry'
      );
      var tabComparison = iframe.find(
        '.sk-tabs__nav-item.sk-tabs__nav-item--city.js-tab-nav-item.js-track-tab-city'
      );

      tabCityMap.on('click', function () {
        updateHistory('#/tab/0');
      });
      tabBarometer.on('click', function () {
        updateHistory('#/tab/1');
      });
      tabComparison.on('click', function () {
        updateHistory('#/tab/2');
      });
      tabCities.on('click', function () {
        var tab = $(this).data('tab');
        var value = $(this).data('value');
        updateHistory('#/tab/3/value/' + value);
      });

      tabIndustries.on('click', function () {
        var tab = $(this).data('tab');
        var value = $(this).data('value');
        updateHistory('#/tab/4/value/' + value);
      });
    }, 500);
  });
}

function updateHistory(params) {
  // console.log('document.location.hash',  document.location.hash);
  history.replaceState(null, '', window.location.pathname + params);
  // history.replaceState(null, '', params);
}

function setIframe() {
  var location = window.location;
  var baseUrl = infographic_url;
  var url = baseUrl;

  if (location.hash) {
    url = baseUrl + location.hash;
  } else if (location.search) {
    if (location.search === '?tab=industry-barometer') {
      url = baseUrl + '#/tab/1';
    } else if (location.search === '?tab=city-barometer') {
      url = baseUrl + '#/tab/2';
    } else {
      var city = location.search.substring(location.search.indexOf('=') + 1);
      console.log('city');
      url = baseUrl + '#/tab/3/value/' + city;
    }
  }

  $('#demo-iframe').attr('src', url);
  $('#demo-iframe').on('load', function(){
    $('#demo-iframe').attr('scrolling', 'auto');
  });
  // console.log('url', url);
  // console.log('iframe', $('#demo-iframe'));
}

function scrollInteractive() {
  // $(window).scroll(function() {
  //   var wScroll = $(this).scrollTop();
  //   console.log(wScroll);
  // });
  // 1677
}

function slideSubMenu() {
  var menuItems = $('#new-main-menu .menu-item-has-children > a:first-child');
  var subMenu = $('#new-main-menu .sub-menu');
  menuItems.unbind('click');
  menuItems.bind('click', function (e) {
    e.preventDefault();
    if ($(window).innerWidth() > 768) {
      console.log('clicked');
      $('.mega-menu li a')
        .next(subMenu)
        .slideToggle();
        $('.hero-image').toggleClass('menu-overflow')
        $
    } else {
      console.log('mobile clicked');
      menuItems.next(subMenu).slideUp();
      if (
        $(this)
        .next(subMenu)
        .is(':visible')
      ) {
        $(this)
          .next(subMenu)
          .slideUp();
      } else {
        $(this)
          .next(subMenu)
          .slideToggle();
      }
    }
  });
}

function slideSubMenuMobile() {
  var menuItems = $('#new-main-menu .menu-item-has-children > a:first-child');
  var subMenu = $('#new-main-menu .sub-menu');
  menuItems.unbind('click');
  menuItems.bind('click', function (e) {
    e.preventDefault();
    console.log('clicked mobile');
    menuItems.next(subMenu).slideUp();
    if (
      $(this)
      .next(subMenu)
      .is(':visible')
    ) {
      $(this)
        .next(subMenu)
        .slideUp();
    } else {
      $(this)
        .next(subMenu)
        .slideToggle();
    }
  });
}

function headerScroll(){
  console.log("header init")

  
  var difference = $(".sticky-scroller").height()
 
  $(window).scroll(function() {
    var distance = $(window).scrollTop();
    var h = $(".header")
    var w = $(window).outerWidth();
    if(distance  > difference) {
      
      h.addClass("enable-sticky");
      TweenMax.to(h, 0, {top:0})
      if(w < 767){
        $(".social-button").removeClass("social-button-hide")
      }
      
    }else {
      h.removeClass("enable-sticky");
      if(w < 767){
        $(".social-button").addClass("social-button-hide")
      }
      
    }
  })

}

function heroResize(){
  console.log("hero resize init")
  var isSmaller = false;
  var windowWd = $(window).outerWidth();

  if(windowWd < 767 ){
    isSmaller = true;
  }else {
    isSmaller =false;
  }

  var adjustment = $(".sticky-scroller").outerHeight() + $(".translucent-header").outerHeight();
  var headerHt = adjustment + $(".ad-banner-masthead").outerHeight();
  var headerHtMobile = $(".sticky-scroller").outerHeight() + $(".ad-banner-masthead").outerHeight();;
  
  
  
  if(isSmaller){
    $(".hero-content-container").css("margin-top", headerHtMobile  + 50);
    $("section").css("top",-headerHtMobile);
  }else {
    $(".hero-content-container").css("margin-top", headerHt);
    $("section").css("top",-adjustment);
  }
  
}

function interactiveToolClicker(){
  console.log("clicker init")
  $(".article-wrapper #xxx ").on("load",function(){
    $(this).contents().find(".site-nav-item a").on("click", function(e){
    
    e.preventDefault()
    if($(this).attr("href") != "#"){
      console.log("click")
      window.top.location.href =$(this).attr("href");
    }
    
    })
  })
}