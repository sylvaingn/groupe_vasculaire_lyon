document.addEventListener('DOMContentLoaded', function() {
    const blocks = document.querySelectorAll('.block--cta-banner:not(.is-editing)');
    
    blocks.forEach(block => {
        const wrapper = block.querySelector('.block--cta-banner--wrapper');
        if (!wrapper) return;
        
        const elements = wrapper.children;
        
        gsap.to(elements, {
            opacity: 1,
            y: 0,
            duration: 0.6,
            stagger: 0.1,
            ease: 'power2.out',
            scrollTrigger: {
                trigger: block,
                start: 'top 80%',
                once: true
            }
        });
    });
});
