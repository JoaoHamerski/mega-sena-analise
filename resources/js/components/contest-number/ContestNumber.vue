<script setup lang="ts">
import { type StyleValue, computed } from 'vue'
import type {
  ContestNumberProps,
  ContestNumberAttrs,
  ContestNumberTypesMap
} from '@/types/components'
import { contestNumberWrapperClass, contestNumberIs } from './contest-number-attrs'
import { useAppStore } from '@/store/app-store'

const props = withDefaults(defineProps<ContestNumberProps>(), {
  type: 'normal'
})

const appStore = useAppStore()

const heatMapEnabled = computed(() => appStore.heatMap)

const contestNumberAttrs = computed<ContestNumberTypesMap<object>>(() => ({
  normal: {
    number: props.number,
    isSorted: false
  },
  extended: {
    lateNumber: props.number
  },
  compact: {
    number: props.number
  }
}))

const bgColor = computed(() => {
  const MAX_DARKNESS = 80
  const relativeOccurrence = props.number.relative_occurrence

  const darkness = relativeOccurrence > MAX_DARKNESS ? MAX_DARKNESS : relativeOccurrence
  const lightness = 100 - darkness

  return `hsl(0, 55%, ${lightness}%)`
})

const component = computed<ContestNumberAttrs>(() => ({
  wrapperClass: contestNumberWrapperClass[props.type],
  is: contestNumberIs[props.type],
  attrs: contestNumberAttrs.value[props.type]
}))

const textColorClass = computed(() =>
  props.number.relative_occurrence > 45 && heatMapEnabled.value ? 'text-base-100' : ''
)

const classes = computed(() => {
  const componentClasses = []

  componentClasses.push(textColorClass.value)
  componentClasses.push(component.value.wrapperClass)

  return componentClasses
})

const style = computed<StyleValue>(() =>
  heatMapEnabled.value
    ? {
        backgroundColor: bgColor.value
      }
    : {}
)
</script>

<template>
  <div
    :class="classes"
    class="transition-colors"
    :style="style"
  >
    <Component
      :is="component.is"
      v-bind="component.attrs"
    />
  </div>
</template>
