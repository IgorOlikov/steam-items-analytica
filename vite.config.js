import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
import vueJsx from "@vitejs/plugin-vue-jsx";
import { fileURLToPath, URL } from 'node:url'

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        vue(),
        vueJsx(),
    ],
    resolve: {
        alias: {
            '@': fileURLToPath(new URL('./resources/js/src', import.meta.url))
        }
    }
});
