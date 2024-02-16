import { defineStore } from 'pinia'
import { ref } from 'vue'

export const useAppStore = defineStore('app', () => {
  const heatMap = ref(false)
  const sortByOccurrences = ref(false)

  const setHeatMap = (value: boolean) => {
    heatMap.value = value
  }

  const setSortByOccurrences = (value: boolean) => {
    sortByOccurrences.value = value
  }

  return {
    heatMap,
    sortByOccurrences,
    setHeatMap,
    setSortByOccurrences
  }
})
