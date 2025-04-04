import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/css/app.scss',
                'resources/js/pablo.js',
                'resources/css/torneos.css',
                'resources/css/nosotros.css',
                'resources/js/nosotros.js',
                'resources/css/auth.css',
                'resources/js/authBgAnimation.js'],
            refresh: true,
        }),
        vue()
    ],
    resolve: {
        alias:{
            'vue': 'vue/dist/vue.esm-bundler.js'
        }
    }


});
