<script setup>
import { computed } from 'vue';
import BaseInput from './BaseInput.vue';
import { useSlots } from 'vue';

const slots = useSlots()

defineEmits(['update:modelValue'])

defineProps({
  modelValue: {
    type: [String, Number],
    default: ''
  },
  size: {
    type: String,
    default: 'md',
    validator: (value) => ['xs', 'sm', 'md', 'lg'].includes(value)
  },
  name: {
    type: String,
    required: true
  },
  label: {
    type: String,
    default: ''
  }
})

const join = computed(
  () => !!(slots['after-join']
    || slots['before-join'])
)

</script>

<template>
  <div class="form-control w-full">
    <label
      v-if="label"
      class="label font-bold"
      :for="name"
    >
      <span class="label-text">
        {{ label }}
      </span>
    </label>

    <div
      v-if="join"
      class="join"
    >
      <div
        v-if="$slots['before-join']"
        class="join-item"
      >
        <slot name="before-join" />
      </div>

      <BaseInput
        v-bind="{modelValue, name, label, join, size}"
        @update:model-value="$emit('update:modelValue', $event)"
      />

      <div
        v-if="$slots['after-join']"
        class="join-item"
      >
        <slot name="after-join" />
      </div>
    </div>
    <template v-else>
      <BaseInput
        v-bind="{modelValue, name, label, join, size}"
        @update:model-value="$emit('update:modelValue', $event)"
      />
    </template>
  </div>
</template>
