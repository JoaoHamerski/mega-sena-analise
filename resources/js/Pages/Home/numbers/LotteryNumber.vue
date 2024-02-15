<script setup lang="ts">
import type { Number } from '@/types'
import { useAppStore } from '@/store/app-store'
import { computed } from 'vue'

type LotteryNumber = {
  number: Number
}

const props = defineProps<LotteryNumber>()

const appStore = useAppStore()

const heatMapEnabled = computed(() => appStore.heatMap)

const bgColor = computed(() => {
  const MAX_DARKNESS = 80
  const relativeOccurrence = props.number.relative_occurrence

  const darkness = relativeOccurrence > MAX_DARKNESS ? MAX_DARKNESS : relativeOccurrence
  const lightness = 100 - darkness

  return `hsl(0, 55%, ${lightness}%)`
})

const classes = computed(() => {
  const classes = []

  if (props.number.relative_occurrence > 45 && heatMapEnabled.value) {
    classes.push('text-base-100')
  }

  return classes
})

const style = computed(() => {
  if (heatMapEnabled.value) {
    return {
      backgroundColor: bgColor.value
    }
  }

  return {}
})
</script>

<template>
  <div
    class="border-2 h-[4.5rem] rounded flex flex-col justify-center items-center transition-colors"
    :class="classes"
    :style="style"
  >
    <span class="font-bold text-lg">{{ number.number }}</span>
    <span class="text-xs">
      {{ number.occurrences }}
    </span>
  </div>
</template>
