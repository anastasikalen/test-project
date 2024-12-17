document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('li').forEach(item => {
        item.addEventListener('mouseover', (event) => {
            const desc = item.getAttribute('data-desc');
            if (desc) {
                const tooltip = document.createElement('div');
                tooltip.className = 'tooltip';
                tooltip.innerText = desc;
                document.body.appendChild(tooltip);
        
                tooltip.style.position = 'absolute';
                tooltip.style.left = `${event.pageX + 10}px`;
                tooltip.style.top = `${event.pageY + 10}px`;
            }
        });

        item.addEventListener('mouseout', () => {
            const tooltip = document.querySelector('.tooltip');
            if (tooltip) {
                tooltip.remove();
            }
        });
    });
});
