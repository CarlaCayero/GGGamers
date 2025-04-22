<template>
    <div class="cardContainer">
        <div class="cardheader">
        </div>

        <div class="cardcontainer">
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

                <div class="cardButton">
                    <div class="Editar" @click="abrirModal('editar')">Editar</div>
                    <div class="Eliminar" @click="abrirModal('eliminar')">Eliminar</div>
                </div>
            </div>

        </div>
    </div>
    <h1>Estadistica</h1>
    <div class="tablaEstadistica">
        <div class="tablaEstadisticaParticipados">
            <h1>Torneos Participado</h1>
            <canvas v-if="NoParticipadosEventos == false" id="graficoParticipados"></canvas>
            <div v-else>
                <p>no has participados aun</p>
            </div>
        </div>
        <div class="tablaEstadisticaGanados">
            <h1>Torneos Ganados</h1>
            <canvas v-if="NoTorneosGanados == false" id="graficoGanados"></canvas>
            <div v-else>
                <p>no has Ganado aun</p>
            </div>
        </div>
    </div>
    <div class="ResultadosFinal">
        <div class="ResultadoFinalTexto">
            <h1>Tus resultados</h1>
            <p>
                Has participado en batallas, torneos, y desafíos... algunos ganados, otros solo vividos.
                Tu rendimiento ha sido evaluado, y con base en tus victorias y participaciones, hemos calculado tu
                probabilidad de ser el próximo campeón supremo.
                ¿Curioso por saber tu destino?
                <strong>Abre el libro y descubre tu recompensa.</strong>
            </p>
            <button class="btn btn-info mt-3" @click="abrirModal('explicacion')">
                ¿Qué significa cada imagen?
            </button>
        </div>

        <div class="ResultadoFinalLibro">
            <card-resultado :probabilidad="probabilidadGanar"></card-resultado>
        </div>
    </div>
    <div class="modal" v-if="mostrarModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title">
                        {{ modalType === 'editar' ? 'Editar Usuario' : modalType === 'eliminar' ? 'Eliminar Usuario' :
                        'Significado de las imágenes' }}
                    </h1>
                    <button type="button" class="close" @click="cerrarModal">
                        <span>&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <!-- Editar -->
                    <div v-if="modalType === 'editar'">
                        <label>Nombre:</label>
                        <input v-model="MiUsuarioEditado.nombre" type="text" />
                        <label>Email:</label>
                        <input v-model="MiUsuarioEditado.mail" type="email" />
                        <label>Edad:</label>
                        <input v-model="MiUsuarioEditado.edad" type="number" />
                    </div>

                    <!-- Eliminar -->
                    <div v-else-if="modalType === 'eliminar'">
                        ¿Estás seguro de que deseas eliminar al usuario
                        <strong>{{ MiUsuario.nombre }}</strong>?
                    </div>

                    <!-- Explicación de imágenes -->
                    <div v-else-if="modalType === 'explicacion'">
                        <ul>
                            <li>
                                <img :src="Imagen1" />
                                Tus posibilidades son escasas... pero incluso un 1% es suficiente para cambiar el
                                destino.
                            </li>
                        </ul>
                        <ul>
                            <li>
                                <img :src="Imagen2" />
                                No será fácil, pero si sigues luchando, podrías dar la sorpresa que nadie espera.
                            </li>
                        </ul>
                        <ul>
                            <li>
                                <img :src="Imagen3" />
                                Tienes una oportunidad real. No subestimes lo que eres capaz de lograr.
                            </li>
                        </ul>
                        <ul>
                            <li>
                                <img :src="Imagen4" />
                                Estás en la cima de tu forma. ¡Tu victoria está al alcance de la mano!
                            </li>
                        </ul>
                        <ul>
                            <li>
                                <img :src="Imagen5" />
                                ¡Es prácticamente tuyo! El título de campeón te espera. Solo falta que lo reclames.
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="modal-footer">
                    <button v-if="modalType === 'editar'" class="btn btn-info" @click="guardarCambios">
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
import CardResultado from "./cartaResultado.vue";

export default {
    inheritAttrs: false,
    components: {
        CardResultado
    },
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
            NoTorneosGanados: false,
            probabilidadGanar: 0, // Probabilidad de ganar, lo calcularemos
            Imagen1: '../image/ImageResult/catxd.png',
            Imagen2: '../image/ImageResult/catsad.png',
            Imagen3: '../image/ImageResult/catstanding.png',
            Imagen4: '../image/ImageResult/catcat.png',
            Imagen5: '../image/ImageResult/kirbo.jpg',

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
                            this.calcularProbabilidad();
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
            console.log("Eliminando usuario:", this.MiUsuario.id_usuario);
            axios.delete(`usuarios/${this.MiUsuario.id_usuario}`)
                .then(() => {
                    this.cerrarModal();
                    window.location.href = '/GGGamers/public/';

                })
                .catch((error) => {
                    console.error("Error al eliminar:", error);
                });
        },
        calcularProbabilidad() {
            const totalEventos = this.eventosParticipados.length;
            const totalGanados = this.eventosGanados.length;

            if (totalEventos > 0) {
                this.probabilidadGanar = ((totalGanados / totalEventos) * 100).toFixed(2);
            }
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
                                position: 'top',
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
h1 {
    color: white;
}

p {
    color: white;
}

.modal-body img {
    width: 60px;
    height: 60px;
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
    height: 450px;
    display: flex;
    border: solid 2px #C6FF41;
    color: white;
    justify-content: center;
    align-items: center;
    padding: 10px;
}

.cardIcon {
    width: 200px;
    height: 200px;
    border-radius: 100px;
    background-color: #C6FF41;
}


.cardinfo {
    width: 90%;
    height: 100%;
    display: flex;
    align-items: center;
    flex-direction: column;
    text-align: center;
    margin: 5px;
}
.cardButton{
    display: flex;
    width: 90%;
    height: 100px;
    justify-content: space-around;
    align-items: center;
    flex-direction: row;
    margin-top: 20px;
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
    z-index: 20000;
}

.modal-dialog {
    border-radius: 16px;
    width: 90%;
    max-width: 800px;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
    overflow: hidden;
    animation: fadeIn 0.3s ease-out;
}

.modal-header {
    background-color: #23023B;
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
    display: flex;
    justify-content: flex-end;
    gap: 10px;
    background-color: #23023B;
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
    width: 350px;
    height: 70%;
    display: flex;
    justify-content: center;
    align-items: center;
    border-radius: 10px;
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
    padding: 5px;
    margin-top: 20px;
    margin-bottom: 30px;
}

.tablaEstadisticaParticipados,
.tablaEstadisticaGanados {
    width: 45%;
    height: auto;
    display: flex;
    color: white;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    margin-top: 30px;
}

.ResultadosFinal {
    display: flex;
    width: 80%;
    height: auto;
    min-height: 200px;
    justify-content: space-around;
    align-items: center;
    flex-direction: row;
    border: solid black 1px;
    margin: 20px;
}

.ResultadoFinalTexto {
    display: flex;
    width: 50%;
    height: 500px;
    justify-content: center;
    align-items: center;
    text-align: center;
    flex-direction: column;
    padding-left: 10px;
    padding-right: 10px;
    letter-spacing: 2.5px;
}

.ResultadoFinalLibro {
    display: flex;
    width: 40%;
    height: 500px;
    justify-content: center;
    align-items: center;
    border-radius: 25px;
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
        width: 80%;
        height: 40%;
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

    .ResultadosFinal {
        flex-direction: column;
    }

    .ResultadoFinalTexto,
    .ResultadoFinalLibro {
        width: 100%;
    }

    .ResultadoFinalTexto {
        height: auto;
        padding: 10px;
    }

    .cardButton{
        width: 100%;
        height: 300px;
        flex-direction: column;
        justify-content: space-around;
}

}
</style>
