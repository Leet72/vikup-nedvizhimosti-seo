/* Lightweight slider controls; no jQuery/Owl dependency. */
(function () {
  'use strict';
  function init(root) {
    var viewport = root.querySelector('[data-mvk-reviews-viewport]');
    var prev = root.querySelector('[data-mvk-reviews-prev]');
    var next = root.querySelector('[data-mvk-reviews-next]');
    if (!viewport || !prev || !next) return;
    var track = viewport.querySelector('.mvk-reviews__track');
    if (!track) return;
    function update() {
      var max = Math.max(0, viewport.scrollWidth - viewport.clientWidth);
      prev.disabled = viewport.scrollLeft < 4;
      next.disabled = viewport.scrollLeft >= max - 4;
    }
    function move(direction) {
      var card = track.querySelector('.mvk-reviews__card');
      if (!card) return;
      var gap = parseFloat(getComputedStyle(track).columnGap) || 0;
      viewport.scrollBy({ left: direction * (card.getBoundingClientRect().width + gap), behavior: 'smooth' });
    }
    prev.addEventListener('click', function () { move(-1); });
    next.addEventListener('click', function () { move(1); });
    viewport.addEventListener('scroll', update, { passive: true });
    window.addEventListener('resize', update, { passive: true });
    update();
  }
  function start() { document.querySelectorAll('.mvk-reviews').forEach(init); }
  if (document.readyState === 'loading') document.addEventListener('DOMContentLoaded', start);
  else start();
})();
