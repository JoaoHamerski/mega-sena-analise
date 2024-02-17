import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import AppCard from './AppCard.vue'
import AppCheckbox from './AppCheckbox.vue'

declare module '@vue/runtime-core' {
  export interface GlobalComponents {
    AppCard: typeof AppCard
    AppCheckbox: typeof AppCheckbox
    FWIcon: typeof FontAwesomeIcon
  }
}
