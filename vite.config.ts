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
			postcss: [
				tailwindcss(),
				autoprefixer(),
			],
		}),
	],
    resolve: {
        alias: {
            'ziggy': '/vendor/tightenco/ziggy/src/js',
            'ziggy-vue': '/vendor/tightenco/ziggy/src/js/vue',
        },
    },
})
