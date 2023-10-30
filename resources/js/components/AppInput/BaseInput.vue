<script setup>
import { computed } from 'vue';

const SIZES = {
  xs: 'input-xs',
  sm: 'input-sm',
  md: 'input-md',
  lg: 'input-lg'
}

const emit = defineEmits(['update:modelValue'])

const props = defineProps({
  modelValue: {
    type: [String, Number],
    default: ''
  },
  size: {
    type: String,
    required: true,
  },
  join: {
    type: Boolean,
    default: false
  },
  name: {
    type: String,
    required: true
  },
  label: {
    type: String,
    default: ''
  },
})

const sizeClass = computed(() => SIZES[props.size])

const classNames = computed(() => {
  const classes = []

  if (props.join) {
    classes.push('join-item')
  }

  classes.push(sizeClass.value)

  return classes
})

const onInput = (event) => {
  emit('update:modelValue', event.target.value)
}
</script>

<template>
  <input
    :id="name"
    :name="name"
    type="text"
    class="input input-bordered w-full"
    :class="classNames"
    :value="modelValue"
    @input="onInput"
  >
</template>
