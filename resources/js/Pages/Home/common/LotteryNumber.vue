<script setup lang="ts">
import type { Number } from '@/types'
import { useAppStore } from '@/store/app-store'
import { type StyleValue, type Component, computed } from 'vue'
import LotteryNumberNormal from './LotteryNumberNormal.vue'
import LotteryNumberCompact from './LotteryNumberCompact.vue'
import LotteryNumberExtended from './LotteryNumberExtended.vue'

type LotteryNumber = {
  number: Number
  type?: 'normal' | 'compact' | 'extended'
}

type ComponentIsProps = {
  is: Component
  attrs: object
  wrapperClass: any
}

const props = withDefaults(defineProps<LotteryNumber>(), {
  type: 'normal'
})

const appStore = useAppStore()

const heatMapEnabled = computed(() => appStore.heatMap)
const isSorted = computed(() => appStore.sortByOccurrences)

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

const style = computed<StyleValue>(() => {
  if (!heatMapEnabled.value) {
    return {}
  }

  return {
    backgroundColor: bgColor.value
  }
})

const component = computed<ComponentIsProps>(() => {
  if (props.type === 'extended') {
    return {
      is: LotteryNumberExtended,
      wrapperClass: '',
      attrs: {}
    }
  }

  if (props.type === 'compact') {
    return {
      is: LotteryNumberCompact,
      wrapperClass: 'p-2 flex items-center justify-center border-2 rounded-full w-10 h-10 text-sm',
      attrs: {
        number: props.number
      }
    }
  }

  return {
    is: LotteryNumberNormal,
    wrapperClass: 'w-auto flex flex-col border-2 rounded justify-center items-center h-16',
    attrs: {
      number: props.number,
      isSorted: isSorted.value
    }
  }
})
</script>

<template>
  <div
    :style="style"
    :class="[classes, component.wrapperClass]"
    class="transition-colors"
  >
    <Component
      :is="component.is"
      v-bind="component.attrs"
    />
  </div>
</template>
