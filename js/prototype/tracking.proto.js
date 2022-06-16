$.ecojs.tracking = {
    gaTracker : $('.js-tracking'),
    gaCustomTracker : $('.js-tracking-custom'),
    gaNavTracker : $('.js-ctrl-tracking'),
    gaSocialTracker : $('.js-social-tracking'),
    gaSponsorTracker : $('.sponsor-logo'),
    init: function(){
        console.log('tracking js')
        var _self = this;
        console.log('Tracker Initialized');
        // _self.pageOnLoad();
        _self.gaTracker.on('click', function() {
            var _this = $(this),
            _key = _this.attr('tracking').replace(/-/g,''),
            _sectionTitle = _this.attr('section-title'); 
            
            if(config.tracking[_key]) {
                var _data = config.tracking[_key];
                var _value = _sectionTitle ? _data.value + '-' + _sectionTitle : _data.value;
                
                $.ecojs.tracking.send(_data.event, _data.category, _data.label, _value);
            }
        });
        _self.gaCustomTracker.on('click', function(){
            var _this = $(this),
            _key = _this.attr('tracking').replace(/-/g,'');
            if(config.trackingCustom[_key]) {
                var _data = config.trackingCustom[_key];
                $.ecojs.tracking.send(_data.event, _data.category, _data.label, _data.value);
            }
        });
        _self.gaSocialTracker.on('click', function(){
            var _this = $(this);
            _key = _this.attr('tracking').replace(/-/g,'');
            //console.log(_key)
            var _data = config.tracking[_key];
            var socCat = _data.category.toLowerCase()
            $.ecojs.tracking.send(_data.event, _data.category, _data.label, _this.attr('tracking'));
        });

        _self.gaSponsorTracker.on('click', function(){
            var _this = $(this),
                _key = _this.attr('tracking').replace(/-/g,''),
                
                _sectionTitle = _this.attr('section-title'); 
                //console.log(_key);
                if(config.tracking[_key]) {
                    var _data = config.tracking[_key];
                    var _value = _sectionTitle ? _data.value + '-' + _sectionTitle : _data.value;
                
                    $.ecojs.tracking.send(_data.event, _data.category, _data.label, _value);
                }
        });
    },
    insertGATracking: function(params) {
        if (config.analytics.ga.enable) {
            var ga = "";
            ga += "<script>";
            ga += "(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){";
            ga += "(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),";
            ga += "m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)";
            ga += "})(window,document,'script','//www.google-analytics.com/analytics.js','ga');";
            ga += "ga('create', '" + config.analytics.ga.id + "', 'auto');";
            if (config.env === 'live') {
                ga += "ga('send', 'pageview');";
            }
            ga += "</script>";
            $('body').append(ga);
        }
    },
    changeSection: function(key, firstload, type) {
    
        if(type){
        //console.log('Type Tracker');
        
        var _data = config.trackingScroll.open;
        var _section = $('section.active');
        var _sectionValue = _section.attr('section-title');
        
        if(config.env === 'dev') {
            if(type != 'Infographic'){
    
                if(_section.hasClass('expanded') == true){
                    tracking.log(_data.event, _data.category, type, _sectionValue);
                }
                else{
                    tracking.log(_data.event, _data.category, type, _sectionValue );
                }
            }else{
            tracking.log(_data.event, _data.category, type, _sectionValue );
            }
        } else {
            if(type != 'Infographic'){
                if(_section.hasClass('expanded') == true){
                    tracking.send(_data.event, _data.category, type, _sectionValue );
                }else{
                    tracking.send(_data.event, _data.category, type, _sectionValue );
                }
            }
            else{
                tracking.send(_data.event, _data.category, type, _sectionValue );
            }
            
            
            }
        }
    },
    pageOnLoad: function() {
        setTimeout(function(){
            var _data = config.trackFifteenCustom;
            if(config.env === 'dev') {
                $.ecojs.tracking.log(_data.event, _data.category, _data.label, _data.value);
            } else {
                console.log('15 sec')
                $.ecojs.tracking.send(_data.event, _data.category, _data.label, _data.value);
            }
        }, 15000);
    },
    send: function(event, category, label, value) {
        var _self = this;
        var env = config.env
        console.log(config.env);
        
        if(config.env === 'dev') {
            $.ecojs.tracking.log(event, category, label, value, env);
        } else {
            ga('send', event, category, label, value);
            $.ecojs.tracking.log(event, category, label, value, env);
            // GAHelper.send('event', 'social-media-shares', 'click', 'social-media-shares-twitter');
        }
    },
    log: function(event, category, label, value, env ) {
        console.log('--------');
        console.log('TRACKING');
        console.log('Environment ' + env);
        console.log('Event: ' + event);
        console.log('Category: ' + category);
        console.log('Label: ' + label);
        console.log('Value: ' + value);
        console.log('--------');
    }
}