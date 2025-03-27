<template>
    <div class="container">
        <h5>Filtros de búsqueda</h5>
        <form>
            <!-- Filtro de Juegos -->
            <div class="f-juegos">
                <h3 class="label">Nombre del Juego:</h3>
                <select class="form-select" aria-label="Default select example" v-model="selectedJuegos">
                    <option v-for="juego in juegos" :key="juego.id_juego" :value="juego.nombre">
                        {{ juego.nombre }}
                    </option>
                </select>
            </div>
            <!-- Filtro de PEGI -->
            <div class="f-pegi">
                <h3 class="label">PEGI:</h3>
                <select class="form-select" aria-label="Default select example" v-model="selectedPegi">
                    <option value="3">PEGI 3</option>
                    <option value="7">PEGI 7</option>
                    <option value="12">PEGI 12</option>
                    <option value="16">PEGI 16</option>
                    <option value="18">PEGI 18</option>
                </select>
            </div>

            <!-- Filtro de Categoría -->
            <div class="f-categoria">
                <h3 class="label">Categoría:</h3>
                <select class="form-select" aria-label="Default select example" v-model="selectedCategoria">
                    <option v-for="categoria in categorias" :key="categoria.id_categoria" :value="categoria.nombre">
                        {{ categoria.nombre }}
                    </option>
                </select>
            </div>

            <!-- Filtro de Plataforma -->
            <div class="f-plataforma">
                <h3 class="label">Plataforma:</h3>
                <select class="form-select" aria-label="Default select example" v-model="selectedPlataforma">
                    <option v-for="plataforma in plataformas" :key="plataforma.id_plataforma" :value="plataforma.nombre">
                        {{ plataforma.nombre }}
                    </option>
                </select>
            </div>
        </form>
    </div>
</template>

<script>
export default {
    data() {
        return {
            categorias: [],
            selectedCategoria: "",
            juegos: [],
            selectedJuegos: "",
            selectedPegi: "",
            plataformas: [],
            selectedPlataforma: "",
        };
    },
    created() {
        this.fetchCategorias();
        this.fetchJuegos();
        this.fetchPlataformas();
    },
    methods: {
        fetchCategorias() {
            axios.get("categorias")
                .then((response) => {
                    this.categorias = response.data;
                })
                .catch((error) => {
                    console.error("Error al cargar las categorías", error);
                });
        },
        fetchJuegos() {
            axios.get("juegos")
                .then((response) => {
                    this.juegos = response.data;
                })
                .catch((error) => {
                    console.error("Error al cargar los juegos", error);
                });
        },
        fetchPlataformas() {
            axios.get("plataformas")
                .then((response) => {
                    this.plataformas = response.data;
                })
                .catch((error) => {
                    console.error("Error al cargar las categorías", error);
                });
        },
    },
}
</script>

<style scoped>
.form-select {
    font-family: "Exo 2";
    width: 100%; /* Amplada completa */
    height: 3rem; /* Augmenta l'alçada del select */
    font-size: 1.2rem; /* Augmenta la mida del text */
    padding: 0.5rem; /* Afegir espai intern */
    border-radius: 0.5rem; /* Bordes arrodonits per un estil més modern */
    border: 1px solid #ccc; /* Color del contorn */
}
.container{
    width: 500px;

}
</style>
