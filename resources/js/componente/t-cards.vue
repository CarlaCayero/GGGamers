<template>
    <div class="Torneo">
      <img :src="image" alt="Imagen del torneo" class="torneo-img" />
    </div>
</template>

<script>
export default {
    props: {
      image: String,
    },
}
</script>

<style scoped>
.Torneo {
    width: 200px;
    height: 300px;
    display: flex;
    border-radius: 25px;
    overflow: hidden;
    justify-content: center;
    align-items: center;
    margin: 10px;
}

.torneo-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
</style>
