/******/ (() => { // webpackBootstrap
/*!***************************************************!*\
  !*** ./resources/assets/js/custom/custom-auth.js ***!
  \***************************************************/
window.isEmpty = function (value) {
  return value === undefined || value === null || value === '';
};
$(document).on('click', '.change-type', function (e) {
  var inputField = $(this).siblings();
  var oldType = inputField.attr('type');
  var type = !isEmpty(oldType) ? oldType : 'password';
  if (type == 'password') {
    $(this).children().addClass('fa-eye');
    $(this).children().removeClass('fa-eye-slash');
    inputField.attr('type', 'text');
  } else {
    $(this).children().removeClass('fa-eye');
    $(this).children().addClass('fa-eye-slash');
    inputField.attr('type', 'password');
  }
});
/******/ })()
;