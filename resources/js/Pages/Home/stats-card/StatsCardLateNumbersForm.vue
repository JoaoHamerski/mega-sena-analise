<script setup>
const emit = defineEmits(['form:submit', 'update:sort', 'update:interval'])

defineProps({
  interval: {
    type: String,
    required: true
  }
})

const onSortChange = (value) => {
  emit('update:sort', value)
}

const onIntervalChange = (value) => {
  emit('update:interval', value)
}
</script>

<template>
  <form @submit.prevent="$emit('form:submit', interval)">
    <div class="mb-4">
      <AppInput
        :model-value="interval"
        name="interval"
        label="Intervalo de dias"
        size="sm"
        @update:model-value="onIntervalChange"
      >
        <template #after-join>
          <button
            type="submit"
            class="btn btn-sm join-item"
          >
            Atualizar
          </button>
        </template>
      </AppInput>
    </div>

    <div class="mb-5">
      <AppCheckbox
        label="Ordenar por mais atrasados"
        @update:model-value="onSortChange"
      />
    </div>
  </form>
</template>
