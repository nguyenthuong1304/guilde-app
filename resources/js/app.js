require('./bootstrap');

$(document).ready(function () {
  $('[data-bs-toggle="tooltip"]').tooltip();

  $('.main-cate').hover(function () {
    $(this).find('.dropdown-menu').addClass('show');
  }, function () {
    $(this).find('.dropdown-menu').removeClass('show');
  });

  const btn = $('#to-top');
  $(window).scroll(function() {
    if ($(window).scrollTop() > 300) {
      btn.addClass('show');
    } else {
      btn.removeClass('show');
    }
  });

  btn.on('click', function(e) {
    e.preventDefault();
    $('html, body').animate({scrollTop:0}, '300');
  });
})
