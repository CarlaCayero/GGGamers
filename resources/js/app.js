import './bootstrap';
import * as bootstrap from 'bootstrap';

import { createApp } from 'vue';
import PruebaVue from './componente/prueba.vue';
import TablaJuegos from './componente/PruebaApi.vue';
import paginaTorneos  from './componente/paginaTorneos.vue';
import mapa from './componente/mapa.vue'

const app = createApp({});

app.component('prueba', PruebaVue);
app.component('tabla-juegos', TablaJuegos);
app.component('pagina-torneos', paginaTorneos);
app.component('mapa', mapa);

app.mount('#app');
