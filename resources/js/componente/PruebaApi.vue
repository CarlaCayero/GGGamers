<template>
    <div class="tabla-juegos container mt-4">
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Nombre</th>
                    <th>PEGI</th>
                    <th>Acciones</th>
                    <th>
                        <button class="btn btn-primary btn-sm me-2" @click="AbrirMenuAñadir()">
                            Añadir
                        </button>
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="juego in Juegos" :key="juego.id">
                    <td>{{ juego.nombre }}</td>
                    <td>{{ juego.pegi }}</td>
                    <td>
                        <button class="btn btn-primary btn-sm me-2" @click="AbirMenuEditar(juego)">
                            Editar
                        </button>
                        <button class="btn btn-danger btn-sm" @click="AbrirMenuEliminar(juego)">
                            Eliminar
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="modal" tabindex="-1" role="dialog" id="Añadir">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 v-if="insert" class="modal-title">Añadir Juegos</h5>
                    <h5 v-else class="modal-title">Editar</h5>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre del Juego</label>
                        <input type="text" class="form-control" id="nombre" v-model="juego.nombre" required />
                    </div>
                    <div class="mb-3">
                        <label for="pegi" class="form-label">PEGI</label>
                        <input type="number" class="form-control" id="pegi" v-model="juego.pegi" min="3" max="18"
                            required />
                    </div>
                </div>
                <div class="modal-footer">
                    <button v-if="insert" @click="AñadirJuego" type="button" class="btn btn-danger">
                        Añadir
                    </button>
                    <button v-else @click="EditarJuego" type="button" class="btn btn-danger">
                        Editar
                    </button>
                    <button @click="CerrarModal" type="button" class="btn btn-secondary">
                        Cerrar
                    </button>
                </div>
            </div>
        </div>
    </div>



    <!-- Modal para eliminar -->
    <div class="modal" tabindex="-1" role="dialog" id="Eliminar">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Eliminar Juego</h5>
                </div>
                <div class="modal-body">
                    <p>
                        ¿Seguro que deseas eliminar el juego
                        <strong>{{ juego.nombre }}</strong>?
                    </p>
                    <span v-if="EsError" class="badge text-bg-danger">
                        {{ MensajeDeError }}</span>
                </div>
                <div class="modal-footer">
                    <button @click="EliminarJuego" type="button" class="btn btn-danger">
                        Eliminar
                    </button>
                    <button @click="CerrarModal" type="button" class="btn btn-secondary">
                        Cerrar
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
import * as bootstrap from "bootstrap";

export default {
    data() {
        return {
            Juegos: [],
            juego: {},
            MensajeDeError: "",
            EsError: false,
            MyModelo: null,
            insert: false,
        };
    },
    methods: {
        SelectJuegos() {
            const me = this;
            axios.get("juegos").then((response) => {
                me.Juegos = response.data;
            });
        },
        AbirMenuEditar() {
            this.insert = false;
            this.MyModelo = new bootstrap.Modal("#Añadir");
            this.MyModelo.show();
        },
        AbrirMenuAñadir() {
            this.insert = true;
            this.MyModelo = new bootstrap.Modal("#Añadir");
            this.MyModelo.show();
        },
        AbrirMenuEliminar(juego) {
            this.EsError = false;
            this.juego = juego;
            this.MyModelo = new bootstrap.Modal("#Eliminar");
            this.MyModelo.show();
        },
        CerrarModal() {
            if (this.MyModelo) {
                this.MyModelo.hide();
            }
        },
        AñadirJuego() {
            const me = this;
            axios
                .post("juegos", me.juego)
                .then(() => {
                    this.SelectJuegos();
                    this.CerrarModal();
                })
                .catch((error) => {
                    this.EsError = true;
                    me.MensajeDeError = error.response.data.error;
                });
        },
        EliminarJuego() {
            const me = this;
            axios
                .delete("juegos/" + me.juego.id_juego)
                .then(() => {
                    this.SelectJuegos();
                    this.CerrarModal();
                })
                .catch((error) => {
                    this.EsError = true;
                    this.MensajeDeError =
                        error.response.data.error ||
                        "Error al eliminar el juego";
                });
        },
        EditarJuego() {
            const me = this;
            axios
                .put("juegos/" + this.juego.id, me.juego)
                .then(() => {
                    this.SelectJuegos();
                    this.CerrarModal();
                })
                .catch((error) => {
                    this.EsError = true;
                    me.MensajeDeError = error.response.data.error;
                });
        }
    },
    created() {
        this.SelectJuegos();
    },
};
</script>

<style scoped>
.tabla-juegos {
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    background: #fff;
}

.table {
    margin-top: 20px;
}

.card {
    background-color: #f8f9fa;
    border-radius: 8px;
}

.form-label {
    font-weight: bold;
}
</style>
