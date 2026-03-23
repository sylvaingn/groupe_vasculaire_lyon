document.addEventListener('DOMContentLoaded', function() {
    const blocks = document.querySelectorAll('.block--posts-feed:not(.is-editing)');
    
    blocks.forEach(block => {
        const cards = block.querySelectorAll('.block--posts-feed__grid > *');
        if (!cards.length) return;
        
        gsap.to(cards, {
            opacity: 1,
            y: 0,
            duration: 0.6,
            stagger: 0.1,
            ease: 'power2.out',
            scrollTrigger: {
                trigger: block.querySelector('.block--posts-feed__grid'),
                start: 'top 85%',
                once: true
            }
        });
    });
});
