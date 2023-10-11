<script setup>
import { router } from '@inertiajs/vue3';
import { reactive } from 'vue';
import DatePicker from '@/components/DatePicker.vue'
import { replaceState } from '@/helpers/replace-state'

const emit = defineEmits(['update:heatmap', 'update:sort'])

defineProps({
  heatmap: {
    type: Boolean,
    required: true
  },
  sort: {
    type: Boolean,
    required: true
  }
})

const form = reactive({
  month: route().params.month ?? '',
})

const onUpdateProp = (prop, value) => {
  replaceState({[prop]: value})

  emit(`update:${prop}`, value)
}

const onMonthChange = (value) => {
  form.month = value
  submit()
}

const submit = () => {
  router.get('/', {...route().params, ...form}, {
    preserveState: true
  })
}
</script>

<template>
  <form>
    <div class="grid grid-cols-2 mb-5">
      <div class="self-center mr-2">
        <div class="mb-2">
          <AppCheckbox
            :model-value="sort"
            label="Ordenar por ocorrências"
            @update:model-value="onUpdateProp('sort', $event)"
          />
        </div>
        <div>
          <AppCheckbox
            :model-value="heatmap"
            label="Mapa de calor"
            @update:model-value="onUpdateProp('heatmap', $event)"
          />
        </div>
      </div>
      <div>
        <DatePicker
          :model-value="form.month"
          name="month"
          label="RESULTADOS À PARTIR DE:"
          @update:model-value="onMonthChange"
        />
      </div>
    </div>
  </form>
</template>
