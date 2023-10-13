<script setup>
import { computed, ref } from 'vue';
import { sortBy } from 'lodash-es';

import NumbersCardBoard from './NumbersCardBoard.vue';
import NumbersCardForm from './NumbersCardForm.vue'

const props = defineProps({
  numbers: {
    type: Array,
    required: true,
  }
});

const sort = ref(route().params.sort === 'true')

const computedNumbers = computed(
  () => sort.value
    ? sortBy(props.numbers, 'occurrences').reverse()
    : props.numbers
)
</script>

<template>
  <AppCard
    color="bg-green-600"
  >
    <template #header>
      <FWIcon
        icon="fas fa-circle"
        fixed-width
      />
      Resultados da MEGA SENA
    </template>
    <template #body>
      <NumbersCardForm
        v-model:sort="sort"
      />
      <NumbersCardBoard
        :numbers="computedNumbers"
      />
    </template>
  </AppCard>
</template>
