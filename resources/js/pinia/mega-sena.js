import { replaceState } from '@/utils/replace-state'
import { defineStore } from 'pinia'

export const useMegaSenaStore = defineStore('mega-sena', {
    state: () => ({
      selectedGame: null,
      heatmap: route().params.heatmap == 'true',
    }),
    actions: {
      setSelectedGame (game) {
        this.selectedGame = game
      },
      setHeatmap (value) {
        this.heatmap = value
        replaceState({heatmap: value})
      }
    }
})
