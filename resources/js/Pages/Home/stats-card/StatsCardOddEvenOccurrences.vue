<script setup>
import axios from '@/plugins/axios'
import { watch, onMounted, ref, inject } from 'vue';
import { formatNumber } from '@/formatters/format-number'

const emit = defineEmits(['update:loading'])
const data = ref({odd: null, even: null})
const { month } = inject('month')

const fetchData = async () => {
  emit('update:loading', true)

  const { data: response } = await axios.get(route('stats.odd-even-occurrences'), {
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
  <div v-auto-animate>
    <div
      v-if="data.even !== null"
      class="flex justify-between"
    >
      <div>
        <b>PARES: </b> {{ formatNumber(data.even) }}
      </div>
      <div>
        <b>ÍMPARES: </b> {{ formatNumber(data.odd) }}
      </div>
    </div>
  </div>
</template>
