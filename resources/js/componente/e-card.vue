<template>
    <div>
        <div v-if="eventos.length" class="container">
            <div v-for="evento in eventos" :key="evento.id_evento" class="card">
                <h5 class="card-header">{{  evento.nombre }}</h5>
                <div class="card-body">
                    <h5 class="card-title">{{ evento.Fecha_inicio }} / {{ evento.Fecha_fin }}</h5>
                    <p class="card-text">{{ evento.descripcion }}</p>
                    <p class="card-text">Plataforma</p>
                    <p class="card-text">Espacio</p>
                    <p class="card-text">Participantes</p>
                    <a href="#" class="btn btn-primary">Participar</a>
                </div>
            </div>
        </div>
        <div v-else>
            <p>No hay eventos disponibles para este juego.</p>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        juegoId: Number,
        eventos: Array
    },
}
</script>

<style scoped>
.card {
    background-color: #23023b;
    color: white;
    padding: 20px;
    border-radius: 10px;
    margin: 10px;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
}
.card-header {
    font-size: 18px;
    font-weight: bold;
    color: #c6ff41;
}
.card-body {
    text-align: center;
}
.card-text{
    font-family: "Exo 2";
}
.btn-primary {
    background-color: #20f4ff;
    color: #23023b;
    padding: 10px 15px;
    border-radius: 5px;
    text-decoration: none;
    transition: background 0.3s ease;
}
.btn-primary:hover {
    background-color: #c6ff41;
}
</style>
