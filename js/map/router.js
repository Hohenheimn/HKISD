// jscs:disable validateQuoteMarks, requireCamelCaseOrUpperCaseIdentifiers

(function (skTelstra) {
  'use strict'

  skTelstra.router = {
    init: function () {
      $(document).on('click', '.js-route', function () {
        var tab = $(this).data('tab')
        var value = $(this).data('value')
        skTelstra.routerAction(tab, value)
        return false
      })

      if (window.location.hash) {
        var path = window.location.hash
        var pathParts = path.split('/')
        skTelstra.routerAction(pathParts[2], pathParts[4])
        // Fragment exists
      }
    }
  }

  /**
   * Trigger routing
   */
  skTelstra.routerAction = function (tab, value) {
    skTelstra.setTab(tab)
    // tab logic
    if (tab == 2 && value) {
      $('.js-city-one-select').val(value)
      skTelstra.dropdownChanged()
    }
    if (tab == 3) {
      skTelstra.detailViewloadCity(value)
    }
    if (tab == 4) {
      skTelstra.detailViewloadIndustry(value)
    }
  }

  skTelstra.buildSocialPaths = function (tab, value) {
    // TODO
  }
}(window.skTelstra = window.skTelstra || {}, jQuery))
// jscs:enable validateQuoteMarks
