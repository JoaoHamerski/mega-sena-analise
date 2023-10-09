<script setup>
import { watch } from 'vue';
import ResultsCardList from './ResultsCardList.vue'
import { ref } from 'vue';
import { computed } from 'vue';
import { router, usePage } from '@inertiajs/vue3';
import { onMounted } from 'vue';
import { watchEffect } from 'vue';

defineProps({
  heatmap: {
    type: Boolean,
    default: false
  }
})

const resultsCardList = ref(null)
const page = ref(0)
const items = ref([])
const hasMoreData = ref(true)

const currentQueryMonth = computed(() => usePage().props.query.month)

const fetchData = () => {
  router.reload({
    only: ['results'],
    data: { page: page.value++ },
    onSuccess: ({ props }) => {
      if (!props.results.next_page_url) {
        hasMoreData.value = false
      }

      if (props.results.current_page === 1) {
        items.value = []
        resultsCardList.value.scroller.scrollToItem(0)
      }

      items.value = [...items.value, ...props.results.data]
    }
  })
}

watch(currentQueryMonth, () => {
  page.value = 1

  fetchData()
})

onMounted(() => {
  fetchData()
})
</script>

<template>
  <AppCard
    color="bg-blue-600 "
  >
    <template #header>
      Lista de concursos
    </template>
    <template #body>
      <div class="max-h-[70vh]">
        <ResultsCardList
          ref="resultsCardList"
          :has-more-data="hasMoreData"
          :results="items"
          :heatmap="heatmap"
          @results:load-more="fetchData"
        />
      </div>
    </template>
  </AppCard>
</template>
