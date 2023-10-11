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
  },
  customStyle: {
    type: String,
    default: ''
  }
})

const SMALL_STYLE_CLASS = 'rounded-full border border-black p-2 w-10 h-10'
const DEFAULT_STYLE_CLASS = 'rounded border border-slate-500 px-4 py-2 w-16'

const classNames = computed(() => {
  const classes = []

  if (props.customStyle) {
    classes.push(props.customStyle)
  } else {
    classes.push(props.smallStyle ? SMALL_STYLE_CLASS : DEFAULT_STYLE_CLASS)
  }

  return classes
})

const heatmapBg = computed(() => {
  const MAX_DARKNESS = 80
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
    :class="classNames"
    :style="{
      backgroundColor: bgColor,
      color: textColor
    }"
  >
    <slot v-bind="{textColor, bgColor, number}" />
  </span>
</template>
