<template>
<main>
  <section class="ends">
      Parallax with wiping titles
  </section>
  <section class="slides">
    <ul class="list">
      <li class="slide">
        <div class="background" style="background-image: url('https://placedog.net/1920?id=1');
          "></div>
        <div class="content">
          SLIDE 1
        </div>
      </li>
      <li class="slide">
        <div class="background" style="background-image: url('https://placedog.net/1920?id=2');
          "></div>
        <div class="content">
          SLIDE 2
        </div>
      </li>
      <li class="slide">
        <div class="background" style="background-image: url('https://placedog.net/1920?id=3');
          "></div>
        <div class="content">
          SLIDE 3
        </div>
      </li>
      <li class="slide">
        <div class="background" style="background-image: url('https://placedog.net/1920?id=4');
          "></div>
        <div class="content">
          SLIDE 4
        </div>
      </li>
      <li class="slide">
        <div class="background" style="background-image: url('https://placedog.net/1920?id=5');
          "></div>
        <div class="content">
          SLIDE 5
        </div>
      </li>
      <li class="slide">
        <div class="background" style="background-image: url('https://placedog.net/1920?id=6');
          "></div>
        <div class="content">
          SLIDE 6
        </div>
      </li>
    </ul>
  </section>
  <section class="ends">
      So fun, right?
  </section>
</main>
</template>

<script>
gsap.registerPlugin(ScrollTrigger);

let container = document.querySelector(".slides"),
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

</script>

<style>
* {
  box-sizing: border-box;
  padding: 0;
}
body, html {
  margin: 0;
}
.ends {
  min-height: 100vh;
  display: flex;
  text-align: center;
  align-items: center;
  justify-content: center;
  font-size: 50px;
  font-weight: bold;
}
main {
  display: flex;
  flex-direction: column;
}

.slides {
  display: flex;
  flex-direction: column;
  width: 100%;
  position: relative;
  z-index: 1;
}
.slides .list {
  display: flex;
  flex-direction: column;
  width: 100%;
}
.slides .slide {
  display: flex;
  width: 100vw;
  height: 100vh;
  position: relative;
  overflow: hidden;
}
.slide .background {
  display: flex;
  align-items: center;
  justify-content: center;
  position: absolute;
  left: 0;
  top: 0;
  width: 100vw;
  height: 100vh;
  background-position: center;
  will-change: transform;
  background-size: cover;
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
  max-width: 40rem;
  position: relative;
  align-items: center;
  color: white;
  text-transform: uppercase;
  font-size: 4.6rem;
  line-height: 1.25em;
  font-weight: 500;
}
</style>
