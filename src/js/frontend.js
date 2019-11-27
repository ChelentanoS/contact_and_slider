'use strict';
import Swiper from 'swiper';

jQuery(document).ready(function ($) {
    $('.scroll_to').on('click', function (event) {
        event.preventDefault();

        $('body, html').animate({scrollTop: $('#row-contact').offset().top + "px"}, {duration: 400});
    });


    let mySwiper = new Swiper ('.swiper-container', {
        loop: true,
        setWrapperSize: true
    })
});

