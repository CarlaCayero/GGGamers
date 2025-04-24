<template>
    <div class="centro">
        <div v-if="eventos.length"
            class="container d-flex flex-wrap justify-content-center align-items-center min-vh-100">
            <div v-for="evento in eventos" :key="evento.id_evento" class="card">
                <h5 class="card-header text-center">{{ evento.nombre }}</h5>
                <div class="card-body">
                    <h5 class="card-title text-cente">{{ evento.fecha_inicio }} / {{ evento.fecha_fin }}</h5>
                    <p class="card-text">{{ evento.descripcion }}</p>
                    <p class="card-text">{{ getEspacioNombre(evento.espacios_id_espacio) }}</p>
                    <button @click="abrirModal(evento)" class="btn btn-primary w-100">Participar</button>
                </div>
            </div>
        </div>
        <div v-else class="text-center">
            <p class="alert alert-warning text-center">No hay eventos disponibles para este juego.</p>
        </div>
        <!-- Modal -->
        <div v-if="mostrarModal" class="modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">Introduce tu correo electrónico</h3>
                    </div>
                    <div class="modal-body">
                        <input type="email" v-model="correoUsuario" placeholder="Correo electrónico" class="form-control" />
                    </div>

                    <div class="modal-footer">
                        <button @click="enviarQR" class="btn btn btn-secondary">Enviar</button>
                        <button @click="cerrarModal" class="btn btn-danger">Cancelar</button>
                    </div>
                </div>
            </div>
        </div>
        <div v-if="mostrarConfirmacion" class="modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">¡Gracias por participar!</h3>
                    </div>
                    <div class="modal-body">
                        <p>Te hemos enviado un correo con tu código QR.</p>
                    </div>

                    <div class="modal-footer">
                        <button @click="cerrarConfirmacion" class="btn btn btn-secondary">Aceptar</button>

                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import QRCode from "qrcode";


export default {
    props: {
        juegoID: Number,
        eventos: Array,
    },
    data() {
        return {
            espacios: [],
            qrCode: '',
            qrEventoId: null,
            mostrarModal: false,
            correoUsuario: '',
            eventoSeleccionado: null,
            mostrarConfirmacion: false,
        };
    },
    methods: {
        FetchEspacios() {
            axios.get("espacios")
                .then(response => {
                    this.espacios = response.data;
                })
                .catch(error => {
                    console.error("Error al cargar los datos:", error);
                });
        },
        getEspacioNombre(idEspacio) {
            const espacio = this.espacios.find(esp => esp.id_espacio === idEspacio);
            return espacio ? espacio.nombre : 'Desconocido';
        },
        abrirModal(evento) {
            console.log("Abriendo modal para evento:", evento);
            this.eventoSeleccionado = evento; // Guarda el evento seleccionado
            this.mostrarModal = true; // Muestra el modal
        },
        cerrarModal() {
            this.mostrarModal = false; // Oculta el modal
            this.correoUsuario = ''; // Limpia el correo ingresado
        },
        cerrarConfirmacion() {
        this.mostrarConfirmacion = false;
        },
        enviarQR() {
            if (!this.correoUsuario) {
                alert("Por favor, introduce un correo electrónico válido.");
                return;
            }

            const evento = this.eventoSeleccionado;
            const qrData = `
                Nombre del Evento: ${evento.nombre}
                Fecha: ${evento.fecha_inicio} - ${evento.fecha_fin}
                Descripción: ${evento.descripcion}
                Espacio: ${this.getEspacioNombre(evento.espacios_id_espacio)}
            `;

            QRCode.toDataURL(qrData)
                .then(url => {
                    console.log('QR Code generado:', url);
                    this.qrCode = url;
                    this.qrEventoId = evento.id_evento;

                    // Enviar el QR por correo
                    axios.post('/enviar-qr', {
                        qrCode: url,
                        evento: {
                            nombre: evento.nombre,
                            descripcion: evento.descripcion,
                            fecha_inicio: evento.fecha_inicio,
                            fecha_fin: evento.fecha_fin,
                        },
                        email: this.correoUsuario
                    })
                        .then(response => {
                            this.cerrarModal();
                            this.mostrarConfirmacion = true;
                        })
                        .catch(error => {
                            console.error('Error al enviar el correo:', error.response ? error.response.data : error);
                        });

                    console.log('Datos enviados al backend:', {
                        qrCode: url,
                        evento: {
                            nombre: evento.nombre,
                            fecha_inicio: evento.fecha_inicio,
                            fecha_fin: evento.fecha_fin,
                            descripcion: evento.descripcion,
                        },
                        email: this.correoUsuario
                    });
                })
                .catch(error => {
                    console.error("Error al generar el código QR:", error);
                });
        }
    },
    created() {
        this.FetchEspacios();
    }
};
</script>

<style scoped>

h3 {
    color: white;
}
.centro {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    width: 100vw;
}

.container {
    display: grid; /* Cambia a un diseño de cuadrícula */
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); /* Máximo 3 columnas */
    gap: 20px; /* Espaciado entre tarjetas */
    width: 100%;
    padding: 20px;
    box-sizing: border-box;
}

.card {
    background-color: #23023b;
    color: white;
    padding: 20px;
    border-radius: 10px;
    border: #c6ff41 3px solid;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
    text-align: center;
}

.card-header {
    font-size: 18px;
    font-weight: bold;
    color: #c6ff41;
}

.card-body {
    text-align: center;
}

.card-text,
.card-title {
    font-family: "Exo 2";
}

.btn-primary {
    background-color: #20f4ff;
    color: #23023b;
    padding: 10px 15px;
    border-radius: 5px;
    text-decoration: none;
}

.btn-primary:hover {
    background-color: #c6ff41;
}

.modal-body img {
    width: 60px;
    height: 60px;
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
.modal-content {
    display: flex;
    flex-direction: column;

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
</style>
