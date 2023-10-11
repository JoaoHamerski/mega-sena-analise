import '../css/app.scss';

import { createApp } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolveComponent } from '@/plugins/inertia'
import { createPinia } from 'pinia';
import { registerGlobalComponents } from './components';
import { useZiggyPlugin } from '@/plugins/ziggy'
import { autoAnimatePlugin } from '@formkit/auto-animate/vue'
import { useFontawesomePlugin } from './plugins/fontawesome';

const pinia =  createPinia()

const usePlugins = (app, inertiaPlugin) => {
    registerGlobalComponents(app)
    useZiggyPlugin(app)
    useFontawesomePlugin(app)

    app.use(inertiaPlugin)
        .use(pinia)
        .use(autoAnimatePlugin)
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
