<template>
    <div class="container text-center">
        <div class="row align-items-start">
            <div class="col">
                <torneos-filtros></torneos-filtros>
            </div>
        </div>
    </div>
</template>

<script>
import torneosFiltros from "./t-filtros.vue";
import torneosCards from "./t-cards.vue";

export default {
    components:{
        torneosCards,
        torneosFiltros
    }
}
</script>

<style scoped></style>
