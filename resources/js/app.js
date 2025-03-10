import './bootstrap';
import * as bootstrap from 'bootstrap';

import { createApp } from 'vue';
import PruebaVue from './componente/prueba.vue';

// Crear la app con un objeto
const app = createApp({});

// Registrar el componente
app.component('prueba', PruebaVue);

// Montar Vue correctamente
app.mount('#app');
