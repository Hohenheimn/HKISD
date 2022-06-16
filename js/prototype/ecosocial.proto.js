$.ecojs.social = {
    init: function(){
        var _self = this;
        console.log('Economist SNS Script Initialized');
        this.setSocialUrl();
    },
    setSocialUrl: function(item) {
        var socialItem = $('.social-menu .social-item');
        //var sectionTitle = $('.site-content').attr('section-title');
        //var sectionIndex = item;
        //console.log(sectionTitle);
    
        var protocol = window.location.protocol.replace(':','');
    
        var linkedinLink = 'https://www.linkedin.com/shareArticle?mini=true&url='+protocol+'%3A//'+config.siteUrl;
        var twitterLink = 'https://twitter.com/home?status='+protocol+'%3A//'+config.siteUrl;
        var fbLink = 'https://www.facebook.com/sharer/sharer.php?u='+protocol+'%3A//'+config.siteUrl;
        var fbLink = 'https://www.facebook.com/sharer/sharer.php?u='+protocol+'%3A//'+config.siteUrl;
        
        var gplusLink = 'https://plus.google.com/share?url='+protocol+'%3A//'+config.siteUrl;
        var emailLink = 'mailto:?&body='+protocol+'%3A//'+config.siteUrl;
    
        $('.social-linkedin').attr('href',linkedinLink);
        $('.social-twitter').attr('href',twitterLink);
        $('.social-facebook').attr('href',fbLink);
        $('.social-googleplus').attr('href',gplusLink);
        $('.social-mail').attr('href',emailLink);
    
        socialItem.each(function(index, value) {
            var _this = $(value);
            //_this.attr('section-title',sectionTitle);
        });
    
    }
}