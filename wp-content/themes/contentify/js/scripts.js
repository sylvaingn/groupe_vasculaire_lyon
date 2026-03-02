document.addEventListener('DOMContentLoaded', function () {
    const cardChirurgiens = document.querySelectorAll('.card-chirurgien');
    cardChirurgiens?.forEach((card) => {
        const swiperChirurgien = card.querySelector('.card-chirurgien__swiper');

        const chirurgienSwiper = new Swiper(swiperChirurgien, {
            loop: true,
            autoplay: {
                delay: 1000,
                disableOnInteraction: false,
            },
            slidesPerView: 1,
            spaceBetween: 0,
            //dont allow touch move
            allowTouchMove: false,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            on: {
                init: function () {
                    // Stop autoplay on initialization
                    this.autoplay.stop();
                }
            }
        });

        //on card hover, autoplay swiper, and when leave, stop autoplay
        card.addEventListener('mouseenter', () => {
            chirurgienSwiper.autoplay.start();
        });
        card.addEventListener('mouseleave', () => {
            chirurgienSwiper.autoplay.stop();
        });
    });
})
;