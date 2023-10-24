<script setup>

const emit = defineEmits(['update:modelValue'])

defineProps({
  modelValue: {
    type: Boolean,
    default: false
  },
  label: {
    type: String,
    default: ''
  }
})

const onChange = (event) => {
  emit('update:modelValue', event.target.checked)
}
</script>

<template>
  <label class="cursor-pointer flex">
    <input
      type="checkbox"
      class="toggle toggle-primary me-4"
      :value="modelValue"
      :checked="modelValue ?? null"
      @change="onChange"
    >
    <div class="label-text">{{ label }}</div>
  </label>
</template>
