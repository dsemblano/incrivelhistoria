import lozad from 'lozad';

export default {
  init() {
    // JavaScript to be fired on all pages
    lozad('.lozad', {
      load: function(el) {
          el.src = el.dataset.src;
          el.onload = function() {
              el.classList.add('fadeIn')
          }
      },
    }).observe()
  },
  finalize() {
    // JavaScript to be fired on all pages, after page specific JS is fired
  },
};
