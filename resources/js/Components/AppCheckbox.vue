<script setup lang="ts">
defineProps<{
  label?: string
}>()

const modelValue = defineModel()
</script>

<template>
  <div class="inline-block">
    <label class="cursor-pointer flex items-center gap-3">
      <input
        type="checkbox"
        class="toggle toggle-primary"
        v-model="modelValue"
      />

      <span
        class="label-text"
        v-if="label"
      >
        {{ label }}
      </span>
    </label>
  </div>
</template>
