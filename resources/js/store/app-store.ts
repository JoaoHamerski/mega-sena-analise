import { defineStore } from 'pinia'
import { ref } from 'vue'

export const useAppStore = defineStore('app', () => {
  const heatMap = ref(false)

  const setHeatMap = (value: boolean) => {
    heatMap.value = value
  }

  return {
    heatMap,
    setHeatMap
  }
})
