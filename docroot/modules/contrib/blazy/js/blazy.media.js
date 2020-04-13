/**
 * @file
 * Provides Media module integration.
 */

(function (Drupal, _db) {

  'use strict';

  /**
   * Blazy media utility functions.
   *
   * @param {HTMLElement} media
   *   The media player HTML element.
   */
  function blazyMedia(media) {
    var t = media;
    var iframe = t.querySelector('iframe');
    var btn = t.querySelector('.media__icon--play');

    // Media player toggler is disabled, just display iframe.
    if (btn === null) {
      // At least make it responsive now, be sure to not touch cross origin.
      if (iframe && iframe.getAttribute('data-src') && iframe.getAttribute('data-src').indexOf('/oembed') > 0) {
        iframe.addEventListener('load', makeResponsive);
      }
      return;
    }

    var url = btn.getAttribute('data-url');
    var newIframe;

    /**
     * Makes the child iframe responsive.
     *
     * @todo remove this temp fix once oEmbed has overridable methods.
     */
    function makeResponsive() {
      var win = this.contentWindow;
      var doc = win || this.contentDocument;
      if (doc && doc.document) {
        doc = doc.document;
      }

      if (doc === null) {
        return;
      }

      doc.body.style.overflow = 'hidden';
    }

    /**
     * Play the media.
     *
     * @param {Event} event
     *   The event triggered by a `click` event.
     *
     * @return {bool}|{mixed}
     *   Return false if url is not available.
     */
    function play(event) {
      event.preventDefault();

      // oEmbed/ Soundcloud needs internet, fails on disconnected local.
      if (url === '') {
        return false;
      }

      var target = this;
      var player = target.parentNode;
      var playing = document.querySelector('.is-playing');
      var iframe = player.querySelector('iframe');
      var autoPlayUrl = url = target.getAttribute('data-autoplay');

      url = target.getAttribute('data-url');
      // @todo remove BC for PhotoSwipe after updating to core oEmbed.
      if (!autoPlayUrl) {
        autoPlayUrl = url;
      }

      // First, reset any video to avoid multiple videos from playing.
      if (playing !== null) {
        playing.className = playing.className.replace(/(\S+)playing/, '');
      }

      // Appends the iframe.
      player.className += ' is-playing';
      newIframe = document.createElement('iframe');
      newIframe.className = 'media__iframe media__element';
      newIframe.setAttribute('src', url.indexOf('/oembed') > 0 ? url : autoPlayUrl);
      newIframe.setAttribute('allowfullscreen', true);

      if (iframe !== null) {
        player.removeChild(iframe);
      }

      // Ensures we don't touch cross-origin object, else SecurityError.
      // The transformed url may also contain `oembed` at `?feature=oembed.
      // The expected here is the top level iframe with ``/media/oembed` route.
      if (url.indexOf('/oembed') > 0) {
        newIframe.addEventListener('load', makeResponsive);
      }

      player.appendChild(newIframe);
    }

    /**
     * Close the media.
     *
     * @param {Event} event
     *   The event triggered by a `click` event.
     */
    function stop(event) {
      event.preventDefault();

      var target = this;
      var player = target.parentNode;
      var iframe = player.querySelector('iframe.media__element');

      if (player.className.match('is-playing')) {
        player.className = player.className.replace(/(\S+)playing/, '');
      }

      if (iframe !== null) {
        player.removeChild(iframe);
      }
    }

    // Remove iframe to avoid browser requesting them till clicked.
    // The iframe is there as Blazy supports non-lazyloaded/ non-JS iframes.
    if (iframe !== null && iframe.parentNode != null) {
      iframe.parentNode.removeChild(iframe);
    }

    // Plays the media player.
    _db.on(t, 'click', '.media__icon--play', play);

    // Closes the video.
    _db.on(t, 'click', '.media__icon--close', stop);

    t.className += ' media--player--on';
  }

  /**
   * Attaches Blazy media behavior to HTML element.
   *
   * @type {Drupal~behavior}
   */
  Drupal.behaviors.blazyMedia = {
    attach: function (context) {
      var players = context.querySelectorAll('.media--player:not(.media--player--on)');
      _db.once(_db.forEach(players, blazyMedia));
    }
  };

})(Drupal, dBlazy);
