<script setup>
import { computed, ref, onMounted, watch } from 'vue';
import StatsCardUnluckyNumbers from './StatsCardUnluckyNumbers.vue';
import { usePage } from '@inertiajs/vue3';

defineProps({
  heatmap: {
    type: Boolean,
    default: false
  }
})

const data = ref({})
const isLoading = ref(false)

const unluckyNumbers = computed(() => data.value.unlucky_numbers)
const queryMonth = computed(() => usePage().props.query.month)

const fetchData = async () => {
  isLoading.value = true

  const response = await fetch(route('home.stats'))

  data.value = await response.json()

  isLoading.value = false
}

onMounted(() => {
  fetchData()
})

watch(queryMonth, () => {
  fetchData()
})
</script>

<template>
  <AppCard
    color="bg-gray-600"
  >
    <template #header>
      Estatísticas
    </template>

    <template #body>
      <AppLoading :value="isLoading" />
      <StatsCardUnluckyNumbers
        :loading="isLoading"
        :heatmap="heatmap"
        :numbers="unluckyNumbers"
      />
    </template>
  </AppCard>
</template>
