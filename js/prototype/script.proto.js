//=== MAIN JS INIT
$.ecojs = $.ecojs || {},
$.ecojs.init = function() {
    if (!this.initialized) {
        this.initialized = !0;
        $.ecojs.defaults.init();
        $.ecojs.extension.init();
        // JS For Sponsor
        // $.ecojs.yidan.init();
        //=================
    }
}
//=== /MAIN JS INIT

$.ecojs.defaults = {
    scrollCounter1 : 0,
    scrollCounter2 : 0,
    scrollCounter3 : 0,
    scrollCounter4 : 0,
    lastScrollPercent : 0,
    finishScrollGA : 0,
    gaDepth : 0,
    scrollRound: 0,
    init: function(e) {
        var _self = this;
        console.log('Economist default script running...')
        // if (!this.initialized) {
        //     this.initialized = !0;
        //     for (var e in this)
        //         this[e].hasOwnProperty("init") && this[e].init(this)
        // }
        _self.navigationMenu();
        _self.navControl();
        // _self.stickyHeader();
        // _self.checkScrollPercentage();
        // _self.addContents();
    },
    configInit: {
        siteName: function() {
            
        },
        logos: function() {
            
        },
        googleID: function () {
            
        }
    },
    stickyHeader: function(){
        var header = $('header');
        var lastScrollTop = 0;
        
        $(window).scroll(function(){
            if($('header').hasClass('is-open')){
                return false;
            }
            var yPos = $(this).scrollTop();

            if (yPos > lastScrollTop){
                if(yPos > header.outerHeight()) {
                    header.addClass('sticky');
                    header.removeClass('nav-visible');
                }
            } else {
                if(yPos > header.outerHeight()) {
                    header.addClass('sticky nav-visible');
                }
                if(yPos <= 0) {
                    header.removeClass('sticky nav-visible');
                }
            }
            
            lastScrollTop = yPos;
        });
    },
    navigationMenu: function() {
        var _self = this;
        var navItem = $('.nav-item'),
            btnBack = $('.back-to-top-btn'),
            hasSub = $('.has-sub');
            
            adBtn = $('#toggle-sponsored-text'),
            closeAdBtn = $('#close-sponsored-text');
            
            navItem.on('click', function(e){
                e.preventDefault();

                if(!_self.defaults.isScrollActive) return false;
                var _target = $(this).attr('target-section');
                var section = $('#section-'+_target);

                if($(this).parent().hasClass('has-sub')) {
                    $('.has-sub ul').hide().removeClass('show-sub');
                    $(this).siblings('ul').show().addClass('show-sub');
                } else {
                    if(section.length > 0) {
                        var indexer = 0;
                        $('.section').each(function(){
                            if($(this).is('#section-'+_target) == true){

                            }
                            indexer++;
                        ;})
                    }
                $('.nav-item').removeClass('active');
                $(this).addClass('active');
                // if($(window).width() < 1025) {
                    $('.has-sub ul').hide().removeClass('show-sub');
                    $('.header-navigation').fadeOut().removeClass('active');
                // }
                }
            });

            adBtn.on('click' , function(e){
                e.preventDefault();
                $('#sponsored-text-container').toggle();
            });
            
            closeAdBtn.on('click' , function(e){
                e.preventDefault();
                $('#sponsored-text-container').hide();
            });

        $('body').on('click', function(e){
            if(
                !$(e.target).closest('.hamburger,.header-navigation').length &&
                $('.header-navigation').hasClass('active')
                ) {
                $('.header-navigation').fadeOut().removeClass('active');
            }
        });

    },
    setActiveMenu: function(el) {
        var cls = $(el.item).attr('id').replace('section','');
        $('.nav-item').removeClass('active');
        $('.menu-item'+cls).addClass('active');
    },
    navControl: function() {
        var _defaults = this.defaults;
        var btnUp = $('.ctrl-up'),
            btnDown = $('.ctrl-down');
        btnUp.on('click', function() {
            $("html, body").animate({ scrollTop: 0 }, "slow");
        });
    },
    orientationChange: function(){
        
    },
    checkScrollPercentage: function() {
       
        var pageURL = stripTrailingSlash(window.location.pathname);
        var title = pageURL;
        
        if($('body').hasClass('home')) {
            title = "/";
        }
    
        function stripTrailingSlash(str) {
            if(str.substr(-1) === '/') {
                return str.substr(0, str.length - 1);
            }
            return str;
        }

        console.log("page url: ", title);
        $(window).scroll(function(e){
			var scrollTop = $(window).scrollTop();
			var docHeight = $(document).height();
			var winHeight = $(window).height();
			var scrollPercent = (scrollTop) / (docHeight - winHeight);
			var scrollPercentRounded = Math.round(scrollPercent*100);
            scrollDepth(scrollPercentRounded, title);
        });
    },
    addContents: function(){
        //console.log(config.content);
        $.each(config.content,function(index, value){
            $(value.target).html(value.message);
        });
    }
}




$.ecojs.extension = {
    init: function(){
        // console.log('Extends...');
        // $.ecojs.tracking.init();
        // $.ecojs.runningSection.init();
        // $.ecojs.social.init();
        //runningSection.onInit()
    },
    
}

$(document).ready(function(){
    $.ecojs.init();
});



function scrollDepth(scrollPercentRounded, page) {
    var app = $.ecojs.defaults;
    var curSection = page;
        //console.log(scrollPercentRounded+ "%");
        if (app.finishScrollGA == 0){
            if((scrollPercentRounded >= 25) && (scrollPercentRounded <= 49)){
            app.scrollRound = 25;
            if(app.lastScrollPercent != app.scrollRound){
            
                if(app.scrollCounter1 == 0){
                    app.gaDepth = 25;
                    app.lastScrollPercent = 25;
                    // console.log('Fire GA! '+ app.gaDepth + ' ' + curSection);
                    app.scrollCounter1 = 1;
                    console.log('Fire GA! '+app.gaDepth + ' Scroll Depth Bottom'+ ' ' + curSection);
                    ga('send', 'event', 'Scroll-Depth', '25%', curSection);

                }
            }
            //console.log(gaDepth);
            
        }
        else 
        if((scrollPercentRounded > 49) && (scrollPercentRounded <= 74)){
            app.scrollRound = 50;
            if(app.lastScrollPercent != app.scrollRound){
              if(app.scrollCounter2 == 0){
                app.gaDepth = 50;
                app.lastScrollPercent = 50;
                app.scrollCounter2 = 1;
                console.log('Fire GA! '+app.gaDepth + ' Scroll Depth Bottom'+ ' ' + curSection);
              ga('send', 'event', 'Scroll-Depth', '50%', curSection);
              // console.log('Fire GA! '+ app.gaDepth + ' ' + curSection);
              }
            }
            
          }
          else 
          if((scrollPercentRounded > 75) && (scrollPercentRounded <= 94)){
            app.scrollRound = 75;
            if(app.lastScrollPercent != app.scrollRound){
                if(app.scrollCounter3 == 0){
                    app.gaDepth = 75;
                    app.lastScrollPercent = 75;
                    app.scrollCounter3 =  1;
                    console.log('Fire GA! '+app.gaDepth + ' Scroll Depth Bottom'+ ' ' + curSection);
                    ga('send', 'event', 'Scroll-Depth', '75%', curSection);
                    // console.log('Fire GA! '+ app.gaDepth + ' ' + curSection);
                }
            }
            
        }
        else 
        if(scrollPercentRounded > 95){
                app.scrollRound = 100;
                if(app.lastScrollPercent != app.scrollRound){
                    if(app.scrollCounter4 == 0){
                    app.gaDepth = 100;
                    app.lastScrollPercent = 100;
                    app.scrollCounter4 =  1;

                        ga('send', 'event', 'Scroll-Depth', '100%', curSection);
                        console.log('Fire GA! '+app.gaDepth + ' Scroll Depth Bottom'+ ' ' + curSection);
                        app.finishScrollGA = 1;
                    }

                }
            
            }
        }
    }
  