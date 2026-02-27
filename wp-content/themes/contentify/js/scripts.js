document.addEventListener('DOMContentLoaded', function() {
    const chirurgienSwipers = document.querySelectorAll('.card-chirurgien__swiper');
    
    if (chirurgienSwipers.length > 0 && typeof Swiper !== 'undefined') {
        chirurgienSwipers.forEach(function(swiperEl) {
            new Swiper(swiperEl, {
                loop: true,
                slidesPerView: 1,
                spaceBetween: 0,
                pagination: {
                    el: swiperEl.querySelector('.swiper-pagination'),
                    clickable: true,
                },
                navigation: {
                    nextEl: swiperEl.querySelector('.swiper-button-next'),
                    prevEl: swiperEl.querySelector('.swiper-button-prev'),
                },
            });
        });
    }
});