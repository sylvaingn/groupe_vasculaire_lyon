document.addEventListener('DOMContentLoaded', function () {
    // Burger menu toggle
    const burger = document.querySelector('.burger');
    const menuMobile = document.querySelector('.menu-mobile');

    if (burger && menuMobile) {
        burger.addEventListener('click', function () {
            const isActive = burger.classList.toggle('is-active');
            menuMobile.classList.toggle('is-open');
            burger.setAttribute('aria-expanded', isActive);
            menuMobile.setAttribute('aria-hidden', !isActive);
            document.body.style.overflow = isActive ? 'hidden' : '';
        });

        // Fermer le menu en cliquant sur un lien
        menuMobile.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', () => {
                burger.classList.remove('is-active');
                menuMobile.classList.remove('is-open');
                burger.setAttribute('aria-expanded', 'false');
                menuMobile.setAttribute('aria-hidden', 'true');
                document.body.style.overflow = '';
            });
        });
    }

    // Card chirurgiens swiper
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