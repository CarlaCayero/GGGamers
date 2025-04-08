<template>
    <div class="cardContainer">
        <div class="cardheader">
            <div class="headerpart1">
                <div class="Editar" @click="abrirModal('editar')">Editar</div>
                <div class="Eliminar" @click="abrirModal('eliminar')">Eliminar</div>
            </div>
        </div>

        <div class="cardcontainer">
            <div class="cardUser">
                <div class="cardIcon"></div>
                <div class="userDetails">
                    <p><strong>Nombre:</strong> {{ MiUsuario.nombre }}</p>
                    <p><strong>Email:</strong> {{ MiUsuario.mail }}</p>
                    <p><strong>Edad:</strong> {{ MiUsuario.edad }}</p>
                    <p>
                        <strong>Rol:</strong>
                        {{
                            MiUsuario.rol ? MiUsuario.rol.nombre : "No asignado"
                        }}
                    </p>
                </div>
            </div>
            <div class="cardinfo">
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal" v-if="mostrarModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        {{ modalType === 'editar' ? 'Editar Usuario' : 'Eliminar Usuario' }}
                    </h5>
                    <button type="button" class="close" @click="cerrarModal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div v-if="modalType === 'editar'">
                        <label>Nombre:</label>
                        <input v-model="MiUsuarioEditado.nombre" type="text" />
                        <label>Email:</label>
                        <input v-model="MiUsuarioEditado.mail" type="email" />
                        <label>Edad:</label>
                        <input v-model="MiUsuarioEditado.edad" type="number" />
                    </div>
                    <div v-else-if="modalType === 'eliminar'">
                        <p>¿Estás seguro de que deseas eliminar al usuario <strong>{{ MiUsuario.nombre }}</strong>?</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button v-if="modalType === 'editar'" class="btn btn-primary" @click="guardarCambios">
                        Guardar cambios
                    </button>
                    <button v-else-if="modalType === 'eliminar'" class="btn btn-danger" @click="eliminarUsuario">
                        Eliminar
                    </button>
                    <button class="btn btn-secondary" @click="cerrarModal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    inheritAttrs: false,
    props: {
        userId: {
            type: Number,
            required: true
        }
    },

    data() {
        return {
            MiUsuario: {},
            mostrarModal: false,
            modalType: null,
            MiUsuarioEditado: {}
        };
    },
    mounted() {
        this.ObtenerElDatosDeUsuarios();
    },
    methods: {
        ObtenerElDatosDeUsuarios() {
            axios
                .get("usuarios", {
                    params: {
                        id_usuario: this.userId,
                    },
                })
                .then((response) => {
                    console.log("ID de usuario enviado:", this.userId);
                    console.log("Datos del usuario:", response.data);
                    if (response.data.length > 0) {
                        this.MiUsuario = response.data[0]; // Asigna el primer usuario de la colección
                    } else {
                        console.error("No se encontró el usuario");
                    }
                })
                .catch((error) => {
                    console.error("Error al cargar los datos:", error);
                });

        },

        abrirModal(tipo) {
            this.modalType = tipo;
            this.mostrarModal = true;
            if (tipo === 'editar') {
                this.MiUsuarioEditado = { ...this.MiUsuario }; // Clona los datos actuales
            }
        },

        cerrarModal() {
            this.modalType = null;
            this.mostrarModal = false;
        },
        guardarCambios() {
            console.log("Guardando cambios:", this.MiUsuarioEditado);
            axios.put(`usuarios/${this.MiUsuario.id_usuario}`, this.MiUsuarioEditado)
                .then(() => {
                    this.cerrarModal();
                })
                .catch((error) => {
                    console.error("Error en la actualización:", error);
                });
        },
        eliminarUsuario() {
            console.log("Eliminando usuario:", this.MiUsuario.id);
            this.cerrarModal();
        },
    },

};
</script>
<style scoped>
.cardContainer {
    min-width: 400px;
    max-width: 1100px;
    width: 80%;
    display: flex;
    align-items: center;
    flex-direction: column;
    margin: 20px;
}

.cardheader {
    display: flex;
    width: 100%;
    height: 100px;
    background-color: #C6FF41;
    justify-content: end;
}

.cardcontainer {
    width: 100%;
    height: 500px;
    background-color: #C9FFFF;
    display: flex;
}

.cardIcon {
    width: 200px;
    height: 200px;
    border-radius: 100px;
    background-color: #C6FF41;
}

.cardUser {
    width: 30%;
    height: 100%;
    border: solid 1px black;
    display: flex;
    justify-content: space-around;
    align-items: center;
    flex-direction: column;
    text-align: center;
}

.cardinfo {
    width: 70%;
    height: 100%;
    display: flex;
    justify-content: center;
    align-content: center;
    flex-direction: column;
    border: solid 1px rgb(255, 0, 0);
}

.headerpart1 {
    display: flex;
    width: 50%;
    height: 100%;
    justify-content: space-around;
    align-items: center;
    flex-direction: row;
}
.modal {
    position: fixed;
    top: 0;
    left: 0;
    width: 100vw;
    height: 100vh;
    background-color: rgba(0, 0, 0, 0.6); /* fondo oscurecido */
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 999;
}

.modal-dialog {
    background-color: #ffffff;
    border-radius: 16px;
    width: 90%;
    max-width: 500px;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
    overflow: hidden;
    animation: fadeIn 0.3s ease-out;
}

.modal-header {
    background-color: #f4f4f4;
    padding: 16px 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-weight: bold;
    font-size: 18px;
    border-bottom: 1px solid #ddd;
}

.modal-body {
    padding: 20px;
    font-size: 16px;
    color: #333;
}

.modal-footer {
    padding: 16px 20px;
    display: flex;
    justify-content: flex-end;
    gap: 10px;
    background-color: #f9f9f9;
    border-top: 1px solid #ddd;
}

.modal-footer .btn {
    padding: 10px 16px;
    border-radius: 8px;
    font-weight: 500;
    font-size: 14px;
    cursor: pointer;
    border: none;
}

input {
    width: 100%;
    padding: 8px 12px;
    margin-bottom: 12px;
    border-radius: 6px;
    border: 1px solid #ccc;
    font-size: 14px;
}

.close {
    background: none;
    border: none;
    font-size: 20px;
    cursor: pointer;
}

/* Animación */
@keyframes fadeIn {
    from {
        transform: scale(0.9);
        opacity: 0;
    }
    to {
        transform: scale(1);
        opacity: 1;
    }
}

.Editar,
.Eliminar {
    width: 200px;
    height: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
    background-color: aqua;
}
</style>
