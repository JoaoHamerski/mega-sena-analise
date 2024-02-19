import { Contest } from '@/types'
import { defineStore } from 'pinia'
import { computed, ref } from 'vue'
import map from 'lodash-es/map'
import pick from 'lodash-es/pick'
import { CONTEST_NUMBER_LABELS } from '@/Pages/Home/contests/contest-number-labels'

const getContestNumbers = (contest: Contest) => {
  const contestNumbers = pick(contest, CONTEST_NUMBER_LABELS)

  return map(contestNumbers, 'number')
}

export const useAppStore = defineStore('app', () => {
  const heatMap = ref(false)
  const selectedContest = ref<Contest | null>(null)

  const selectedContestNumbers = computed(() =>
    selectedContest.value ? getContestNumbers(selectedContest.value) : null
  )

  const setHeatMap = (value: boolean) => {
    heatMap.value = value
  }

  const setSelectedContest = (value: Contest | null) => {
    selectedContest.value = value
  }

  return {
    heatMap,
    setHeatMap,
    selectedContest,
    selectedContestNumbers,
    setSelectedContest
  }
})
