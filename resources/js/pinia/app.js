import { defineStore } from 'pinia'

export const useAppStore = defineStore('app', {
    state: () => ({
      route: route(),
    }),
    actions: {
      setCurrentRoute () {
        this.route = route()
      }
    }
})
