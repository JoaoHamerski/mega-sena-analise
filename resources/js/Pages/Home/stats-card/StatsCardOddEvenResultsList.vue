<script setup>
import StatsCardOddEvenResultsBar from './StatsCardOddEvenResultsBar.vue';

defineProps({
  data: {
    type: Object,
    default: () => ({})
  }
})
</script>

<template>
  <ul>
    <li
      v-for="i in 7"
      :key="i"
      class="flex justify-between items-center my-3"
    >
      <div class="font-bold">
        {{ i - 1 }}
      </div>
      <StatsCardOddEvenResultsBar
        :left="data.even_games_count[`count_${i - 1}`]['occurrences']"
        :right="data.odd_games_count[`count_${i - 1}`]['occurrences']"
      />
      <div class="font-bold">
        {{ i - 1 }}
      </div>
    </li>
  </ul>
</template>
