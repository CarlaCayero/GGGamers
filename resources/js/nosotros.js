document.addEventListener("DOMContentLoaded", () => {
    const carouselContent = document.querySelector(".n-carousel-content");
    let currentAngle = 0;

    // Funció per actualitzar la rotació
    const rotateCarousel = () => {
        currentAngle -= 120; // Gira 120 graus en sentit horari
        carouselContent.style.transform = `translateZ(-182px) rotateY(${currentAngle}deg)`;
    };

    // Configura el carrusel per girar cada 3 segons
    setInterval(rotateCarousel, 3000);
});
