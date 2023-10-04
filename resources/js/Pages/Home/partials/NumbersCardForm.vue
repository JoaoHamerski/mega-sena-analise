<script setup>
import { router } from '@inertiajs/vue3';
import { reactive, watch } from 'vue';
import DatePicker from '@/components/DatePicker.vue'

const emit = defineEmits(['update:heatmap'])
const form = reactive({
  month: route().params.month ?? '',
  sort: route().params.sort === 'true' ? true : false
})

const onHeatmapInput = (value) => {
  emit('update:heatmap', value)
}

const submit = () => {
  router.get('/', form, {
    preserveState: true
  })
}

watch(form, () => {
  submit()
})
</script>

<template>
  <form>
    <div class="grid grid-cols-2 mb-5">
      <div class="self-center mr-2">
        <div class="mb-2">
          <AppCheckbox
            v-model="form.sort"
            label="Ordenar por ocorrências"
          />
        </div>
        <div>
          <AppCheckbox
            label="Mapa de calor"
            @update:model-value="onHeatmapInput"
          />
        </div>
      </div>
      <div>
        <DatePicker
          v-model="form.month"
          label="RESULTADOS À PARTIR DE:"
        />
      </div>
    </div>
  </form>
</template>