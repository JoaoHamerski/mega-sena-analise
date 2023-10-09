<script setup>
import { computed } from 'vue';
import { ref } from 'vue';
import { onMounted } from 'vue';

const data = ref({})

const unluckyNumbers = computed(() => data.value.unlucky_numbers)

const fetchData = async () => {
  const response = await fetch(route('home.stats'))

  data.value = await response.json()
}

onMounted(() => {
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
      {{ unluckyNumbers }}
    </template>
  </AppCard>
</template>
