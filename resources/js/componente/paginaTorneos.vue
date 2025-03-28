<template>
    <!-- <div class="container text-center"> -->
    <!-- <div class="row align-items-start">
            <div class="col">
                <torneos-filtros></torneos-filtros>
            </div>
        </div>
    </div> -->

    <div class="TorneosContainer">
        <div class="Filtroseccion">
            <torneos-filtros @filtrar="filtrarJuegos"></torneos-filtros>
        </div>
        <div class="FiltroJuego">
            <torneos-cards v-for="(torneo, index) in torneos" :key="index" :image="torneo.rutas" />
        </div>
    </div>
</template>

<script>
import torneosFiltros from "./t-filtros.vue";
import torneosCards from "./t-cards.vue";

export default {
    components: {
        torneosCards,
        torneosFiltros
    },
    data() {
        return {
            torneos: [],
            torneosFiltrados: []
        };
    },
    methods: {
    filtrarJuegos(filtros) {
        console.log(filtros);
        this.torneosFiltrados = filtros;
        this.GetJuegosFiltro(filtros);
    },
    GetJuegos() {
        const me = this;
        axios.get("juegos")
            .then(response => {
                me.torneos = response.data;
            })
            .catch(error => {
                console.error("Error al cargar los datos:", error);
            });
    },
    GetJuegosFiltro(filtros){
        const me = this;
        axios
            .get("juegos", {
                params: {
                    juego: filtros.juego,
                    pegi: filtros.pegi,
                    categoria: filtros.categoria,
                    plataforma: filtros.plataforma
                },
            })
            .then((response) => {
                me.torneos = response.data;
            })
            .catch((error) => {
                console.error("Error al aplicar filtros:", error);
            });
    }
},
    mounted() {
    },

    created() {
        this.GetJuegos();
    },
}

</script>

<style scoped>
.TorneosContainer {
    display: flex;
    justify-content: center;
    width: 100%;
    height: auto;
    background-color: blue;
    min-height: 200px;
}

.Filtroseccion {
    width: 40%;
    height: auto;
    border: solid 1px red;

}

.FiltroJuego {
    width: 60%;
    height: auto;
    border: solid 1px green;
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
}
</style>
