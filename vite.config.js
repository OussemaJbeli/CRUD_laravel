import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/login.css','resources/css/home.css',
                'resources/js/app.js'],
            refresh: true,
        }),
    ],
});
