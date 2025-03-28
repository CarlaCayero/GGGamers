<template>
    <div class="container">
        <h5>Filtros de búsqueda</h5>
        <form @submit.prevent="submitForm">
            <div class="f-juegos">
                <h5 class="label">Nombre del Juego:</h5>
                <input type="text" class="form-control" v-model="selectedJuegos" placeholder="Introduce el nombre del juego" />
            </div>
            <!-- Filtro de PEGI -->
            <div class="f-pegi">
                <h5 class="label">PEGI:</h5>
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
                <h5 class="label">Categoría:</h5>
                <select class="form-select" aria-label="Default select example" v-model="selectedCategoria">
                    <option v-for="categoria in categorias" :key="categoria.id_categoria" :value="categoria.nombre">
                        {{ categoria.nombre }}
                    </option>
                </select>
            </div>

            <!-- Filtro de Plataforma -->
            <div class="f-plataforma">
                <h5 class="label">Plataforma:</h5>
                <select class="form-select" aria-label="Default select example" v-model="selectedPlataforma">
                    <option v-for="plataforma in plataformas" :key="plataforma.id_plataforma" :value="plataforma.nombre">
                        {{ plataforma.nombre }}
                    </option>
                </select>
            </div>

            <!-- Botón de submit -->
            <div class="f-submit">
                <button type="submit" class="btn btn-primary">Buscar</button>
            </div>
        </form>

        <!-- Enlace para mostrar todos los juegos -->
        <div class="ver-todos">
            <button @click="verTodosJuegos" class="btn btn-secondary">Ver todos los juegos</button>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            categorias: [],
            juegos: [],
            plataformas: [],
            selectedCategoria: "",
            selectedJuegos: "",
            selectedPegi: "",
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
                    console.error("Error al cargar las plataformas", error);
                });
        },
        submitForm() {
            // Emitir los filtros seleccionados al componente padre
            this.$emit("filtrar", {
                juego: this.selectedJuegos,
                pegi: this.selectedPegi,
                categoria: this.selectedCategoria,
                plataforma: this.selectedPlataforma
            });
        },
        verTodosJuegos() {
            this.$emit("filtrar", {
                juego: "",
                pegi: "",
                categoria: "",
                plataforma: ""
            });
            this.selectedJuegos = "",
            this.selectedPegi = "",
            this.selectedCategoria = "",
            this.selectedPlataforma = ""
        }
    },
}
</script>

<style scoped>
.form-select, .form-control {
    font-family: "Exo 2";
    width: 100%;
    height: 3rem;
    font-size: 1.2rem;
    padding: 0.5rem;
    border-radius: 0.5rem;
    border: 1px solid #ccc;
}

.btn {
    font-family: "Exo 2";
    width: 100%;
    height: 3rem;
    font-size: 1.2rem;
    padding: 0.5rem;
    border-radius: 0.5rem;
}

.container{
    width: 300px;
}

.ver-todos {
    margin-top: 1rem;
    text-align: center;
}

.btn-secondary {
    width: 100%;
    height: 3rem;
    font-size: 1.2rem;
    padding: 0.5rem;
    border-radius: 0.5rem;
}
</style>
