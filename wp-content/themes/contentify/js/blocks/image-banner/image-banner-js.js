document.addEventListener('DOMContentLoaded', function() {
    const blocks = document.querySelectorAll('.block--image-banner:not(.is-editing)');
    
    blocks.forEach(block => {
        const content = block.querySelector('.block--image-banner__content');
        if (!content) return;
        
        const elements = content.querySelectorAll('.head-title, .block--image-banner__description, .block--image-banner__buttons');
        
        gsap.to(elements, {
            opacity: 1,
            y: 0,
            duration: 0.8,
            stagger: 0.15,
            ease: 'power2.out',
            scrollTrigger: {
                trigger: block,
                start: 'top 80%',
                once: true
            }
        });
    });
});
