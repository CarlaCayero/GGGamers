import './bootstrap';
import * as bootstrap from 'bootstrap';

import { createApp } from 'vue';
import PruebaVue from './componente/prueba.vue';
import MyPerfil  from './componente/MyPerfil.vue';
import TablaJuegos from './componente/PruebaApi.vue';
import paginaTorneos  from './componente/paginaTorneos.vue';
import mapa from './componente/mapa.vue'
import eventos from './componente/e-card.vue'

const app = createApp({});

app.component('prueba', PruebaVue);
app.component('tabla-juegos', TablaJuegos);
app.component('pagina-torneos', paginaTorneos);
app.component('mapa', mapa);
app.component('perfil', MyPerfil);
app.component('evento', eventos)

app.mount('#app');

