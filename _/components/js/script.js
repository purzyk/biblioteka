jQuery(document).ready(function($) {
  var $transformer = $('.transformer'),
  $menuToggleBtn = $('.menu-toggle-btn');

  // Attaches event handler when .menu-toggle-btn is clicked
  $menuToggleBtn.on('click', function(event) {
    event.preventDefault();
    $transformer.toggleClass('is-open');
  });
});
