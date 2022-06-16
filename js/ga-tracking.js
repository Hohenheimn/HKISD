(function() {
  // Element Tags
  // ga('send', 'event', 'article-gallery', 'click', 'select-background-01-01')
  // Home

  var _dev_ =
    window.location.host === 'connectedfuture.economist.com' ? false : true;

  var btnReadWhitePaper = $('.btn-readwhitepaper'),
    btnDownloadIndex = $('.digital-transformation-subcontainer .btn-readwhitepaper:last-child'),
    btnAboutCC = $('.btn-aboutcc'),
    cshNav = $('.csh-nav'),
    cshTitle = $('.csh-title'),
    cshImg1 = $('.csh-image1'),
    cshImg2 = $('.csh-image2'),
    cshButton = $('.csh-button'),
    tcarousel = $('.tcarousel-click'),
    iiNav = $('.ii-nav'),
    iiMiddlebutton = $('.ii-middlebutton'),
    iiViewCity = $('.ii-viewcitydata'),
    iiIndustryBaro = $('.ii-viewindustrybaro'),
    iiCityBaro = $('.ii-viewcitybaro'),
    cbriefSquare = $('.cbrief-square'),
    linksbottom = $('.footer-nav li a');
    
    btnDownloadIndex.attr('data-attr','clicked');

    btnReadWhitePaper.on('click', function() {
        console.log('false')
        if($(this).attr('data-attr') === 'clicked'){
          gaClick('send','event','Download','Report','Asian-Digital-Transformation-Index-2018.xlsm')
        }else{
          gaClick('send', 'event', 'Homepage', 'click', 'hero-button-readwhitepaper');
        }
        
    });



  

  // btnDownloadIndex.on('click', function() {
  //   console.log('clicking download')

  //   gaClick('send','event','Downloads/Print','Report','Asian-Digital-Transformation-Index-2018.xlsm');
  // });

  btnAboutCC.on('click', function() {
    gaClick('send', 'event', 'Homepage', 'click', 'hero-button-aboutcc');
  });

  cshNav.on('click', function() {
    var _title = $(this).attr('title');
    gaClick('send', 'event', 'Homepage', 'click', 'csh-nav-' + _title);
  });

  cshTitle.on('click', function() {
    var _title = $(this).attr('title');
    gaClick('send', 'event', 'Homepage', 'click', 'csh-title-' + _title);
    window.location = $(this)
      .siblings()
      .find('.csh-button')
      .attr('href');
  });

  cshImg1.on('click', function() {
    var _title = $(this).attr('title');
    gaClick('send', 'event', 'Homepage', 'click', 'csh-image1-' + _title);
    window.location = $(this)
      .parent()
      .parent()
      .next()
      .find('.csh-button')
      .attr('href');
  });

  cshImg2.on('click', function() {
    var _title = $(this).attr('title');
    gaClick('send', 'event', 'Homepage', 'click', 'csh-image2-' + _title);
    window.location = $(this)
      .parent()
      .parent()
      .next()
      .find('.csh-button')
      .attr('href');
  });

  cshButton.on('click', function() {
    var _title = $(this).attr('title');
    gaClick('send', 'event', 'Homepage', 'click', 'csh-button-' + _title);
  });

  tcarousel.on('click', function() {
    gaClick('send', 'event', 'Homepage', 'click', 'tcarousel-click');
  });

  iiNav.on('click', function() {
    var _city = $(this).html();
    gaClick('send', 'event', 'Homepage', 'click', 'ii-nav-' + _city);
  });

  iiMiddlebutton.on('click', function() {
    var _city = $('.country-info.active-city .country-name').html();
    gaClick('send', 'event', 'Homepage', 'click', 'ii-middlebutton-' + _city);
  });

  iiViewCity.on('click', function() {
    var _city = $('.country-info.active-city .country-name').html();
    gaClick('send', 'event', 'Homepage', 'click', 'ii-viewcitydata-' + _city);
  });

  iiIndustryBaro.on('click', function() {
    var _city = $('.country-info.active-city .country-name').html();
    gaClick(
      'send',
      'event',
      'Homepage',
      'click',
      'ii-viewindustrybaro-' + _city
    );
  });

  iiCityBaro.on('click', function() {
    var _city = $('.country-info.active-city .country-name').html();
    gaClick('send', 'event', 'Homepage', 'click', 'ii-viewcitybaro-' + _city);
  });

  cbriefSquare.on('click', function() {
    var _country = $(this).attr('country');
    gaClick('send', 'event', 'Homepage', 'click', 'cbrief-square-' + _country);
  });

  linksbottom.on('click', function() {
    gaClick('send', 'event', 'footer', 'click', 'client-linksbottom');
  });

  function gaClick(send, event, category, action, label) {
    if (!_dev_) {
      ga(send, event, category, action, label);
    } else {
      gaLog(send, event, category, action, label);
    }
  }

  function gaLog(send, event, category, action, label) {
    console.log('======================================');
    console.log('send: ' + send);
    console.log('event: ' + event);
    console.log('category: ' + category);
    console.log('action: ' + action);
    console.log('label: ' + label);
    console.log('======================================');
  }
})();
