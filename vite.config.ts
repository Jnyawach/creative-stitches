import { defineConfig } from 'vite'
import tailwindcss from 'tailwindcss'
import autoprefixer from 'autoprefixer'
import laravel from 'vite-plugin-laravel'
import vue from '@vitejs/plugin-vue'
import inertia from './resources/scripts/vite/inertia-layout'




export default defineConfig({
	plugins: [
		inertia(),
		vue(),

		laravel({
            input: ['resources/css/tailwind.css', 'resources/scripts/main.ts'],
            ssr: 'resources/scripts/ssr.js',
            refresh: true,
		}),



	],
    resolve: {
        alias: {
            'ziggy': '/vendor/tightenco/ziggy/src/js',
            'ziggy-vue': '/vendor/tightenco/ziggy/src/js/vue',
        },
    },
    ssr: {
        noExternal: ['@inertiajs/server'],
    },

})
