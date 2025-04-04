<template>
    <div class="cardContainer">
        <div class="cardheader">
            <h2>Perfil de {{ MiUsuario.nombre }}</h2>
        </div>
        <div class="cardcontainer">
            <div class="cardUser">
                <div class="cardIcon">
                </div>
                <div class="userDetails">
                    <p><strong>Nombre:</strong> {{ MiUsuario.nombre }}</p>
                    <p><strong>Email:</strong> {{ MiUsuario.mail }}</p>
                    <p><strong>Edad:</strong> {{ MiUsuario.edad }}</p>
                    <p><strong>Rol:</strong> {{ MiUsuario.rol ? MiUsuario.rol.nombre : 'No asignado' }}</p>
                </div>
            </div>
            <div class="cardinfo">

            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        userId: Number,
    },
    data() {
        return {
            MiUsuario: {}
        };
    },
    mounted() {
        this.ObtenerElDatosDeUsuarios();
    },
    methods: {
        ObtenerElDatosDeUsuarios() {
            axios.get(`usuarios`, {
                params: {
                    id_usuario: this.userId
                },
            })
            .then((response) => {
                this.MiUsuario = response.data[0];
            })
            .catch((error) => {
                console.error("Error al cargar los datos:", error);
            });
        },
    },
}
</script>

<style scoped>
.cardContainer{
    min-width: 400px;
    max-width: 1100px;
    width: 80%;
    display: flex;
    align-items: center;
    flex-direction: column;
    margin: 20px;
}
.cardheader{
    width: 100%;
    height: 100px;
    background-color:#C6FF41 ;
}
.cardcontainer{
    width: 100%;
    height: 500px;
    background-color:#C9FFFF ;
    display: flex;
}
.cardIcon{
    width: 200px;
    height: 200px;
    border-radius: 100px;
    background-color: #C6FF41;
}
.cardUser{
    width: 30%;
    height: 100%;
    border: solid 1px black;
    display: flex;
    justify-content: space-around;
    align-items: center;
    flex-direction: column;
    text-align: center;
}
.cardinfo{
    width: 70%;
    height: 100%;
    display: flex;
    justify-content: center;
    align-content: center;
    flex-direction: column;
    border: solid 1px rgb(255, 0, 0);
}
</style>
