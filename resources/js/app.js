require('./bootstrap');

$(document).ready(function () {
  $('[data-bs-toggle="tooltip"]').tooltip();

  $('.main-cate').hover(function () {
    $(this).find('.dropdown-menu').addClass('show');
  }, function () {
    $(this).find('.dropdown-menu').removeClass('show');
  });
})
