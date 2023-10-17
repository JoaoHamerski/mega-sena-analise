<script setup>
import { formatDateTime } from '@/formatters/format-datetime'

import BallNumber from '../partials/BallNumber.vue'

defineProps({
  result: {
    type: Object,
    required: true
  },
  active: {
    type: Boolean,
    default: false
  }
})

</script>

<template>
  <div
    :class="{
      'bg-emerald-600': active,
      'hover:bg-gray-300 active:bg-gray-400': !active
    }"
    class=" p-5 transition-colors cursor-pointer"
  >
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
        style-name="circle"
      >
        <template #default="{ number }">
          <b>{{ number }}</b>
        </template>
      </BallNumber>
    </div>
  </div>
</template>
