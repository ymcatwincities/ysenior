;
/**
* jquery-match-height 0.7.2 by @liabru
* http://brm.io/jquery-match-height/
* License: MIT
*/

;(function(factory) { // eslint-disable-line no-extra-semi
    'use strict';
    if (typeof define === 'function' && define.amd) {
        // AMD
        define(['jquery'], factory);
    } else if (typeof module !== 'undefined' && module.exports) {
        // CommonJS
        module.exports = factory(require('jquery'));
    } else {
        // Global
        factory(jQuery);
    }
})(function($) {
    /*
    *  internal
    */

    var _previousResizeWidth = -1,
        _updateTimeout = -1;

    /*
    *  _parse
    *  value parse utility function
    */

    var _parse = function(value) {
        // parse value and convert NaN to 0
        return parseFloat(value) || 0;
    };

    /*
    *  _rows
    *  utility function returns array of jQuery selections representing each row
    *  (as displayed after float wrapping applied by browser)
    */

    var _rows = function(elements) {
        var tolerance = 1,
            $elements = $(elements),
            lastTop = null,
            rows = [];

        // group elements by their top position
        $elements.each(function(){
            var $that = $(this),
                top = $that.offset().top - _parse($that.css('margin-top')),
                lastRow = rows.length > 0 ? rows[rows.length - 1] : null;

            if (lastRow === null) {
                // first item on the row, so just push it
                rows.push($that);
            } else {
                // if the row top is the same, add to the row group
                if (Math.floor(Math.abs(lastTop - top)) <= tolerance) {
                    rows[rows.length - 1] = lastRow.add($that);
                } else {
                    // otherwise start a new row group
                    rows.push($that);
                }
            }

            // keep track of the last row top
            lastTop = top;
        });

        return rows;
    };

    /*
    *  _parseOptions
    *  handle plugin options
    */

    var _parseOptions = function(options) {
        var opts = {
            byRow: true,
            property: 'height',
            target: null,
            remove: false
        };

        if (typeof options === 'object') {
            return $.extend(opts, options);
        }

        if (typeof options === 'boolean') {
            opts.byRow = options;
        } else if (options === 'remove') {
            opts.remove = true;
        }

        return opts;
    };

    /*
    *  matchHeight
    *  plugin definition
    */

    var matchHeight = $.fn.matchHeight = function(options) {
        var opts = _parseOptions(options);

        // handle remove
        if (opts.remove) {
            var that = this;

            // remove fixed height from all selected elements
            this.css(opts.property, '');

            // remove selected elements from all groups
            $.each(matchHeight._groups, function(key, group) {
                group.elements = group.elements.not(that);
            });

            // TODO: cleanup empty groups

            return this;
        }

        if (this.length <= 1 && !opts.target) {
            return this;
        }

        // keep track of this group so we can re-apply later on load and resize events
        matchHeight._groups.push({
            elements: this,
            options: opts
        });

        // match each element's height to the tallest element in the selection
        matchHeight._apply(this, opts);

        return this;
    };

    /*
    *  plugin global options
    */

    matchHeight.version = '0.7.2';
    matchHeight._groups = [];
    matchHeight._throttle = 80;
    matchHeight._maintainScroll = false;
    matchHeight._beforeUpdate = null;
    matchHeight._afterUpdate = null;
    matchHeight._rows = _rows;
    matchHeight._parse = _parse;
    matchHeight._parseOptions = _parseOptions;

    /*
    *  matchHeight._apply
    *  apply matchHeight to given elements
    */

    matchHeight._apply = function(elements, options) {
        var opts = _parseOptions(options),
            $elements = $(elements),
            rows = [$elements];

        // take note of scroll position
        var scrollTop = $(window).scrollTop(),
            htmlHeight = $('html').outerHeight(true);

        // get hidden parents
        var $hiddenParents = $elements.parents().filter(':hidden');

        // cache the original inline style
        $hiddenParents.each(function() {
            var $that = $(this);
            $that.data('style-cache', $that.attr('style'));
        });

        // temporarily must force hidden parents visible
        $hiddenParents.css('display', 'block');

        // get rows if using byRow, otherwise assume one row
        if (opts.byRow && !opts.target) {

            // must first force an arbitrary equal height so floating elements break evenly
            $elements.each(function() {
                var $that = $(this),
                    display = $that.css('display');

                // temporarily force a usable display value
                if (display !== 'inline-block' && display !== 'flex' && display !== 'inline-flex') {
                    display = 'block';
                }

                // cache the original inline style
                $that.data('style-cache', $that.attr('style'));

                $that.css({
                    'display': display,
                    'padding-top': '0',
                    'padding-bottom': '0',
                    'margin-top': '0',
                    'margin-bottom': '0',
                    'border-top-width': '0',
                    'border-bottom-width': '0',
                    'height': '100px',
                    'overflow': 'hidden'
                });
            });

            // get the array of rows (based on element top position)
            rows = _rows($elements);

            // revert original inline styles
            $elements.each(function() {
                var $that = $(this);
                $that.attr('style', $that.data('style-cache') || '');
            });
        }

        $.each(rows, function(key, row) {
            var $row = $(row),
                targetHeight = 0;

            if (!opts.target) {
                // skip apply to rows with only one item
                if (opts.byRow && $row.length <= 1) {
                    $row.css(opts.property, '');
                    return;
                }

                // iterate the row and find the max height
                $row.each(function(){
                    var $that = $(this),
                        style = $that.attr('style'),
                        display = $that.css('display');

                    // temporarily force a usable display value
                    if (display !== 'inline-block' && display !== 'flex' && display !== 'inline-flex') {
                        display = 'block';
                    }

                    // ensure we get the correct actual height (and not a previously set height value)
                    var css = { 'display': display };
                    css[opts.property] = '';
                    $that.css(css);

                    // find the max height (including padding, but not margin)
                    if ($that.outerHeight(false) > targetHeight) {
                        targetHeight = $that.outerHeight(false);
                    }

                    // revert styles
                    if (style) {
                        $that.attr('style', style);
                    } else {
                        $that.css('display', '');
                    }
                });
            } else {
                // if target set, use the height of the target element
                targetHeight = opts.target.outerHeight(false);
            }

            // iterate the row and apply the height to all elements
            $row.each(function(){
                var $that = $(this),
                    verticalPadding = 0;

                // don't apply to a target
                if (opts.target && $that.is(opts.target)) {
                    return;
                }

                // handle padding and border correctly (required when not using border-box)
                if ($that.css('box-sizing') !== 'border-box') {
                    verticalPadding += _parse($that.css('border-top-width')) + _parse($that.css('border-bottom-width'));
                    verticalPadding += _parse($that.css('padding-top')) + _parse($that.css('padding-bottom'));
                }

                // set the height (accounting for padding and border)
                $that.css(opts.property, (targetHeight - verticalPadding) + 'px');
            });
        });

        // revert hidden parents
        $hiddenParents.each(function() {
            var $that = $(this);
            $that.attr('style', $that.data('style-cache') || null);
        });

        // restore scroll position if enabled
        if (matchHeight._maintainScroll) {
            $(window).scrollTop((scrollTop / htmlHeight) * $('html').outerHeight(true));
        }

        return this;
    };

    /*
    *  matchHeight._applyDataApi
    *  applies matchHeight to all elements with a data-match-height attribute
    */

    matchHeight._applyDataApi = function() {
        var groups = {};

        // generate groups by their groupId set by elements using data-match-height
        $('[data-match-height], [data-mh]').each(function() {
            var $this = $(this),
                groupId = $this.attr('data-mh') || $this.attr('data-match-height');

            if (groupId in groups) {
                groups[groupId] = groups[groupId].add($this);
            } else {
                groups[groupId] = $this;
            }
        });

        // apply matchHeight to each group
        $.each(groups, function() {
            this.matchHeight(true);
        });
    };

    /*
    *  matchHeight._update
    *  updates matchHeight on all current groups with their correct options
    */

    var _update = function(event) {
        if (matchHeight._beforeUpdate) {
            matchHeight._beforeUpdate(event, matchHeight._groups);
        }

        $.each(matchHeight._groups, function() {
            matchHeight._apply(this.elements, this.options);
        });

        if (matchHeight._afterUpdate) {
            matchHeight._afterUpdate(event, matchHeight._groups);
        }
    };

    matchHeight._update = function(throttle, event) {
        // prevent update if fired from a resize event
        // where the viewport width hasn't actually changed
        // fixes an event looping bug in IE8
        if (event && event.type === 'resize') {
            var windowWidth = $(window).width();
            if (windowWidth === _previousResizeWidth) {
                return;
            }
            _previousResizeWidth = windowWidth;
        }

        // throttle updates
        if (!throttle) {
            _update(event);
        } else if (_updateTimeout === -1) {
            _updateTimeout = setTimeout(function() {
                _update(event);
                _updateTimeout = -1;
            }, matchHeight._throttle);
        }
    };

    /*
    *  bind events
    */

    // apply on DOM ready event
    $(matchHeight._applyDataApi);

    // use on or bind where supported
    var on = $.fn.on ? 'on' : 'bind';

    // update heights on load and resize events
    $(window)[on]('load', function(event) {
        matchHeight._update(false, event);
    });

    // throttled update heights on resize events
    $(window)[on]('resize orientationchange', function(event) {
        matchHeight._update(true, event);
    });

});
;
/**
 * @file
 * Open Rose JS.
 */

(function ($) {
  "use strict";
  Drupal.openy_rose = Drupal.openy_rose || {};
  Drupal.behaviors.openy_rose_theme = {
    attach: function (context, settings) {
      $('.ui-tabs').tabs({
        active: false,
        collapsible: true
      });
    }
  };

  // Sidebar collapsible.
  Drupal.behaviors.sidebar = {
    attach: function (context, settings) {
      var current_scroll = 0;
      $('.sidebar')
        .once()
        .on('show.bs.collapse',
          // Add custom class for expand specific styling. in = open.
          function (e) {
            $(this)
              .next('.viewport')
              .addBack()
              .removeClass('out')
              .addClass('collapsing-in')
              .removeAttr('aria-hidden');

            current_scroll = $(window).scrollTop();
            $('.nav-global').css({
              top: current_scroll
            });
          }
        )
        .on('shown.bs.collapse',
          // Allow css to control open rest state.
          function () {
            $(this)
              .next('.viewport')
              .addBack()
              .removeClass('collapsing-in')
              .addClass('in')
              .removeAttr('aria-hidden');

            var body = $('body');

            body.addClass('sidebar-in');

            $('html').addClass('sidebar-in');
          }
        )
        .on('hide.bs.collapse',
          // Add custom class for collapse specific styling. out = closed.
          function (e) {
            var sidebar = $(this);
            sidebar
              .next('.viewport')
              .addBack()
              .removeClass('in')
              .addClass('collapsing-out')
              .attr('aria-hidden', 'true');


            $(window).scrollTop(current_scroll);

            $('#page-head').css({
              marginTop: ''
            });

          }
        )
        .on('hidden.bs.collapse',
          // Allow css to control closed rest state.
          function () {
            $(this)
              .next('.viewport')
              .addBack()
              .addClass('out')
              .removeClass('collapsing-out');

            $('body').removeClass('sidebar-in');
            $('html').removeClass('sidebar-in');

            $('.nav-global').css({
              top: 0
            });
          }
        )
        .find('li')
        .on('hide.bs.dropdown',
          // For nested dropdowns, prevent collapse of other dropdowns.
          function (e) {
            e.preventDefault();
          }
        );
    }
  };

  // Sidebar collapsible menu items.
  Drupal.behaviors.sidebarMenuCollapsible = {
    attach: function (context, settings) {
      $('.sidebar .dropdown-toggle').on('click', function () {
        var expanded = $(this).attr('aria-expanded');
        if (expanded == 'true') {
          $(this).removeAttr('aria-expanded');
          $(this).parent().removeClass('open');
          return false;
        }
      });
    }
  };

  // Horizontal scroll for camp menu.
  Drupal.behaviors.scrollableList = {
    attach: function (context, settings) {
      $('.camp-menu-wrapper', context).once().each(function () {
        var $this = $(this),
            $list = $this.find('ul'),
            $items = $list.find('li'),
            listWidth = 0,
            listPadding = 40;

        setTimeout(function () {
          $items.each(function () {
            listWidth += $(this).outerWidth();
          });

          $list.css('width', listWidth + listPadding + "px");

          var columns = $this.find('.wrapper');
          if (columns.length == 0) {
            return;
          }
          var scroll = new IScroll(columns[0], {
            scrollX: true,
            scrollY: false,
            momentum: false,
            snap: false,
            bounce: true,
            touch: true,
            eventPassthrough: true
          });

          // GRADIENT BEHAVIOUR SCRIPT.
          var obj = $('.camp-menu');
          var objWrap = columns.append('<div class="columns-gradient gradient-right" onclick="void(0)"></div>');
          objWrap = document.querySelector('.columns-gradient');
          var sliderLength = listWidth - objWrap.offsetWidth + 40;
          var firstGap = 20;

          if (window.innerWidth > 768) {
            sliderLength = listWidth - objWrap.offsetWidth + 150;
            firstGap = 60;
          }

          obj.get(0).addEventListener('touchmove', function () {
            var transformMatrix = obj.css("-webkit-transform") ||
                obj.css("-moz-transform")    ||
                obj.css("-ms-transform")     ||
                obj.css("-o-transform")      ||
                obj.css("transform");
            var matrix = transformMatrix.replace(/[^0-9\-.,]/g, '').split(',');
            var x = matrix[12] || matrix[4];
            var y = matrix[13] || matrix[5];
            console.log(x, y);
            if (x <= -sliderLength + listPadding) {
              objWrap.classList.remove('gradient-right');
            }
            else {
              objWrap.classList.add('gradient-right');
            }

            if (x >= -firstGap) {
              objWrap.classList.remove('gradient-left');
            }
            else {
              objWrap.classList.add('gradient-left');
            }
          });
        }, 100);
      });
    }
  };

  // Adjust labels for hamburger menu icon.
  Drupal.behaviors.menuIconLabelChange = {
    attach: function (context, settings) {
      $('.navbar-toggle').on('click', function () {
        if ($(this).attr('aria-expanded') == 'false') {
          $(this).children('.sr-only').text(Drupal.t('Close main navigation'));
        } else {
          $(this).children('.sr-only').text(Drupal.t('Navigation menu'));
        }
      });
    }
  };

  /**
   * Adjust the top nav position when the skip link is in focus.
   */
  Drupal.behaviors.adjustSkipLink = {
    attach: function (context, settings) {
      // On focus, move the top nav down to show the skip link.
      $('.skip-link').on('focus', function () {
        var link_height = $(this).height();
        $('.top-navs').css({'margin-top': link_height});
      });
      // When focus is lost, remove the unneeded height.
      $('.skip-link').on('focusout', function () {
        $('.top-navs').css({'margin-top': '0'});
      });
    }
  };

  /**
   * Add focus for first loaded element.
   */
  Drupal.behaviors.load_more_focus = {
    attach: function (context, settings) {
      $('.views-element-container .load_more_button .button', context).click(function () {
        var $viewsRow = $('.views-element-container .views-row'),
          indexLastRow = $viewsRow.length,
          getElement,
          itemFocus;
        if (Drupal.views !== undefined) {
          $.each(Drupal.views.instances, function (i, view) {
            if (view.settings.view_name.length != 0) {
              $(document).ajaxComplete(function (event, xhr, settings) {
                getElement = $('.views-element-container .views-row');
                itemFocus = getElement[indexLastRow];
                // Add focus to element.
                $(itemFocus).find('h3 a').focus();
                // Update number indexLastRow.
                $viewsRow = $('.views-element-container .views-row');
                indexLastRow = $viewsRow.length;
              });
            }
          });
        }
      });
    }
  };

  // Location collapsible.
  Drupal.behaviors.schedules_location_collapse = {
    attach: function (context, settings) {
      $('label[for="form-group-location"]').on('click', function () {
        let status = $(this).attr('aria-expanded');
        if (status === 'false') {
          $(this).attr('aria-expanded', 'true');
        }
        else {
          $(this).attr('aria-expanded', 'false');
        }
      });
    }
  };

})(jQuery);
;
/**
 * @file
 * openy_ckeditor.js
 *
 * CKEditor Javascript routines.
 */

(function ($) {
  "use strict";

  /**
   * Fill ckeditor table cell padding with value for cellpadding.
   */
  Drupal.behaviors.ckeditorTablePadding = {
    attach: function (context, settings) {
      $("table", context).each(function () {
        var padding = $(this).attr("cellpadding");
        if (padding !== 0) {
          $(this).find("td").css("padding", padding);
        }
      });
    }
  };

})(jQuery);
;
(function ($) {
  "use strict";
  Drupal.openy_tour = Drupal.openy_tour || {};

  $(document).ajaxSuccess(function() {
    var queryString = decodeURI(window.location.search);
    if (/tour=?/i.test(queryString) || window.location.hash == '#tour=1') {
      var processed = true;
      $('.joyride-tip-guide').each(function() {
        if ($(this).css('display') == 'block' && processed) {
          $(this).find('.joyride-next-tip').trigger('click');
          processed = false;
        }
      });
    }
  });

  Drupal.behaviors.openy_tour = {
    attach: function (context, settings) {
      $('body').on('tourStart', function () {
        window.location.hash = 'tour=1';
        Drupal.openy_tour.click_button();
      });
      $('body').on('tourStop', function () {
        window.location.hash = '';
      });
      Drupal.openy_tour.focus_on_button();
    }
  };

  Drupal.openy_tour.click_button = function () {
    $('.joyride-tip-guide').each(function() {
      // Hide original next button if custom is appear.
      if ($(this).find('.openy-click-button').length > 0) {
        $(this).find('.joyride-next-tip').hide();
      }
    });
    $('.openy-click-button').on('click', function (e) {
      e.preventDefault();
      var selector = $(this).data('tour-selector'),
          element = {};
      // Click on link if class/id is provided.
      if ($(selector).length > 0) {
        element = $(selector);
      }
      // Click on input if data selector is provided.
      if ($('[data-drupal-selector="' + selector + '"]').length > 0) {
        element = $('[data-drupal-selector="' + selector + '"]');
        element.parents('details').attr('open', true);
        element.trigger('mousedown');
      }
      else {
        element.parents('details').attr('open', true);
        element.trigger('click');
        $(this)
          .hide()
          .parent()
          .parent()
          .find('.joyride-next-tip')
          .trigger('click');
      }
    });
  };

  Drupal.openy_tour.focus_on_button = function () {
    $(document).click(function(e) {
      if ($('.joyride-next-tip').on('clicked')) {
        if (this.activeElement.classList.contains('joyride-next-tip')) {
          let parentEl = this.activeElement.parentElement.parentElement.classList;
          let activeTip = parentEl[parentEl.length - 1];
          let precessedEl = '';
          if (!$('#tour li.' +  activeTip).next().data('class')) {
            precessedEl = $('#tour li.' +  activeTip).next().data('id');
          }
          else {
            precessedEl = $('#tour li.' +  activeTip).next().data('class');
          }
          if ($('#' + precessedEl).length > 0) {
            $('#' + precessedEl ).attr('open', true);
            $('#' + precessedEl + ' summary').mousedown();
          }
        }
        $('.openy-click-button:visible').focus();
      }
    });
  };

})(jQuery);
;
/**
 * @file openy_gtranslate.js
 */
(function ($, Drupal, drupalSettings) {
  Drupal.googleTranslateElementInit = function() {
    var elem = $('.openy-google-translate:visible').get(0);
    if (elem === undefined) {
      console.log('Placeholder for google translate widget not found.');
    }
    else {
      new google.translate.TranslateElement(
        {
          pageLanguage: drupalSettings.path.currentLanguage,
          layout: google.translate.TranslateElement.InlineLayout.VERTICAL,
        },
        elem
      );
    }
  };
}(jQuery, Drupal, drupalSettings));
;
