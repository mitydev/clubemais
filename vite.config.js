import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/css/default.css',
                'resources/css/pages/parceiros.css',
                'resources/css/pages/o-que-e.css',
            ],
            refresh: true,
        }),
    ],
});
