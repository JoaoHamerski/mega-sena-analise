<script setup>
import { computed } from 'vue';

const props = defineProps({
    heatmap: {
        type: Boolean,
        default: false
    },
    number: {
        type: Object,
        required: true
    }
})

const bgColor = computed(() => {
  const relativeOccurrence = props.number.relative_occurrences > 70 ? 70 : props.number.relative_occurrences

  const value = (100 - relativeOccurrence)

  if (!props.heatmap) {
    return 'rgb(255, 255, 255)'
  }

  return `hsl(0, 55%, ${value}%)`
})

const bgIsDark = computed(() => props.heatmap && props.number.relative_occurrences > 35)

const textColor = computed(() => {
    if (bgIsDark.value) {
        return 'rgb(255, 255, 255)'
    }

    return 'rgb(0, 0, 0)'
})
</script>

<template>
  <div
    class="px-4 py-2 text-center rounded border border-slate-500 transition-colors w-16"
    :style="{backgroundColor: bgColor}"
  >
    <div
      class="text-xl font-bold transition-colors"
      :style="{color: textColor}"
    >
      {{ number.number }}
    </div>
    <div
      class="text-grey transition-colors"
      :style="{color: textColor}"
    >
      {{ number.occurrences }}
    </div>
  </div>
</template>