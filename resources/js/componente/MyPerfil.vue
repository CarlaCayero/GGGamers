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
                    <!-- <p>
                        <strong>Rol:</strong>
                        {{
                            MiUsuario.rol ? MiUsuario.rol.nombre : "No asignado"
                        }}
                    </p> -->
                </div>
            </div>
            <div class="cardinfo">
                <div class="cardinfoName">
                    <div class="cardinfoNameUser">
                        <h4>Nombre: {{ MiUsuario.nombre }}</h4>
                    </div>
                    <div class="cardinfoNameYear">
                        <h4>Edad: {{ MiUsuario.edad }}</h4>
                    </div>
                </div>
                <div class="cardinfoGmail">
                    <h4>Gmail: {{ MiUsuario.mail }}</h4>
                </div>
                <div class="cardinfoName">
                    <div class="cardinfoNameUser">
                        <h4 v-if="NoParticipadosEventos == false">
                            Torneos Participados: {{ eventosParticipados.length }}
                        </h4>
                        <h4 v-else>
                            No has Participado aun
                        </h4>
                    </div>
                    <div class="cardinfoNameYear">
                        <h4 v-if="NoTorneosGanados == false">
                            Torneos Ganados: {{ eventosGanados.length }}
                        </h4>
                        <h4 v-else>
                            No has ganado aun
                        </h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <h1>Estadistica</h1>
    <div class="tablaEstadistica">
        <div class="tablaEstadisticaParticipados">
            <canvas v-if="NoParticipadosEventos == false" id="graficoParticipados"></canvas>
            <div v-else>
                <p>no has participados aun</p>
            </div>
        </div>
        <div class="tablaEstadisticaGanados">
            <canvas v-if="NoTorneosGanados == false" id="graficoGanados"></canvas>
            <div v-else>
                <p>no has Ganado aun</p>
            </div>
        </div>
    </div>
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

import { Chart, registerables } from 'chart.js';
Chart.register(...registerables);

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
            MiUsuarioEditado: {},
            eventosParticipados: [], // Para los eventos en los que el usuario ha participado
            eventosGanados: [], // Para los eventos que el usuario ha ganado
            NoParticipadosEventos: false,
            NoTorneosGanados: false
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
                        this.MiUsuario = response.data[0];
                        this.eventosParticipados = this.MiUsuario.eventos
                        this.eventosGanados = this.eventosParticipados.filter(
                            (evento) => evento.pivot.posicion === 1
                        );
                        if (this.eventosParticipados.length != 0) {
                            this.renderGrafico(this.eventosParticipados);
                        } else {
                            this.NoParticipadosEventos = true;
                        }
                        if (this.eventosGanados.length != 0) {
                            this.renderGrafico(this.eventosGanados);
                        } else {
                            this.NoTorneosGanados = true;
                        }
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
        renderGrafico(eventos) {
            const conteoJuegos = {};

            eventos.forEach(evento => {
                const nombreJuego = evento.juego?.nombre || 'Juego desconocido';
                if (conteoJuegos[nombreJuego]) {
                    conteoJuegos[nombreJuego]++;
                } else {
                    conteoJuegos[nombreJuego] = 1;
                }
            });

            const labels = Object.keys(conteoJuegos);
            const data = Object.values(conteoJuegos);

            const colores = [
                '#C6FF41', '#36A2EB', '#FFCE56', '#4BC0C0',
                '#9966FF', '#FF9F40', '#C9CBCF', '#8AE234',
                '#F03464', '#B94FC8'
            ];

            const ctx = eventos === this.eventosParticipados ? document.getElementById('graficoParticipados') : document.getElementById('graficoGanados');
            if (ctx) {
                new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: labels,
                        datasets: [{
                            data: data,
                            backgroundColor: colores.slice(0, labels.length),
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'bottom',
                                labels: {
                                    color: 'white',
                                    font: {
                                        size: 14,
                                        family: "'Exo 2', sans-serif"
                                    }
                                }
                            }
                        }
                    }
                });
            }
        }



    },

};
</script>
<style scoped>
h1{
    color: white;
}
.cardContainer {
    min-width: 400px;
    max-width: 1100px;
    width: 80%;
    height: auto;
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
    display: flex;
    border: solid 2px #C6FF41;
    color: white;
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
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    text-align: center;
}

.cardinfo {
    width: 70%;
    height: 100%;
    display: flex;
    align-items: center;
    flex-direction: column;
    text-align: center;
}

.cardinfoName {
    width: 100%;
    height: 20%;
    display: flex;
}

.cardinfoNameUser,
.cardinfoNameYear {
    width: 50%;
    height: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
}

.cardinfoGmail {
    width: 100%;
    height: 20%;
    display: flex;
    justify-content: center;
    align-items: center;

}

.cardinfo,
.cardinfoName,
.cardinfoNameUser,
.cardinfoNameYear,
.cardinfoGmail {
    position: relative;
    /* Necesario para el pseudo-elemento */
}

.cardinfo::after,
.cardinfoName::after,
.cardinfoNameUser::after,
.cardinfoNameYear::after,
.cardinfoGmail::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 10%;
    /* Inicia el borde desde el 10% del ancho */
    width: 80%;
    /* Toma el 80% del ancho del contenedor */
    border-bottom: 1px solid #C6FF41;
    /* Color del borde */
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
    background-color: rgba(0, 0, 0, 0.6);
    /* fondo oscurecido */
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
    background-color: #FFFCA8;
    padding: 16px 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-weight: bold;
    font-size: 18px;
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
    background-color: #FFFCA8;
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
    border-radius: 25px;
    color: black;
}

.Editar {
    background-color: #C9FFFF;
}

.Eliminar {
    background-color: red;
}

.tablaEstadistica {
    display: flex;
    width: 80%;
    height: auto;
    min-height: 200px;
    flex-direction: row;
    align-items: center;
    justify-content: space-around;
    border: solid 1px pink;
    padding: 5px;
}

.tablaEstadisticaParticipados,
.tablaEstadisticaGanados {
    width: 45%;
    height: 400px;
    display: flex;
    border: solid 1px #C6FF41;
    color: white;
    justify-content: center;
    align-items: center;
}

@media (max-width: 1050px) {
    .tablaEstadistica {
        flex-direction: column;
    }

    .tablaEstadisticaParticipados,
    .tablaEstadisticaGanados {
        width: 95%;
    }

    .cardinfoName {
        width: 80%;
        flex-direction: column;
        height: 250px;
    }

    .cardinfoNameUser,
    .cardinfoNameYear {
        width: 100%;
        height: 150px;
        text-align: center;
    }

    .cardinfoGmail {
        height: 100px;
    }

    .cardheader {
        justify-content: center;
    }

    .headerpart1 {
        width: 100%;
    }

    .Editar,
    .Eliminar {
        width: 30%;
    }

    .cardcontainer {
        flex-direction: column;
        height: auto;
        /* Permite que crezca con el contenido */
        min-height: 200px;
        /* Asegura un tamaño mínimo */
    }

    .cardUser,
    .cardinfo {
        width: 100%;
        height: auto;
        margin-top: 7.5px;
        margin-bottom: 7.5px;
    }
}
</style>
