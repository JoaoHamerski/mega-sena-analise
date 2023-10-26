<script setup>
import { computed } from 'vue';
import { useMegaSenaStore } from '@/pinia/mega-sena';
import { tap } from 'lodash-es';

const props = defineProps({
  number: {
    type: Number,
    required: true
  },
  relativeOccurrences: {
    type: Number,
    required: true
  },
  styleName: {
    type: String,
    default: 'normal',
    validator: (value) => ['normal', 'circle'].includes(value)
  },
  padding: {
    type: Boolean,
    default: true
  }
})

const STYLES = {
  normal: {
    classes: 'rounded w-16',
    padding: 'px-4 py-2',
    icon: 'right-0 top-0'
  },
  circle: {
    classes: 'rounded-full w-10 h-10',
    padding: 'p-2',
    icon: '-right-2 -top-1 rounded-full'
  }
}

const megaSenaStore = useMegaSenaStore()

const isNumberSelected = computed(
  () => megaSenaStore.selectedGameNumbers.includes(props.number)
)

const heatmap = computed(() => megaSenaStore.heatmap)

const heatmapBg = computed(() => {
  const MAX_DARKNESS = 80
  const relativeOccurrences = props.relativeOccurrences
  const relativeForHeatmap = relativeOccurrences > MAX_DARKNESS
    ? MAX_DARKNESS
    : relativeOccurrences

    const lightness = (100 - relativeForHeatmap)

    return `hsl(0, 55%, ${lightness}%)`
})

const bgIsDark = computed(() => heatmap.value && props.relativeOccurrences > 35)

const textColorClass = computed(() => bgIsDark.value ? 'text-white' : 'text-dark')

const bgColor = computed(() => !heatmap.value
  ? 'rgb(255, 255, 255)'
  : heatmapBg.value
)

const style = computed(() => STYLES[props.styleName])

const classNames = computed(() => {
  const classes = []

  if (props.padding) {
    classes.push(style.value.padding)
  }

  return tap(classes, () => classes.push(
    ...[
      style.value.classes,
      textColorClass.value
    ]
  ))
})

const iconClassNames = computed(() => style.value.icon)
</script>

<template>
  <span
    class="transition-colors text-center relative border border-black"
    :class="classNames"
    :style="{
      backgroundColor: bgColor,
    }"
  >
    <Transition
      enter-active-class="animate__animated animate__fadeIn animate__evenFaster"
      leave-active-class="animate__animated animate__fadeOut animate__evenFaster"
    >
      <FWIcon
        v-if="isNumberSelected"
        icon="fas fa-check"
        class="absolute p-1 text-white bg-emerald-600 border border-emerald-700 text-[.5rem]"
        :class="iconClassNames"
      />
    </Transition>
    <slot v-bind="{textColorClass, bgColor, number}" />
    <slot
      v-if="$slots['append']"
      name="append"
    />
  </span>
</template>
