(function (skTelstra, $, undefined) {
  'use strict'

  /**
   * Initialise stuff that needs doing on after a resize event
   *
   * @memberOf skTelstra
   * @namespace skTelstra.resizeTasks
   */
  skTelstra.resizeTasks = {
    resizeTimer: null,
    init: function () {
      // Stuff to
      $(window).on('resize', function () {
        clearTimeout(skTelstra.resizeTasks.resizeTimer)
        skTelstra.resizeTasks.resizeTimer = setTimeout(function () {
          skTelstra.tabs.resize()

          // mobile
          if ($('.sk-tabs__nav--mobile-label:visible').length) {
            $('.sk-tabs__nav-item:not(.sk-tabs__nav-item--hidden)').hide()
            $('.js-mask').hide()
          } else {
            $('.js-mobile-enabled').removeClass('js-mobile-enabled')
            $('.sk-tabs__nav-item:not(.sk-tabs__nav-item--hidden)').show()
          }
        }, 250)
      })
    }
  }
}(window.skTelstra = window.skTelstra || {}, jQuery))
