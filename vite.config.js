import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import fs from 'fs'; 

const hasSsl = fs.existsSync('C:/laragon/etc/ssl/laragon.key');

export default defineConfig({
    server: {
        cors: true,
        host: 'controle-academico-estatistico.dev',
        hmr: { host: 'controle-academico-estatistico.dev' }, 
        ...(hasSsl && {
            https: {
                key: 'C:/laragon/etc/ssl/laragon.key',
                cert: 'C:/laragon/etc/ssl/laragon.crt',
            }
        }),
    },
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: [
                'resources/css/**',
                'resources/js/**',
                'resources/views/**',
                'app/Livewire/**',
                'app/Livewire/Volt/**', 
            ],
        }),
    ],
    build: {
        sourcemap: false, 
    },
});
