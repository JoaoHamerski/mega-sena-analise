<script setup>
import { formatDateTime } from '@/helpers/format-datetime'
import BallNumber from '../partials/BallNumber.vue'
import { inject } from 'vue';

defineProps({
  result: {
    type: Object,
    required: true
  }
})

const { heatmap } = inject('heatmap')
</script>

<template>
  <div class="text-sm font-bold mb-2 flex justify-between">
    <span>{{ result.concurso }}</span>
    <span>{{ formatDateTime(result.date) }}</span>
  </div>
  <div class="grid grid-cols-6 gap-2 text-center">
    <BallNumber
      v-for="i in 6"
      :key="`${result.id}_${i}`"
      :number="result[`bola_${i}`].number"
      :relative-occurrences="result[`bola_${i}`].relative_occurrences"
      :heatmap="heatmap"
      small-style
    >
      <template #default="{ number }">
        <b>{{ number }}</b>
      </template>
    </BallNumber>
  </div>
</template>
