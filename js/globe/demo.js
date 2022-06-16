var examples = {}

examples['locations'] = function () {
  /* defining locations to display.
     Each position must have a key, an alpha and delta position (or x and y if you want to display a static location).
     Any additional key can be reached via callbacks functions.
  */
  getLocations().then(function (data) {
    $('#sphere').earth3d({
      locationsElement: $('#locations'),
      dragElement: $('#locations'), // where do we catch the mouse drag
      locations: data
    })
  })

  function getLocations () {
    var promise = new Promise(function (resolve, reject) {
      // do a thing, possibly async, then…
      $.ajax({
        method: 'post',
        url: 'http://dottylabs.com/work/economist/telstra/wp-content/themes/Telstra-child/data_globe.php',
        success: function (data) {
          // locations = JSON.parse(data);
          resolve(JSON.parse(data))
          // console.log(locations);
        },
        error: function (e) {
          reject(e)
        }
      })
    })
    return promise
  }
}

function selectExample (example) {
  $('#sphere').earth3d('destroy')
  $('#sphere').replaceWith($('<canvas id="sphere" width="400" height="400"></canvas>'))
  $('.location').remove()
  $('.flight').remove()
  $('#flights')[0].getContext('2d').clearRect(0, 0, 400, 400)

  $('#glow-shadows').removeClass('mars').addClass('earth')

  examples[example]()
}

$(document).ready(function () {
  selectExample('locations')
})
