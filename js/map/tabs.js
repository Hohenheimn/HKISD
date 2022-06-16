(function (skTelstra, $, undefined) {
  'use strict'

  /**
   * Create a new tab setup. There need to be precisely the same amount of content items and tab buttons, or the function will exit.
   * Returns a new Tab instance, which has the methods detailed below.
   *
   * @param {Element} tabContainer - The parent container which must contains the following children:<br>
   * `.js-tab-content-items-container` - Parent that contains all content items<br>
   * `.js-tab-list-toggle` - Toggle for mobile layout<br>
   * `.js-tab-item` - Applied to each nav item; must have a corresponding<br>
   * `.js-tab-content-item` - Tab content item<br>
   *
   * @memberOf skTelstra
   * @namespace skTelstra.Tab
   * @returns {Object}
   * @constructor
   */
  skTelstra.Tab = function (tabContainer) {
    var currentTabIndex = null
    var tab
    var tabContentContainer = tabContainer.querySelector('.js-tab-content-items-container')
    var tabContentItems = tabContentContainer.querySelectorAll('.js-tab-content-item')
    var tabNavItems = tabContainer.querySelectorAll('.js-tab-nav-item')

    function getTabHeight () {
      return tabContentItems[currentTabIndex].scrollHeight.toString() + 'px'
    }

    /**
     * Set a tab using an integer representing its index in its `tabContainer` element
     *
     * @function
     * @name skTelstra.Tab.setTab
     */
    skTelstra.setTab = function (index) {
      if (currentTabIndex !== parseInt(index)) {
        if (currentTabIndex !== null) {
          tabNavItems[currentTabIndex].classList.remove('js-active')
          tabContentItems[currentTabIndex].classList.remove('js-active')
        }
        currentTabIndex = index
        tabNavItems[currentTabIndex].classList.add('js-active')
        tabContentItems[currentTabIndex].classList.add('js-active')
        tabContentContainer.style.height = getTabHeight()

        $('.sk-tabs').removeClass('tab-map').removeClass('tab-industry').removeClass('tab-city')

        if (currentTabIndex === 0) {
          $('.sk-tabs').addClass('tab-map')
        }
        if (currentTabIndex === 1) {
          $('.sk-tabs').addClass('tab-industry')
        }
        if (currentTabIndex > 1) {
          $('.sk-tabs').addClass('tab-city')
        }
        if (currentTabIndex === 4) {
          $('.sk-tabs').addClass('tab-industry')
        }
      }
    }

    function tabNavClicked () {
      for (var i = 0; i < tabNavItems.length; i++) {
        /* jshint validthis: true */
        if (tabNavItems[i] === this) {
          skTelstra.setTab(i)
        }
      }
    }

    /**
     * Resize the height of the tab element; designed to be called by the overall skTelstra.tabs.resize function
     *
     * @function
     * @name skTelstra.Tab.resize
     */
    skTelstra.resize = function () {
      tabContentContainer.style.height = getTabHeight()
    }

    if (tabNavItems.length === tabContentItems.length) {
      for (var j = 0; j < tabNavItems.length; j++) {
        tabNavItems[j].addEventListener('click', tabNavClicked)
      }

      if (skTelstraGoToTab) {
        skTelstra.setTab(skTelstraGoToTab)
      } else {
        skTelstra.setTab(0)
      }

      tab = {
        resize: skTelstra.resize,
        setTab: skTelstra.setTab
      }

      skTelstra.tabs.intialisedTabs.push(tab)
      return tab
    }
  }

  skTelstra.showHideMobileNav = function (string) {
    if (string) {
      $('.sk-tabs__nav--mobile-label span').text(string)
    }
    $('.sk-tabs__nav').addClass('js-mobile-enabled')
    $('.sk-tabs__nav-item:not(.sk-tabs__nav-item--hidden)').slideToggle()
    $('.js-mask').toggle()
    $('.sk-tabs__nav--mobile-label').toggleClass('open')
  }

  /**
   *
   * @memberOf skTelstra
   * @namespace skTelstra.tabs
   */
  skTelstra.tabs = {
    /**
     * Automatically setup any tabs which have a class of `js-tab-container-auto-init`
     *
     * @memberOf skTelstra.tabs
     */
    init: function () {
      var tabsSectionsToAutoInit = document.querySelectorAll('.js-tab-container-auto-init')
      for (var i = 0; i < tabsSectionsToAutoInit.length; i++) {
        new skTelstra.Tab(tabsSectionsToAutoInit[i]) // jshint ignore:line
      }

      // Run the resize event now to pick up any tabbed sections that are children of others
      skTelstra.tabs.resize()

      $('.sk-tabs__nav--mobile-label, .js-mask').on('click', function () {
        skTelstra.showHideMobileNav(false)
      })

      $(document).on('click', '.js-mobile-enabled .sk-tabs__nav-item:not(.sk-tabs__nav-item--hidden)', function () {
        var text = $(this).text()
        skTelstra.showHideMobileNav(text)
      })
    },
    /**
     * The array to which all the initialised tabs will be appended
     */
    intialisedTabs: [],
    /**
     * Resize all the tab sections, for example after a resize event. Should be called by skTelstra.resizeTasks, but making public in case content is added etc
     */
    resize: function () {
      for (var i = 0; i < skTelstra.tabs.intialisedTabs.length; i++) {
        skTelstra.tabs.intialisedTabs[i].resize()
      }
    }
  }
}(window.skTelstra = window.skTelstra || {}, jQuery))
