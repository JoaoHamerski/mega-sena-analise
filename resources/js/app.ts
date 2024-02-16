import '../css/main.css'
import './libs/fontawesome'

import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'
import Bootstrap from './bootstrap/bootstrap'
import BootstrapPage from './bootstrap/bootstrap-page'

createInertiaApp({
  title: BootstrapPage.resolveTitle,
  resolve: BootstrapPage.resolvePage,
  setup({ el, App, props, plugin }) {
    const app = createApp({ render: () => h(App, props) })
    const bootstrap = new Bootstrap(app)

    bootstrap
      .addInertiaPlugin(plugin)
      .addZiggy()
      .addGlobalComponents()
      .addPinia()
      .addAutoAnimate()
      .addFontAwesome()
      .mount(el)
  },
  progress: {
    color: '#4B5563'
  }
})
