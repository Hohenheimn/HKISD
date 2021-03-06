$.ecojs.runningSection = {
    defaults: {
        ecoNavItem: $('.eco-nav-item'),
        topicMenuItem: $('.nav-link-topic'),
        moreMenuItem: $('.nav-link-more'),
        loginMenuItem: $('.login-form-trigger'),
        topicSubmenu: $('.topic-submenu'),
        moreSubmenu: $('.more-submenu'),
        loginSubmenu: $('.login-submenu'),
        subMenuWrapper: $('.sub-menu-wrapper'),
        triangle: '.triangle',
        searchFormClose: $('.close-search-form'),
        searchFormOpen: $('.search-trigger'),
        primaryNav: $('.primary-nav-container'),
        searchForm: $('.search-form-wrapper'),
        mobileMenuTrigger: $('.mobile-hamburger'),
        mobileMenu: $('.mobile-menu'),
        closeMobileMenuTrigger: $('.mobile-menu-close'),
        mobileMenuItem: $('.mobile-menu-has-children')
    },
    init: function() {
        var self = this,
            el = self.defaults
        console.warn('Economist Menu');
        self.openEconomistSubMenu(el.subMenuWrapper, el.topicMenuItem, el.topicSubmenu, el.triangle, el.ecoNavItem)
        self.openEconomistSubMenu(el.subMenuWrapper, el.moreMenuItem, el.moreSubmenu, el.triangle, el.ecoNavItem)
        self.openEconomistSubMenu(el.subMenuWrapper, el.loginMenuItem, el.loginSubmenu, el.triangle, el.ecoNavItem)
        self.openSearchForm(el.searchFormOpen, el.searchForm, el.primaryNav)
        self.closeSearchForm(el.searchFormClose, el.searchForm, el.primaryNav)
        self.openMobileMenu(el.mobileMenuTrigger, el.closeMobileMenuTrigger, el.mobileMenu)
        self.openAccordion(el.mobileMenuItem)
        el.moreMenuItem.on('click', function(e) {
            e.preventDefault()
            console.log('wa')
        })
    },
    openEconomistSubMenu: function(subMenuWrapper, trigger, subMenu, indicator, navItemPosition) {
        trigger.click(function(e) {
            //console.log(trigger)
            e.preventDefault()
            if (!subMenu.hasClass('active-submenu')) {
                subMenuWrapper.removeClass('active-submenu')
                $(indicator).addClass('d-none')
                navItemPosition.removeClass('active-menu-item')
                trigger.addClass('active-menu-item')
                trigger.find(indicator).removeClass('d-none')
                subMenu.toggleClass('active-submenu')
            } else {
                trigger.removeClass('active-menu-item')
                trigger.find(indicator).addClass('d-none')
                subMenu.toggleClass('active-submenu')
            }
        })
    },
    openSearchForm: function(trigger, searhForm, nav) {
        trigger.click(function() {
            searhForm.addClass('d-flex')
            nav.addClass('d-none')
            nav.removeClass('d-flex')
        })
    },
    closeSearchForm: function(trigger, searhForm, nav) {
        trigger.click(function() {
            searhForm.removeClass('d-flex')
            nav.removeClass('d-none')
            nav.addClass('d-flex')
        })
    },
    openMobileMenu: function(openTrigger, closeTriger, menu) {
        openTrigger.click(function() {
            $(this).addClass('d-none')
            $(this).removeClass('d-block')
            menu.addClass('d-block')
            closeTriger.addClass('d-block')
        })
        closeTriger.click(function() {
            $(this).addClass('d-none')
            $(this).removeClass('d-block')
            menu.removeClass('d-block')
            openTrigger.addClass('d-block')
        })
    },
    openAccordion: function(trigger) {
        trigger.click(function() {
            var _self = $(this),
                list = _self.find('.mobile-accordion')
            if (list.hasClass('active-accordion')) {
                list.removeClass('active-accordion')
                _self.removeClass('menu-visible')
            } else {
                $('.mobile-menu-has-children ul').removeClass('active-accordion')
                _self.addClass('menu-visible')
                list.addClass('active-accordion')
            }
        })
    }
}