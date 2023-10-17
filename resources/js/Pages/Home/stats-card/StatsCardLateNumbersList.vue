<script setup>
import { formatDateTime } from '@/formatters/format-datetime';

import BallNumber from '../partials/BallNumber.vue';

defineProps({
  numbers: {
    type: Array,
    default: () => []
  }
})

const dataTipFor = (item) => `Concurso: ${item.game.concurso} - ${formatDateTime(item.game.date)}`
</script>

<template>
  <div
    v-auto-animate
    class="grid grid-cols-5 gap-2"
  >
    <BallNumber
      v-for="item in numbers"
      :key="item"
      :number="item.number"
      :relative-occurrences="item.relative_occurrences"
      class="tooltip tooltip-left"
      :data-tip="dataTipFor(item)"
      custom-style="border rounded border-slate-600 py-2"
    >
      <template #default="{ number }">
        <span class="font-bold">{{ number }}</span>
        <div class="text-xs">
          {{ item.last_occurrence_in }} jogos
        </div>
      </template>
    </BallNumber>
  </div>
</template>
