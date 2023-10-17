<script setup>
import { computed } from 'vue';
import StatsCardOddEvenResultsBar from './StatsCardOddEvenResultsBar.vue';
import { map, max } from 'lodash-es';

const props = defineProps({
  data: {
    type: Object,
    default: () => ({})
  }
})

const maxEven = computed(() => max(map(props.data.even_games_count, 'occurrences')))
</script>

<template>
  <ul>
    <li
      v-for="i in 7"
      :key="i"
      class="flex justify-between items-center my-3"
    >
      <div class="w-full">
        <div class="flex">
          <span class="font-bold">
            <span>{{ i - 1 }} PAR </span>
            <span class="mx-2">&bull;</span>
            <span>
              {{ 7 - i }} ÍMPAR:
            </span>
          </span>
          <span class="ml-2 font-sm">
            {{ data.even_games_count[`count_${i - 1}`]['occurrences'] }} jogos
          </span>
        </div>

        <div class="flex">
          <div class="w-full">
            <StatsCardOddEvenResultsBar
              :size="data.even_games_count[`count_${i - 1}`]['occurrences']"
              :total="maxEven"
              class="mb-1"
              bg-class="bg-sky-600"
            />
          </div>
          <span class="ml-2 w-[20%]">
            {{ data.even_games_count[`count_${i - 1}`]['percentage'] }}%
          </span>
        </div>
      </div>
    </li>
  </ul>
</template>
