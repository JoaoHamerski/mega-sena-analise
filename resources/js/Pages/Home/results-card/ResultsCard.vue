<script setup>
import ResultsCardList from './ResultsCardList.vue'
import { ref } from 'vue';
import { router, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';
import { queryParams } from '@/helpers/query-params';
import { watch } from 'vue';

const props = defineProps({
  results: {
    type: Object,
    required: true
  },
  heatmap: {
    type: Boolean,
    default: false
  }
})

const page = ref(1)
const items = ref([])

const currentQueryMonth = computed(() => usePage().props.query.month)

const loadMoreResults = async () => {
  router.reload({
    only: ['results'],
    data: { page: page.value++ },
    onSuccess: () => {
      items.value = [...items.value, ...props.results.data]
    }
  })
}

const hasMoreData = computed(() => !!props.results.next_page_url)

watch(currentQueryMonth, () => {
  items.value = []
  page.value = 1
  loadMoreResults()
})


</script>

<template>
  <AppCard
    class="w-1/4"
    color="bg-info-content"
  >
    <template #header>
      Lista de concursos
    </template>
    <template #body>
      <div class="max-h-[70vh]">
        <ResultsCardList
          :has-more-data="hasMoreData"
          :results="items"
          :heatmap="heatmap"
          @results:load-more="loadMoreResults"
        />
      </div>
    </template>
  </AppCard>
</template>
