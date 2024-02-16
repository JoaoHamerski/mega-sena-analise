import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers'
import { DefineComponent } from 'vue'

const appName = import.meta.env.VITE_APP_NAME || 'Laravel'

export default class BootstrapPage {
  static resolveTitle(title: string) {
    return `${title} - ${appName}`
  }

  static resolvePage(name: string) {
    return resolvePageComponent(
      `../Pages/${name}.vue`,
      import.meta.glob<DefineComponent>('../Pages/**/*.vue')
    )
  }
}
