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
  }
})

const heatmapBg = (relativeOccurrences) => {
  const MAX_DARKNESS = 70
  const relativeForHeatmap = relativeOccurrences > MAX_DARKNESS
    ? MAX_DARKNESS
    : relativeOccurrences

    const lightness = (100 - relativeForHeatmap)

    return `hsl(0, 55%, ${lightness}%)`
}

const bgIsDark = computed(() => props.heatmap && props.relativeOccurrences > 35)
const textColor = computed(() => bgIsDark.value ? 'rgb(255, 255, 255)' : 'rgb(0, 0, 0)')
const bgColor = computed(() => !props.heatmap
  ? 'rgb(255, 255, 255)'
  : heatmapBg(props.relativeOccurrences)
)
</script>

<template>
  <span
    class="transition-colors"
    :style="{
      backgroundColor: bgColor,
      color: textColor
    }"
  >
    <slot v-bind="{textColor, bgColor, number}" />
  </span>
</template>
