document.addEventListener("DOMContentLoaded", function () {
    // Navbar GSAP Scroll Animation
    const navbar = document.querySelector(".Mynavbar");

    function applyNavbarAnimation() {
        if (window.innerWidth > 760) {
            window.addEventListener("scroll", onScroll);
        } else {
            window.removeEventListener("scroll", onScroll);
            gsap.set(navbar, {
                top: "0px",
                width: "100%",
                left: "0%",
                x: "0%",
                borderRadius: "0px",
                border: "solid 0px"
            });
        }
    }

    function onScroll() {
        if (window.scrollY > 100) {
            gsap.to(navbar, {
                duration: 1.5,
                top: "12.5px",
                width: "80%",
                left: "50%",
                x: "-50%",
                borderRadius: "50px",
                ease: "power2.out",
                border: "solid 2px #C6FF41"
            });
        } else {
            gsap.to(navbar, {
                duration: 1.5,
                top: "0px",
                width: "100%",
                left: "0%",
                x: "0%",
                borderRadius: "0px",
                ease: "power2.out",
                border: "solid 0px"
            });
        }
    }

    applyNavbarAnimation();
    window.addEventListener("resize", applyNavbarAnimation);

    // Toggle menú de usuario al hacer click
    const icono = document.querySelector(".UsuarioIcono .icono");
    const menu = document.querySelector(".UsuarioIcono .OpcionDesalir");

    icono.style.cursor = "pointer"; // Mostrar mano

    icono.addEventListener("click", () => {
        menu.classList.toggle("activo");
    });

    // Cierra el menú si haces clic fuera
    document.addEventListener("click", (e) => {
        if (!icono.contains(e.target) && !menu.contains(e.target)) {
            menu.classList.remove("activo");
        }
    });
});
