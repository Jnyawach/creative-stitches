import { defineConfig } from 'vite'
import tailwindcss from 'tailwindcss'
import autoprefixer from 'autoprefixer'
import laravel from 'vite-plugin-laravel'
import vue from '@vitejs/plugin-vue'
import inertia from './resources/scripts/vite/inertia-layout'
// @ts-ignore
import { ViteMinifyPlugin } from 'vite-plugin-minify'


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
        ViteMinifyPlugin({}),
	],
    resolve: {
        alias: {
            'ziggy': '/vendor/tightenco/ziggy/src/js',
            'ziggy-vue': '/vendor/tightenco/ziggy/src/js/vue',
        },
    },
})
