<script setup>
import { onMounted, watch, ref, inject } from 'vue';
import axios from '@/plugins/axios';
import { sortBy } from 'lodash-es'

import StatsCardLateNumbersList from './StatsCardLateNumbersList.vue';
import StatsCardLateNumbersForm from './StatsCardLateNumbersForm.vue';

const loading = ref(false)
const form = ref({interval: '60', sort: false})
const data = ref({late_numbers: [], interval: ''})
const originalData = ref({late_numbers: [], interval: ''})
const { month } = inject('month')

const fetchData = async () => {
  loading.value = true

  const { data: response } = await axios.get(route('stats.late-numbers'), {
    params: {
      interval: form.value.interval
    }
  })

  Object.assign(data.value, {...response})
  Object.assign(originalData.value, {...response})

  sortNumbers(form.value.sort)

  loading.value = false
}

const onSortChange = (value) => {
  form.value.sort = value

  sortNumbers(value)
}

const sortNumbers = (value) => {
  data.value.late_numbers = value
    ? sortBy(data.value.late_numbers, 'last_occurrence_in').reverse()
    : originalData.value.late_numbers
}



onMounted(() => { fetchData() })

watch(month, () => { fetchData() })
</script>

<template>
  <AppContainer class="">
    <template #title>
      Atrasados há mais de {{ data.interval || 'X' }} dias
    </template>
    <template #content>
      <AppLoading :value="loading" />
      <StatsCardLateNumbersForm
        v-model:interval="form.interval"
        @update:sort="onSortChange"
        @form:submit="fetchData"
      />
      <StatsCardLateNumbersList
        :numbers="data.late_numbers"
      />
      <div class="text-gray-600 text-xs mt-4">
        Números com última recorrência por intervalo de dias.
      </div>
    </template>
  </AppContainer>
</template>

