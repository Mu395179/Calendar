window.onload = function () {
    // Create raindrops
    createRaindrops();

    function createRaindrops() {
        for (let i = 0; i < 1000; i++) {
            setTimeout(createRaindrop, i * 100);
        }
    }

    function createRaindrop() {
        const raindrop = document.createElement('div');
        raindrop.className = 'raindrop';
        raindrop.style.left = `${Math.random() * window.innerWidth}px`;
        document.body.appendChild(raindrop);
        animateRaindrop(raindrop);
    }

    function animateRaindrop(raindrop) {
        let y = 0;
        const animationInterval = setInterval(frame, 10);

        function frame() {
            if (y >= window.innerHeight) {
                clearInterval(animationInterval);
                raindrop.parentNode.removeChild(raindrop);
            } else {
                y += 5; // Adjust this value to change the speed of raindrops
                raindrop.style.top = `${y}px`;
            }
        }
    }
};