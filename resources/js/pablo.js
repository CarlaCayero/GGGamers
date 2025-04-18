document.addEventListener("DOMContentLoaded", function () {
    const icono = document.querySelector(".UsuarioIcono .icono");
    const opcionDesalir = document.querySelector(
        ".UsuarioIcono .OpcionDesalir"
    );

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

        // Añadir el evento de click en el icono para mostrar u ocultar la opción
        icono.addEventListener("click", function () {
            if (
                opcionDesalir.style.display === "none" ||
                opcionDesalir.style.display === ""
            ) {
                opcionDesalir.style.display = "block";
            } else {
                opcionDesalir.style.display = "none";
            }
        });
});
