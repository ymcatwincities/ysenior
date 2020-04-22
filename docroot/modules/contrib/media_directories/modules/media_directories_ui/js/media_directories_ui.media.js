(function ($, Drupal) {
  /**
   * Media item functionality.
   *
   * @type {{init: Drupal.MediaBrowser.media.init, ctrlPressed: boolean}}
   */
  Drupal.MediaBrowser.media = {

    /**
     * Holds Control key state.
     */
    ctrlPressed: false,

    /**
     * Bind events to media items.
     */
    init: function init() {
      var $browser_listing = $('.browser--listing');
      var cardinality = Drupal.MediaBrowser.cardinality;
      var remaining = Drupal.MediaBrowser.remainingItems;

      // Attach listener to the top document and current document to
      // register keypress inside iframe without focusing iframe first.
      $(top.document).once('media-browser').each(function () {
        $(this).on('keydown', function (e) {
          if (e.which === 17) {
            Drupal.MediaBrowser.media.ctrlPressed = true;
          }
        }).on('keyup', function () {
          Drupal.MediaBrowser.media.ctrlPressed = false;
        });
      });

      $(document).once('media-browser').each(function () {
        $(this).on('keydown', function (e) {
          if (e.which === 17) {
            Drupal.MediaBrowser.media.ctrlPressed = true;
          }
        }).on('keyup', function () {
          Drupal.MediaBrowser.media.ctrlPressed = false;
        });
      });

      // Media item click actions.
      var $items = $browser_listing.find('.media-item');
      if ($items.length == 0 && Drupal.MediaBrowser.searchString !== '') {
        $('.view-empty').once().append('<a id="media-browser-clear-search-string">' + Drupal.t('Clear filter') + '</a>');
        $('#media-browser-clear-search-string').on('click', function () {
          Drupal.MediaBrowser.toolbar.filterMediaBrowserByName('');
        });
      }
      $items.once().each(function () {
        $(this).on('click', function () {
          var media_id = $(this).data('mid');
          var selected_items = Drupal.MediaBrowser.selectedMedia.length;
          var selection_limit = cardinality !== -1 && remaining > 1 && selected_items >= remaining;

          // Check if item which was clicked is in selection already.
          var selected_toggle = Drupal.MediaBrowser.selectedMedia.indexOf(media_id) !== -1;

          // Do not allow selecting more items if maximum has been selected.
          // We skip this if only one item can be selected
          // or control is not pressed and we are not toggling existing item.
          if (selection_limit && Drupal.MediaBrowser.media.ctrlPressed && !selected_toggle) {
            return;
          }

          // Clear current selection, if Control key is not pressed or
          // only one item is available to choose.
          if (!Drupal.MediaBrowser.media.ctrlPressed || remaining === 1) {
            $browser_listing.find('.media-item').each(function () {
              $(this).removeClass('selected');
              $('input[type="checkbox"]', this).prop('checked', false);
            });

            // Clear selection from global storage.
            Drupal.MediaBrowser.clearMediaSelection(false);
          }

          // If user can choose only one item and it is already selected,
          // we need to exit here to unselect single item.
          if (selected_toggle && remaining === 1) {
            return;
          }

          var $checkbox = $(this).find('input[type="checkbox"]');

          // Remove element from selection if we toggle it.
          if ($checkbox.prop('checked')) {
            Drupal.MediaBrowser.selectedMedia.splice(Drupal.MediaBrowser.selectedMedia.indexOf(media_id), 1);
          } else {
            // Push media id to selection array.
            Drupal.MediaBrowser.selectedMedia.push($(this).data('mid'));
          }

          // Toggle media element checkbox state.
          $checkbox.prop("checked", !$checkbox.prop("checked"));
          $(this).toggleClass('selected');

          // Notify toolbar items.
          Drupal.MediaBrowser.toolbar.selectionChanged();
        });

        // Drag and Drop functionality.
        $(this).draggable({
          revert: true,
          helper: 'clone',
          start: function start(e) {
            var nodes = [];
            $.each(Drupal.MediaBrowser.getSelectedMids(), function (key, value) {
              var $element = Drupal.MediaBrowser.getMediaElement(value);

              if ($element.length == 0) {
                $element = $('<div>' + Drupal.t('Placeholder') + '</div>');
              }

              nodes.push({
                id: value,
                element: $element
              });
            });

            // If nothing is selected, then just use active item.
            if (nodes.length === 0) {
              nodes.push({
                id: this.dataset.mid,
                element: $(this)
              });
            }

            var $html = $('<div id="jstree-dnd" class="jstree-default"></div>');
            $html.append('<i class="fas fa-arrows-alt"></i>');
            $html.append('<span class="jstree-items-count">' + Drupal.formatPlural(nodes.length, '1 item', '@count items') + '</span>');
            $html.append(nodes[0].element[0].outerHTML);
            return $.vakata.dnd.start(e, {
              'jstree': true,
              'nodes': nodes
            }, $html);
          }
        });
      });
    }
  };
})(jQuery, Drupal);