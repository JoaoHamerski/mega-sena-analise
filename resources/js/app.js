import './bootstrap';
import '../css/app.scss';

import { createApp } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolveComponent } from '@/plugins/inertia'
import { createPinia } from 'pinia';
import { registerGlobalComponents } from './components';
import { useZiggyPlugin } from '@/plugins/ziggy'

const pinia =  createPinia()

const usePlugins = (app, inertiaPlugin) => {
    registerGlobalComponents(app)

    useZiggyPlugin(app)

    app.use(inertiaPlugin)
        .use(pinia)
}

const title = (title) => title 
    ? `${title} - Mega Sena Análise`
    : "Mega Sena Análise"

const setup = ({el, App, props, plugin}) => {
    const app = createApp(App, props)

    usePlugins(app, plugin)

    return app.mount(el)
}

createInertiaApp({
    title,
    resolve: resolveComponent,
    setup,
    progress: {
        color: '#006aff',
    },
});
