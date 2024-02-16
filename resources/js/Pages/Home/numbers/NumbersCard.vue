<script setup lang="ts">
import type { Number } from '@/types'
import NumbersCardFormOptions from './NumbersCardFormOptions.vue'
import NumbersCardGrid from './NumbersCardGrid.vue'
import { computed } from 'vue'
import { useAppStore } from '@/store/app-store'
import sortBy from 'lodash-es/sortBy'
import reverse from 'lodash-es/reverse'

type NumbersCardProps = {
  numbers: Number[]
}

const props = defineProps<NumbersCardProps>()

const appStore = useAppStore()

const computedNumbers = computed(() => {
  if (appStore.sortByOccurrences) {
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
        <NumbersCardFormOptions class="mb-5" />
        <NumbersCardGrid :numbers="computedNumbers" />
      </div>
    </template>
  </AppCard>
</template>
