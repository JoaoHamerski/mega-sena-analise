<script setup>
import DatePicker from 'vue-datepicker-next'
import 'vue-datepicker-next/locale/pt-br'

const emit = defineEmits(['update:model-value'])

defineProps({
  name: {
    type: String,
    required: true
  },
  modelValue: {
    type: String,
    default: ''
  },
  label: {
    type: String,
    default: ''
  }
})

const onChange = (value) => {
  emit('update:model-value', value)
}
</script>

<template>
  <div class="form-control">
    <label
      v-if="label"
      class="label"
      :for="name"
    >
      <span class="label-text font-bold">
        {{ label }}
      </span>
    </label>

    <DatePicker
      class="custom-datepicker"
      value-type="YYYY-MM"
      type="month"
      :value="modelValue"
      format="MM/YYYY"
      @update:value="onChange"
    >
      <template #input="{value}">
        <input
          :id="name"
          type="text"
          :name="name"
          autocomplete="off"
          class="input input-bordered w-full"
          :value="value"
        >
      </template>
    </DatePicker>
  </div>
</template>

<style lang="scss" scoped>
:deep(.custom-datepicker) {
  &.mx-datepicker {
    width: 100%;
  }

  .mx-icon-calendar,
  .mx-icon-clear {
    right: 15px;
  }
}
</style>
