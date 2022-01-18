/******/ (() => { // webpackBootstrap
    /******/ 	"use strict";
    var __webpack_exports__ = {};
    /*!********************************!*\
      !*** ./resources/js/custom.js ***!
      \********************************/


    $(document).ready(function () {
        $('.body').addClass('overflow-hidden');
        $(".pcoded-navbar").attr("navbar-theme", 'themelight1');
        $('.theme-loader').animate({
            'opacity': '0'
        }, 1200);
        setTimeout(function () {
            $('.body').removeClass('overflow-hidden');
            $('.theme-loader').remove();
        }, 2000);
    });
    /******/ })()
;
