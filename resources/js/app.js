import './bootstrap';
import '../css/app.scss';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';
import { resolveComponent } from '@/plugins/inertia'
import { createPinia } from 'pinia';
import { registerGlobalComponents } from './components';
import { useZiggyPlugin } from '@/plugins/ziggy'

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';
const pinia =  createPinia()

const usePlugins = (app, inertiaPlugin) => {
    registerGlobalComponents(app)

    useZiggyPlugin(app)

    app.use(inertiaPlugin)
        .use(pinia)
}

createInertiaApp({
    title: (title) => title ? `${title} - Mega Sena Análise` : 'Mega Sena Análise',
    resolve: resolveComponent,
    setup({ el, App, props, plugin }) {
        const app = createApp(App, props)

        usePlugins(app, plugin)

        return app.mount(el)
    },
    progress: {
        color: '#4B5563',
    },
});
