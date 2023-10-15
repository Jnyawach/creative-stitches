import { createSSRApp, h } from 'vue'
import { renderToString } from '@vue/server-renderer'
import { createInertiaApp } from '@inertiajs/inertia-vue3'
import createServer from '@inertiajs/server'
import axios from "axios";
axios.defaults.baseURL=import.meta.env.VITE_APP_URL;
import { createPinia } from 'pinia'
createServer((page) => createInertiaApp({
    page,
    render: renderToString,
    resolve: name => require(`./Pages/${name}`),
    setup({ app, props, plugin }) {
        return createSSRApp({
            render: () => h(app, props),
        }).use(plugin)
            .use(createPinia())
            .mixin({ methods: { route: window.route } })
    },
}))
