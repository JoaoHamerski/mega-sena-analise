<script setup>
import NumbersCardTable from './NumbersCardTable.vue';
import DatePicker from '@/components/DatePicker.vue'
import { useForm } from '@inertiajs/vue3';

defineProps({
  numbers: {
    type: Array,
    required: true,
  },
});

const form = useForm({
  month: ''
})


</script>

<template>
  <div class="bg-white w-fit mx-auto mt-10 rounded-lg shadow-lg p-5">
    <div class="grid grid-cols-2 mb-5 gap-x-10">
      <div class="self-center">
        <div class="mb-2">
          <AppCheckbox label="Ordenar por ocorrências" />
        </div>
        <div>
          <AppCheckbox label="Mapa de calor" />
        </div>
      </div>
      <div>
        <DatePicker
          v-model="form.month"
          label="RESULTADOS À PARTIR DE:"
        />
      </div>
    </div>

    <NumbersCardTable :numbers="numbers" />
  </div>
</template>
