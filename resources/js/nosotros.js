/*
>>>>>>>>>>>>>
Qué ofrecemos
<<<<<<<<<<<<<
*/

const slides = [
    "Torneos épicos con grandes premios",
    "Un ambiente gamer inigualable",
    "Setups profesionales y tecnología punta",
    "Eventos y desafíos especiales",
    "Un espacio para crear comunidad y hacer amigos"
];

let currentSlide = 0;
const carousel = document.getElementById("carousel");

function nextSlide() {
    carousel.style.opacity = "0";
    setTimeout(() => {
        currentSlide = (currentSlide + 1) % slides.length;
        carousel.innerHTML = slides[currentSlide];
        carousel.style.opacity = "1";
    }, 1000);
}

setInterval(nextSlide, 3000);

// Carrusel de imágenes
const imageCarousel = document.getElementById("imageCarousel");
let currentImage = 0;

function nextImage() {
    currentImage = (currentImage + 1) % 4; // Cambia entre 4 imágenes
    const offset = -currentImage * 100; // Desplazamiento
    imageCarousel.style.transform = `translateX(${offset}%)`;
}

setInterval(nextImage, 3000); // Cambia automáticamente cada 4 segundos
