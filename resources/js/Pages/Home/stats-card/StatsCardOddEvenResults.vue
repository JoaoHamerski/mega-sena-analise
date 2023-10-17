<script setup>
import axios from '@/plugins/axios'
import { watch, onMounted, ref, inject } from 'vue';
import { isEmpty } from 'lodash-es';
import StatsCardOddEvenResultsList from './StatsCardOddEvenResultsList.vue'

const emit = defineEmits(['update:loading'])
const data = ref({even_games_count: {}, odd_games_count: {}})
const { month } = inject('month')

const fetchData = async () => {
  emit('update:loading', true)

  const { data: response } = await axios.get(route('stats.odd-even-results'), {
    params: {
      month: month.value || null
    }
  })

  Object.assign(data.value, response)

  emit('update:loading', false)
}

watch(month, () => {
  fetchData()
})

onMounted(() => {
  fetchData()
})
</script>

<template>
  <div
    v-auto-animate
  >
    <StatsCardOddEvenResultsList
      v-if="!isEmpty(data.even_games_count)"
      :data="data"
    />
  </div>
</template>
