(function ($) {
    "use strict";

    /**
     * This will scroll the page when the alert box appears.
     */
    Drupal.behaviors.brand_change = {
        attach: function (context, settings) {
            let searchParams = new URLSearchParams(window.location.search);
            if (searchParams.has('brand')) {
                let brand = searchParams.get('brand').toString();
                let whiteListItems = [];

                let whiteList = settings.brand_referral;

                for (let i = 0; i < whiteList.length; i++) {
                    whiteListItems.push(whiteList[i].toString().replace(/[\r\n]+/gm, ""));
                }

                if (whiteListItems.includes(brand)) {
                    $('.site-name span').text(brand);
                    $('.yslogan a')
                      .text(brand)
                      .addClass(['fas','fa-chevron-left'])
                      .attr('href', 'https://' + brand);
                }
            }
        }
    };

})(jQuery);
