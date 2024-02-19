<script setup lang="ts">
import type { Number } from '@/types'
import { computed, ref } from 'vue'
import sortBy from 'lodash-es/sortBy'
import reverse from 'lodash-es/reverse'

import NumbersCardFormOptions from './NumbersCardFormOptions.vue'
import NumbersCardGrid from './NumbersCardGrid.vue'

type NumbersCardProps = {
  numbers: Number[]
}

const props = defineProps<NumbersCardProps>()

const sortOccurrences = ref(false)

const onSortChange = (value: boolean) => {
  sortOccurrences.value = value
}

const computedNumbers = computed(() => {
  if (sortOccurrences.value) {
    return reverse(sortBy(props.numbers, 'occurrences'))
  }

  return props.numbers
})
</script>

<template>
  <AppCard color="success">
    <template #title>
      <FWIcon
        :icon="['fas', 'circle']"
        fixed-width
      />
      Resultados da MEGA SENA
    </template>

    <template #content>
      <div class="flex flex-col">
        <NumbersCardFormOptions
          class="mb-5"
          @update:sort-by-occurrences="onSortChange"
        />
        <NumbersCardGrid :numbers="computedNumbers" />
      </div>
    </template>
  </AppCard>
</template>
