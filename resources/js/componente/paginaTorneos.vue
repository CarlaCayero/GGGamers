<template>
    <div class="TorneosContainer">
        <div class="Filtroseccion">
            <torneos-filtros @filtrar="filtrarJuegos"></torneos-filtros>
        </div>
        <div class="FiltroJuego">
            <div class="ContenedorDeTornoes">
                <torneos-cards v-for="(torneo, index) in torneos" :key="index" :image="torneo.rutas" />
            </div>
            <div class="pagination">
            <button :disabled="currentPage === 1" @click="cambiarPagina(currentPage - 1)">Anterior</button>
            <span>Página {{ currentPage }} de {{ lastPage }}</span>
            <button :disabled="currentPage === lastPage" @click="cambiarPagina(currentPage + 1)">Siguiente</button>
        </div>
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
            torneosFiltrados: [],
            currentPage: 1,
            lastPage: 1,
            filtros: {}
        };
    },
    methods: {
        filtrarJuegos(filtros) {
            this.filtros = filtros; // Guardamos los filtros para paginación
            this.GetJuegosFiltro(filtros);
        },
        GetJuegos(page = 1) {
            axios.get("juegos", { params: { page } })
                .then(response => {
                    this.torneos = response.data.data;
                    this.currentPage = response.data.meta.current_page;
                    this.lastPage = response.data.meta.last_page;
                })
                .catch(error => {
                    console.error("Error al cargar los datos:", error);
                });
        },
        GetJuegosFiltro(filtros, page = 1) {
            axios.get("juegos", {
                params: {
                    juego: filtros.juego,
                    pegi: filtros.pegi,
                    categoria: filtros.categoria,
                    plataforma: filtros.plataforma,
                    page
                },
            })
            .then(response => {
                this.torneos = response.data.data;
                this.currentPage = response.data.meta.current_page;
                this.lastPage = response.data.meta.last_page;
            })
            .catch(error => {
                console.error("Error al aplicar filtros:", error);
            });
        },
        cambiarPagina(nuevaPagina) {
            this.currentPage = nuevaPagina;
            if (Object.keys(this.filtros).length) {
                this.GetJuegosFiltro(this.filtros, nuevaPagina);
            } else {
                this.GetJuegos(nuevaPagina);
            }
        }
    },
    created() {
        this.GetJuegos();
    }
}
</script>

<style scoped>
.TorneosContainer {
    padding: 20px;
    display: flex;
    justify-content: center;
    width: 100%;
    height: auto;
    background-color: #23023B;
    min-height: 200px;
}

.Filtroseccion {
    justify-content: center;
    align-items: center;
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
    align-items: center;
    flex-wrap: wrap;
    flex-direction: column;
}
.ContenedorDeTornoes{
    width: 90%;
    display: flex;
    height: auto;
    border: solid 1px yellow;
    flex-wrap: wrap;
    align-items: center;
    justify-content: center;
}
.pagination {
    display: flex;
    justify-content: center;
    margin: 20px;
    align-items: center;
    color: white;
}
.pagination button {
    margin: 0 10px;
    padding: 10px;
    background: #007bff;
    color: black;
    border: none;
    cursor: pointer;
}
.pagination button:disabled {
    background: #ccc;
    cursor: not-allowed;
}
@media (max-width: 800px) {
    .TorneosContainer{
        flex-direction: column;
    }
    .Filtroseccion , .FiltroJuego{
        width: 100%;
        margin-top: 10%;
    }
}
</style>
