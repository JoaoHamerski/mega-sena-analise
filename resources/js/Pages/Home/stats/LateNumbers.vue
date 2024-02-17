<script setup lang="ts">
import { onMounted, ref, computed } from 'vue'
import { LateNumber, LateNumbersResponse } from '@/types'
import LateNumberGrid from './LateNumbersGrid.vue'
import sortBy from 'lodash-es/sortBy'

const responseData = ref<LateNumbersResponse>({ data: [], late_by_days: 0 })
const sortByContests = ref(false)

const lateNumbers = computed<LateNumber[]>(() => {
  const lateNumbers = responseData.value.data

  if (sortByContests.value) {
    return sortBy(lateNumbers, 'late_by_contests').reverse()
  }

  return lateNumbers
})

const lateByDays = computed<number | null>(() => responseData.value.late_by_days)

const fetchLateNumbers = () => {
  fetch(route('api.late-numbers'))
    .then((response) => response.json())
    .then((data: LateNumbersResponse) => {
      responseData.value = data
    })
}

onMounted(() => {
  fetchLateNumbers()
})
</script>

<template>
  <AppContainer>
    <template #title>
      Atrasados
      <template v-if="lateByDays"> há {{ lateByDays }} dias</template>
    </template>

    <template #content>
      <div class="flex flex-col gap-4">
        <AppCheckbox
          v-model="sortByContests"
          label="Ordenar por jogos"
        />
        <LateNumberGrid :late-numbers="lateNumbers" />
      </div>
    </template>
  </AppContainer>
</template>
