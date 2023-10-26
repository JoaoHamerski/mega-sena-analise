<script setup>
import { formatDateTime } from '@/formatters/format-datetime'
import { computed } from 'vue';

import ResultsCardListItemNumber from './ResultsCardListItemNumber.vue';

const ODD_EVEN_CLASSES = {
  odd: {bgColor: 'bg-yellow-500', color: 'text-yellow-500'},
  even: {bgColor: 'bg-blue-500', color: 'text-blue-500'}
}

const props = defineProps({
  result: {
    type: Object,
    required: true
  },
  active: {
    type: Boolean,
    default: false
  }
})

const oddEven = computed(() => {
  const result = {odd: 0, even: 0}

  props.result.numbers.forEach((num) => {
    if (num % 2 === 0) {
      result.even++
    } else {
      result.odd++
    }
  })

  return result
})
</script>

<template>
  <div
    :class="{
      'bg-emerald-500': active,
      'hover:bg-gray-300 active:bg-gray-400': !active
    }"
    class=" p-5 transition-colors cursor-pointer"
  >
    <div class="text-sm font-bold mb-2 flex justify-between">
      <span>{{ result.concurso }}</span>
      <span
        class="badge badge-outline text-xs"
        :class="{'bg-white': active}"
      >
        <span :class="ODD_EVEN_CLASSES.even.color">{{ oddEven.even }} PAR</span>
        <span class="mx-1">|</span>
        <span :class="ODD_EVEN_CLASSES.odd.color">{{ oddEven.odd }} ÍMPAR</span>
      </span>
      <span>{{ formatDateTime(result.date) }}</span>
    </div>

    <div class="grid grid-cols-6 gap-2 text-center">
      <template
        v-for="i in 6"
        :key="`${result.id}_${i}`"
      >
        <ResultsCardListItemNumber
          :active="active"
          :number="result[`bola_${i}`]"
          :classes="ODD_EVEN_CLASSES"
        />
      </template>
    </div>
  </div>
</template>
