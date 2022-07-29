/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*******************************!*\
  !*** ./resources/js/admin.js ***!
  \*******************************/
var initAdmin = function initAdmin() {
  document.querySelectorAll('.sidebar-mini-btn').forEach(function (item) {
    if (item.getAttribute('sidebar-mini-btn') == 'true') return;
    item.setAttribute('sidebar-mini-btn', 'true');
    item.addEventListener('click', function (e) {
      if (document.querySelector('body').classList.contains('sidebar-mini')) {
        document.querySelector('body').classList.remove('sidebar-mini');
        localStorage.setItem('sidebar-mini', false);
      } else {
        localStorage.setItem('sidebar-mini', true);
        document.querySelector('body').classList.add('sidebar-mini');
      }

      e.stopImmediatePropagation();
      e.stopPropagation();
      e.preventDefault();
    });
  });

  if (localStorage.getItem('sidebar-mini') == 'true' && !document.querySelector('body').classList.contains('sidebar-mini')) {
    document.querySelector('body').classList.add('sidebar-mini');
  }

  if (localStorage.getItem('sidebar-mini') != 'true' && document.querySelector('body').classList.contains('sidebar-mini')) {
    document.querySelector('body').classList.remove('sidebar-mini');
  }
};

document.addEventListener('DOMContentLoaded', function () {
  document.addEventListener("devhau:turbo", function (event) {
    initAdmin();
  });
  initAdmin();
});
/******/ })()
;