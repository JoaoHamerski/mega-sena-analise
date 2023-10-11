<script setup>
import axios from '@/plugins/axios'
import { usePage } from '@inertiajs/vue3';
import { computed, watch } from 'vue';
import { onMounted, ref } from 'vue';

const emit = defineEmits(['update:loading'])
const data = ref({})

const fetchData = async () => {
  emit('update:loading', true)

  const { data: response } = await axios.get(route('stats.odd-even'), {
    params: {
      month: queryMonth.value
    }
  })

  Object.assign(data.value, response)

  emit('update:loading', false)
}

const queryMonth = computed(() => usePage().props.query.month)

watch(queryMonth, () => {
  fetchData()
})

onMounted(() => {
  fetchData()
})
</script>

<template>
  <AppContainer>
    <template #title>
      Pares e ímpares
    </template>
    <template #content>
      <div class="flex justify-between">
        <div>
          <b>Pares: </b> {{ data.even }}
        </div>
        <div>
          <b>Ímpares: </b> {{ data.odd }}
        </div>
      </div>
    </template>
  </AppContainer>
</template>
