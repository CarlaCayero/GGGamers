<template>
    <div class="cardContainer"></div>
    <div class="cardContainer2"></div>
</template>

<script>
export default {

}
</script>

<style scoped>
.cardContainer, .cardContainer2{
    display: flex;
    height: auto;
    min-height: 200px;
    margin-top: 20px;
}
.cardContainer{
    width: 65%;
    border: solid 1px red;
}
.cardContainer2{
    width: 35%;
    border: solid 1px rgb(72, 0, 255);
}
</style>
