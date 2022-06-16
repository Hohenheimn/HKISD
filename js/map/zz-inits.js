(function (skTelstra, $, undefined) {
  'use strict'

  /** Public variables **/

  skTelstra.timeouts = [] // All timeouts should be appended to this array, makes for easy clearing
  skTelstra.WEB_ROOT = ((document.location.protocol === 'https:') ? 'https://' : 'http://') + document.location.host + '/templates'
  skTelstra.lang = 'en'
  skTelstra.loading = false
}(window.skTelstra = window.skTelstra || {}, jQuery))

// Immediately hide all elements reserved for users with JS disabled
$('.no-js').hide()

$(function () {
  'use strict'

  skTelstra.dataService.init()
  skTelstra.cityBarometer.init()
  skTelstra.cityMap.init()
  skTelstra.industryBarometer.init()
  skTelstra.resizeTasks.init()
  skTelstra.detailViews.init()
  skTelstra.tabs.init()
  skTelstra.router.init()
})
