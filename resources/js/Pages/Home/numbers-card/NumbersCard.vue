<script setup>
import { computed } from 'vue';
import NumbersCardBoard from './NumbersCardBoard.vue';
import NumbersCardForm from './NumbersCardForm.vue'
import { ref } from 'vue';
import { sortBy } from 'lodash-es';

const emit = defineEmits(['update:heatmap'])

const props = defineProps({
  numbers: {
    type: Array,
    required: true,
  },
  heatmap: {
    type: Boolean,
    required: true
  }
});

const sort = ref(route().params.sort === 'true')

const computedNumbers = computed(
  () => sort.value
    ? sortBy(props.numbers, 'occurrences').reverse()
    : props.numbers
)

const onHeatmapUpdate = (value) => {
  emit('update:heatmap', value)
}

</script>

<template>
  <AppCard
    color="bg-green-600"
  >
    <template #header>
      Resultados da MEGA SENA
    </template>
    <template #body>
      <NumbersCardForm
        v-model:sort="sort"
        :heatmap="heatmap"
        @update:heatmap="onHeatmapUpdate"
      />
      <NumbersCardBoard
        :numbers="computedNumbers"
        :heatmap="heatmap"
      />
    </template>
  </AppCard>
</template>
