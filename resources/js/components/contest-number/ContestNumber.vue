<script setup lang="ts">
import type { LateNumber, Number } from '@/types'
import { useAppStore } from '@/store/app-store'
import { type StyleValue, type Component, computed } from 'vue'
import ContestNumberNormal from './ContestNumberNormal.vue'
import ContestNumberCompact from './ContestNumberCompact.vue'
import ContestNumberExtended from './ContestNumberExtended.vue'

type ContestNumber = {
  number: Number | LateNumber
  type?: 'normal' | 'compact' | 'extended'
}

type ComponentAttrs = {
  is: Component
  attrs: object
  wrapperClass: any
}

const props = withDefaults(defineProps<ContestNumber>(), {
  type: 'normal'
})

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

const style = computed<StyleValue>(() => {
  if (!heatMapEnabled.value) {
    return {}
  }

  return {
    backgroundColor: bgColor.value
  }
})

const component = computed<ComponentAttrs>(() => {
  if (props.type === 'extended') {
    return {
      is: ContestNumberExtended,
      attrs: {
        lateNumber: props.number as LateNumber
      },
      wrapperClass: 'w-auto flex flex-col border-2 rounded justify-center items-center h-16'
    }
  }

  if (props.type === 'compact') {
    return {
      is: ContestNumberCompact,
      attrs: {
        number: props.number
      },
      wrapperClass: 'p-2 flex items-center justify-center border-2 rounded-full w-10 h-10 text-sm'
    }
  }

  return {
    is: ContestNumberNormal,
    attrs: {
      number: props.number,
      isSorted: false
    },
    wrapperClass: 'w-auto flex flex-col border-2 rounded justify-center items-center h-16'
  }
})
</script>

<template>
  <div
    :class="[classes, component.wrapperClass]"
    class="transition-colors"
    :style="style"
  >
    <Component
      :is="component.is"
      v-bind="component.attrs"
    />
  </div>
</template>
