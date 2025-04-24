<template>
    <main>
        <section class="ends">DESCUBRE SI SERÁS UN VERDADERO CAMPEÓN</section>
        <section class="slides">
            <ul class="list">
                <li class="slide">
                    <div
                        class="background"
                        style="
                            background-image:  url('image/juegos/mk1.jpg');
                        "
                    ></div>
                    <div class="content">
                        <div class="contentText">
                            ENTRA AL COMBATE, DEMUESTRA TU PODER
                        </div>

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
                    <div class="content">
                        <div class="contentText">
                            SOLO LOS MEJORES ALCANZAN LA GLORIA
                        </div>
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
                    <div class="content">
                        <div class="contentText">
                            JUEGA DURO, GANA CON HONOR
                        </div></div>
                    <div class="overlay"></div>
                </li>
                <li class="slide">
                    <div
                        class="background"
                        style="
                            background-image:  url('image/juegos/Hearthstone.jpg');
                        "
                    ></div>
                    <div class="content">
                        <div class="contentText">
                            CADA PARTIDA ES UNA NUEVA OPORTUNIDAD
                        </div>
                    </div>
                    <div class="overlay"></div>
                </li>
                <li class="slide">
                    <div
                        class="background"
                        style="
                            background-image:  url('image/juegos/mario.jpg');
                        "
                    ></div>
                    <div class="content">
                        <div class="contentText">
                            LA VICTORIA PERTENECE A LOS PERSEVERANTES
                        </div>
                        </div>
                    <div class="overlay"></div>
                </li>
                <li class="slide">
                    <div
                        class="background"
                        style="
                            background-image:  url('image/juegos/tft.jpg');
                        "
                    ></div>
                    <div class="content">
                        <div class="contentText">
                            ENTRENA, COMPITE, CONQUISTA
                        </div></div>
                    <div class="overlay"></div>
                </li>
            </ul>
        </section>
        <section class="ends">JUEGA AHORA Y PONTE EN LA CIMA</section>
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
    text-transform: uppercase;
    font-size: 4.6rem;
    line-height: 1.25em;
    font-weight: 500;
    z-index: 2; /* Asegura que el contenido esté por encima del overlay */
}
.contentText {
    border-radius: 15px;
    padding: 0.5rem 1rem; /* Añade un poco de espacio alrededor del texto */
    display: inline-block; /* Hace que el fondo se ajuste al tamaño del texto */
}
.slide:nth-child(odd) .contentText {
    background-color: rgba(35, 2, 59, 0.6); /* Color original con opacidad */
    color: #C9FFFF;
}

.slide:nth-child(even) .contentText {
    background-color: rgba(198, 255, 65, 0.6); /* C6FF41 con opacidad */
    color: #23023B;
}


@media (max-width: 760px) {
    .slides .slide {
width: 100%;
}

}

</style>
