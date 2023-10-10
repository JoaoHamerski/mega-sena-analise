<script setup>
import { computed } from 'vue';

const props = defineProps({
  number: {
    type: Number,
    required: true
  },
  relativeOccurrences: {
    type: Number,
    required: true
  },
  heatmap: {
    type: Boolean,
    default: false
  },
  smallStyle: {
    type: Boolean,
    default: false
  }
})

const smallStyleClass = 'rounded-full border border-black p-2 w-10 h-10'
const defaultStyleClass = 'px-4 py-2 text-center rounded border border-slate-500 transition-colors w-16'

const heatmapBg = computed(() => {
  const MAX_DARKNESS = 70
  const relativeOccurrences = props.relativeOccurrences
  const relativeForHeatmap = relativeOccurrences > MAX_DARKNESS
    ? MAX_DARKNESS
    : relativeOccurrences

    const lightness = (100 - relativeForHeatmap)

    return `hsl(0, 55%, ${lightness}%)`
})

const bgIsDark = computed(() => props.heatmap && props.relativeOccurrences > 35)

const textColor = computed(() => bgIsDark.value ? 'rgb(255, 255, 255)' : 'rgb(0, 0, 0)')

const bgColor = computed(() => !props.heatmap
  ? 'rgb(255, 255, 255)'
  : heatmapBg.value
)
</script>

<template>
  <span
    class="transition-colors text-center"
    :class="smallStyle ? smallStyleClass : defaultStyleClass"
    :style="{
      backgroundColor: bgColor,
      color: textColor
    }"
  >
    <slot v-bind="{textColor, bgColor, number}" />
  </span>
</template>
