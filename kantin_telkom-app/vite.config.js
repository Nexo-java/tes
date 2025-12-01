import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';
import react from '@vitejs/plugin-react'; // ← perhatikan, huruf kecil

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.jsx'], // ubah ke .jsx
            refresh: true,
        }),
        tailwindcss(),
        react(), // ubah dari React() ke react()
    ],
});
