document.addEventListener('DOMContentLoaded', function() {
    const cards = document.querySelectorAll('.block--specialities-list__card');
    const zones = document.querySelectorAll('.zone-schema');
    
    // Hover sur les cartes -> highlight zones
    cards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            const cardZones = this.dataset.zones;
            if (!cardZones) return;
            
            const zoneIds = cardZones.split(',');
            zoneIds.forEach(zoneId => {
                const zoneElement = document.getElementById(zoneId.trim());
                if (zoneElement) {
                    zoneElement.classList.add('zone-schema--active');
                }
            });
        });
        
        card.addEventListener('mouseleave', function() {
            const cardZones = this.dataset.zones;
            if (!cardZones) return;
            
            const zoneIds = cardZones.split(',');
            zoneIds.forEach(zoneId => {
                const zoneElement = document.getElementById(zoneId.trim());
                if (zoneElement) {
                    zoneElement.classList.remove('zone-schema--active');
                }
            });
        });
    });
    
    // Hover sur les zones -> highlight cartes
    zones.forEach(zone => {
        zone.addEventListener('mouseenter', function() {
            const zoneId = this.id;
            cards.forEach(card => {
                const cardZones = card.dataset.zones;
                if (cardZones && cardZones.split(',').map(z => z.trim()).includes(zoneId)) {
                    card.classList.add('block--specialities-list__card--active');
                }
            });
            this.classList.add('zone-schema--active');
        });
        
        zone.addEventListener('mouseleave', function() {
            const zoneId = this.id;
            cards.forEach(card => {
                const cardZones = card.dataset.zones;
                if (cardZones && cardZones.split(',').map(z => z.trim()).includes(zoneId)) {
                    card.classList.remove('block--specialities-list__card--active');
                }
            });
            this.classList.remove('zone-schema--active');
        });
    });
});