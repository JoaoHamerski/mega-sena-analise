<script setup>
import { formatDateTime } from '@/formatters/format-datetime';
import { inject } from 'vue';

import BallNumber from '../partials/BallNumber.vue';

defineProps({
  numbers: {
    type: Array,
    default: () => []
  }
})

const dataTipFor = (item) => `Concurso: ${item.game.concurso} - ${formatDateTime(item.game.date)}`

const { heatmap } = inject('heatmap')
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
      :heatmap="heatmap"
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
