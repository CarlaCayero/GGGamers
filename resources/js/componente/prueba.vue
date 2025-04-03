<template>
    <main>
        <section class="ends">Parallax with wiping titles</section>
        <section class="slides">
            <ul class="list">
                <li class="slide">
                    <div
                        class="background"
                        style="
                            background-image:  url('image/juegos/mk1.jpg');
                        "
                    ></div>
                    <div class="content">ENTRA AL COMBATE, DEMUESTRA TU PODER
                        <p>hola</p>
                    </div>
                    <div class="overlay"></div>
                </li>
                <li class="slide">
                    <div
                        class="background"
                        style="
                            background-image:  url('image/juegos/valorant.jpg');
                        "
                    ></div>
                    <div class="content">SOLO LOS MEJORES ALCANZAN LA GLORIA
                        <p></p>
                    </div>
                    <div class="overlay"></div>
                </li>
                <li class="slide">
                    <div
                        class="background"
                        style="
                            background-image:  url('image/juegos/cod6.png');
                        "
                    ></div>
                    <div class="content">JUEGA DURO, GANA CON HONOR</div>
                    <div class="overlay"></div>
                </li>
                <li class="slide">
                    <div
                        class="background"
                        style="
                            background-image:  url('image/juegos/Hearthstone.jpg');
                        "
                    ></div>
                    <div class="content">CADA PARTIDA ES UNA NUEVA OPORTUNIDAD</div>
                    <div class="overlay"></div>
                </li>
                <li class="slide">
                    <div
                        class="background"
                        style="
                            background-image:  url('image/juegos/mario.jpg');
                        "
                    ></div>
                    <div class="content">LA VICTORIA PERTENECE A LOS PERSEVERANTES</div>
                    <div class="overlay"></div>
                </li>
                <li class="slide">
                    <div
                        class="background"
                        style="
                            background-image:  url('image/juegos/tft.jpg');
                        "
                    ></div>
                    <div class="content">ENTRENA, COMPITE, CONQUISTA</div>
                    <div class="overlay"></div>
                </li>
            </ul>
        </section>
        <section class="ends">So fun, right?</section>
    </main>
</template>

<script>
export default {
  mounted() {
    // Ahora que los scripts han sido cargados globalmente, puedes usar GSAP
    gsap.registerPlugin(ScrollTrigger);

    let container = this.$el.querySelector(".slides"),
        slides = gsap.utils.toArray(".slide"),
        getRatio = (el) => window.innerHeight / (window.innerHeight + el.offsetHeight);

    slides.forEach((slide, i) => {
      let bg = slide.querySelector(".background"),
          content = slide.querySelector(".content"),
          tl = gsap.timeline({
                scrollTrigger: {
                  trigger: slide,
                  start: () => i ? "top bottom" : "top top",
                  end: "bottom top",
                  scrub: true,
                  invalidateOnRefresh: true
                }
              });

      tl.fromTo(bg, {
          y: () => i ? -window.innerHeight * getRatio(slide) : 0
        }, {
          y: () => window.innerHeight * (1 - getRatio(slide)),
          ease: "none"
        });
      tl.fromTo(content, {
          y: () => i ? window.innerHeight * -getRatio(slide) * 2 : 0
        }, {
          y: () => window.innerHeight * getRatio(slide) * 2,
          ease: "none"
        }, 0);
    });
  }
}
</script>

<style scoped>
* {
    box-sizing: border-box;
    padding: 0;
}
body,
html {
    margin: 0;
}
.ends {
    min-height: 60vh;
    display: flex;
    text-align: center;
    align-items: center;
    justify-content: center;
    font-size: 50px;
    font-weight: bold;
    color: white;
    background-color: #23023B;
}
main {
    display: flex;
    flex-direction: column;
}

.slides {
    display: flex;
    flex-direction: column;
    width: 97vw;
    position: relative;
    z-index: 1;
    background-color: #23023B;
}
.slides .list {
    display: flex;
    flex-direction: column;
    width: 100%;
}
.slides .slide {
    display: flex;
    width: 98.8vw;
    height: 100vh;
    position: relative;
    overflow: hidden;
}

.slide .background-container {
    position: absolute;
    left: 0;
    top: 0;
    width: 100vw;
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
}

.slide .background {
    position: absolute;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-position: center;
    background-size: cover;
    will-change: transform;
}

.slide .overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5); /* Sombra oscura con opacidad */
    pointer-events: none; /* Para que el overlay no interfiera con la interacción */
}

.slide .content {
    flex-direction: column;
    align-items: center;
    justify-content: center;
    overflow: hidden;
    display: flex;
    text-align: center;
    width: 95%;
    padding: 3rem;
    margin: 0 auto;
    box-sizing: border-box;
    max-width: 70rem;
    position: relative;
    color: #C9FFFF;
    text-transform: uppercase;
    font-size: 4.6rem;
    line-height: 1.25em;
    font-weight: 500;
    z-index: 2; /* Asegura que el contenido esté por encima del overlay */
}

.slide .content p {
    position: relative;
    z-index: 3; /* Resalta el <p> por encima del contenido */
    font-size: 1.5rem;
    font-weight: bold;
    text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.7); /* Sombra de texto para mayor contraste */
}
@media (max-width: 760px) {
    .slides .slide {
width: 100%;
}

}

</style>
