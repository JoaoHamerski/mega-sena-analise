import { replaceState } from '@/utils/replace-state'
import { range } from 'lodash-es'
import { defineStore } from 'pinia'

export const useMegaSenaStore = defineStore('mega-sena', {
    state: () => ({
      selectedGame: null,
      heatmap: route().params.heatmap == 'true',
    }),
    getters: {
      selectedGameNumbers () {
        const numbers = []

        if (!this.selectedGame) {
          return []
        }

        for (const num of range(1, 7)) {
          numbers.push(this.selectedGame[`bola_${num}`]['number'])
        }

        return numbers
      }
    },
    actions: {
      setSelectedGame (game) {
        this.selectedGame = game.id !== this.selectedGame?.id
          ? game
          : null
      },
      setHeatmap (value) {
        this.heatmap = value
        replaceState({heatmap: value})
      }
    }
})
