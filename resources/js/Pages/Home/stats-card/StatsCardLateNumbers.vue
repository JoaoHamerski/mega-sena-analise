<script setup>
import { computed, onMounted, watch, ref } from 'vue';
import { usePage } from '@inertiajs/vue3';
import axios from '@/plugins/axios';
import { sortBy } from 'lodash-es'

import StatsCardLateNumbersList from './StatsCardLateNumbersList.vue';
import StatsCardLateNumbersForm from './StatsCardLateNumbersForm.vue';

const emit = defineEmits(['update:loading'])

const form = ref({interval: '60', sort: false})
const data = ref({late_numbers: [], interval: ''})
const originalData = ref({late_numbers: [], interval: ''})

const queryMonth = computed(() => usePage().props.query.month)

const fetchData = async () => {
  emit('update:loading', true)

  const { data: response } = await axios.get(route('stats.late-numbers'), {
    params: {
      interval: form.value.interval
    }
  })

  Object.assign(data.value, {...response})
  Object.assign(originalData.value, {...response})

  sortNumbers(form.value.sort)

  emit('update:loading', false)
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

watch(queryMonth, () => { fetchData() })
</script>

<template>
  <div>
    <AppContainer>
      <template #title>
        Atrasados há mais de {{ data.interval || 'X' }} dias
      </template>

      <template #content>
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
  </div>
</template>

