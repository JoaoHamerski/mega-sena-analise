import { App, Plugin } from "vue";
import { ZiggyVue } from "../../../vendor/tightenco/ziggy/dist/vue.m";
import { createPinia } from 'pinia'
import { autoAnimatePlugin } from '@formkit/auto-animate/vue'

export default class Bootstrap {
    protected app: App

    constructor(app: App) {
        this.app = app
    }

    mount(el: Element) {
        this.app.mount(el)
    }

    addInertiaPlugin(plugin: Plugin) {
        this.app.use(plugin)

        return this
    }

    addZiggy() {
        this.app.use(ZiggyVue)

        return this
    }

    addPinia() {
        const pinia = createPinia()

        this.app.use(pinia)

        return this
    }

    addAutoAnimate() {
        this.app.use(autoAnimatePlugin)

        return this
    }

    addGlobalComponents() {
        const components = import.meta.glob('../**/App*.vue', { eager: true })

        Object.entries(components).forEach(([path, definition]: [string, any]) => {
          const componentName = path
            .split('/')
            .pop()!
            .replace(/\.\w+$/, '')

          this.app.component(componentName, definition.default)
        })

        return this
      }
}
