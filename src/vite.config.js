import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import commonjs from 'rollup-plugin-commonjs';

export default defineConfig({
    envDir: './resources/js',
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
    build: {
        rollupOptions: {
            plugins: [
                commonjs(),
            ]
        },
    },
});
