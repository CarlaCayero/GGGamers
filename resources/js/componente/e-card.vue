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
                    <button @click="generarQR(evento)" class="btn btn-primary w-100">Participar</button>
                </div>
            </div>
        </div>
        <div v-else class="text-center">
            <p class="alert alert-warning text-center">No hay eventos disponibles para este juego.</p>
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
            qrEventoId: null
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
        generarQR(evento) {
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

                    // Obtener el correo del usuario (puedes ajustarlo según tu lógica)
                    const usuarioEmail = prompt("Introduce tu correo electrónico:");

                    // Enviar el QR por correo
                    axios.post('/enviar-qr', {
                        qrCode: url,
                        evento: {
                            nombre: evento.nombre,
                            descripcion: evento.descripcion,
                            fecha_inicio: evento.fecha_inicio,
                            fecha_fin: evento.fecha_fin,
                        },
                        email: usuarioEmail
                    })
                        .then(response => {
                            alert('Correo enviado con éxito.');
                        })
                        .catch(error => {
                            console.error('Error al enviar el correo:', error.response ? error.response.data : error);
                        });

                    // Agrega este log para verificar los datos enviados
                    console.log('Datos enviados al backend:', {
                        qrCode: url,
                        evento: {
                            nombre: evento.nombre,
                            fecha_inicio: evento.fecha_inicio,
                            fecha_fin: evento.fecha_fin,
                            descripcion: evento.descripcion,
                        },
                        email: usuarioEmail
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
.centro {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    width: 100vw;
}

.card {
    background-color: #23023b;
    color: white;
    padding: 20px;
    border-radius: 10px;
    margin: 10px;
    border: #c6ff41 3px solid;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
    width: 300px;
    /* Tamaño fijo para las tarjetas */
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
</style>
