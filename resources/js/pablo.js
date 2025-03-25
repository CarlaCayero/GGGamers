document.addEventListener("DOMContentLoaded", function () {
    const navbar = document.querySelector(".Mynavbar");

    function applyNavbarAnimation() {
        if (window.innerWidth > 760) {
            window.addEventListener("scroll", onScroll);
        } else {
            window.removeEventListener("scroll", onScroll);
            gsap.set(navbar, { top: "0px", width: "100%", left: "0%", x: "0%", borderRadius: "0px" });
        }
    }

    function onScroll() {
        if (window.scrollY > 100) {
            gsap.to(navbar, {
                duration: 1.5,
                top: "25px",
                width: "90%",
                left: "50%",
                x: "-50%",
                borderRadius: "15px",
                ease: "power2.out"
            });
        } else {
            gsap.to(navbar, {
                duration: 1.5,
                top: "0px",
                width: "100%",
                left: "0%",
                x: "0%",
                borderRadius: "0px",
                ease: "power2.out"
            });
        }
    }

    applyNavbarAnimation();
    window.addEventListener("resize", applyNavbarAnimation);
});
