<template>
    <div class="categoria">
        <h3 class="label">Categoría</h3>
        <select class="form-select" aria-label="Default select example" v-model="selectedCategoria">
            <option v-for="categoria in categorias" :key="categoria.id_categoria" :value="categoria.id_categoria">
                {{ categoria.nombre }}
            </option>
        </select>
    </div>

</template>

<script>

export default {
    data() {
        return {
            categorias: [],
            selectedCategoria: "",
        };
    },
    created() {
        this.fetchCategorias();
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
        }
    }
}

</script>

<style></style>
