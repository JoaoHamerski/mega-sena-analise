import { ZiggyVue } from '../../../vendor/tightenco/ziggy/dist/vue.m';

/**
 * "route" and "Ziggy" global variables
 * are provided by Laravel main view layout (@/views/app.blade.php)
 * with @routes directive
 */
export const useZiggyPlugin = (app) => {
  app.use(ZiggyVue, Ziggy) // eslint-disable-line
}