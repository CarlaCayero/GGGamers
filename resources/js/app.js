import './bootstrap';
import * as bootstrap from 'bootstrap';

import { createApp } from 'vue';
import Carouselmagenes from './componente/Carouselmagenes.vue';
import MyPerfil  from './componente/MyPerfil.vue';
import TablaJuegos from './componente/PruebaApi.vue';
import paginaTorneos  from './componente/paginaTorneos.vue';
import mapa from './componente/mapa.vue'
import eventos from './componente/e-card.vue'
import MyHud from './componente/MyHud.vue'

const app = createApp({});

app.component('Carouselmagenes', Carouselmagenes);
app.component('tabla-juegos', TablaJuegos);
app.component('pagina-torneos', paginaTorneos);
app.component('mapa', mapa);
app.component('perfil', MyPerfil);
app.component('evento', eventos)
app.component('myhud',MyHud)
app.mount('#app');

