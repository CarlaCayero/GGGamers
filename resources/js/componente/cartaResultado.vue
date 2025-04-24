<template>
    <div class="book">
        <img :src="imageUrl" alt="Meme divertido" class="meme-image" />
        <div class="cover">
            <img :src="imageInter" alt="meme image">

        </div>
    </div>
</template>

<script>
export default {
    props: {
        probabilidad: {
            type: Number,
            required: true
        }
    },
    computed: {
        imageUrl() {
            if (this.probabilidad === 0) {
                return '../image/ImageResult/catxd.png'; // Imagen para probabilidad 0%
            } else if (this.probabilidad < 25) {
                return '../image/ImageResult/catsad.png'; // Imagen para probabilidad baja
            } else if (this.probabilidad < 50) {
                return '../image/ImageResult/catstanding.png'; // Imagen para probabilidad neutral
            } else if (this.probabilidad < 75) {
                return '../image/ImageResult/catcat.png'; // Imagen para probabilidad alta
            } else {
                return '../image/ImageResult/kirbo.jpg'; // Imagen para probabilidad máxima
            }
        },
        imageInter(){
            return '../image/logo/logo.png';
        }

    }
};
</script>





<style scoped>
.book {
    position: relative;
    border-radius: 10px;
    width: 350px;
    height: 450px;
    background-color: #C6FF41;
    box-shadow: 1px 1px 12px #000;
    transform: preserve-3d;
    perspective: 2000px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #000;
    flex-direction: column;
    animation: float 3s ease-in-out infinite, glow 2s ease-in-out infinite;
}

.cover {
    top: 0;
    position: absolute;
    background-color: #23023B;
    width: 100%;
    height: 100%;
    border-radius: 10px;
    cursor: pointer;
    transition: all 0.5s;
    transform-origin: 0;
    box-shadow: 1px 1px 12px #C6FF41;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
}
.cover img{
    display: flex;
    width: 80%;
    height: 300px;
}

.book:hover .cover {
    transform: rotatey(-80deg);
}

p {
    font-size: 20px;
    font-weight: bolder;
}

.meme-image {
    width: 70%;
    height: 400px;
    border-radius: 5px;
    margin-top: 20px;
}

@keyframes float {
    0%, 100% {
        transform: translateY(0);
    }
    50% {
        transform: translateY(-10px);
    }
}

@keyframes glow {
    0%, 100% {
        box-shadow: 0 0 10px #C6FF41, 0 0 20px #C6FF41, 0 0 30px #C6FF41;
    }
    50% {
        box-shadow: 0 0 20px #C6FF41, 0 0 30px #C6FF41, 0 0 40px #C6FF41;
    }
}
</style>
