document.addEventListener('DOMContentLoaded', function () {
    const cardChirurgiens = document.querySelectorAll('.card-chirurgien');
    cardChirurgiens?.forEach((card) => {
        const swiperChirurgien = card.querySelector('.card-chirurgien__swiper');

        const chirurgienSwiper = new Swiper(swiperChirurgien, {
            loop: true,

            slidesPerView: 1,
            spaceBetween: 0,
            //dont allow touch move
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            breakpoints: {
                1024: {
                    autoplay: {
                        delay: 1000,
                        disableOnInteraction: false,
                    },
                    allowTouchMove: false,
                }
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