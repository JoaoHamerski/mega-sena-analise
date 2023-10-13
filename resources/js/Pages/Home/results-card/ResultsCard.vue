<script setup>
import { ref, onMounted, watch, inject } from 'vue';
import { router } from '@inertiajs/vue3';

import ResultsCardList from './ResultsCardList.vue'

const resultsCardList = ref(null)

const page = ref(1)
const results = ref([])
const hasMoreData = ref(true)

const { month } = inject('month')

const onFetchDataSuccess = ({ props }) => {
  if (!props.results.next_page_url) {
    hasMoreData.value = false
  }

  if (props.results.current_page === 1) {
    resetResults()
  }

  results.value = [...results.value, ...props.results.data]
}

const resetResults = () => {
  results.value = []
  resultsCardList.value.scroller.scrollToItem(0)
}

const fetchData = () => {
  router.reload({
    only: ['results'],
    data: { page: page.value++ },
    onSuccess: onFetchDataSuccess
  })
}

router.on('finish', () => {
  if (page.value === 1) {
    fetchData()
  }
})

watch(month, () => {
  page.value = 1
})

onMounted(() => fetchData())
</script>

<template>
  <AppCard
    color="bg-blue-600 "
  >
    <template #header>
      <FWIcon
        icon="fas fa-list"
        fixed-width
      />
      Lista de concursos
    </template>
    <template #body>
      <div class="max-h-[70vh]">
        <ResultsCardList
          ref="resultsCardList"
          :has-more-data="hasMoreData"
          :results="results"
          @results:load-more="fetchData"
        />
      </div>
    </template>
  </AppCard>
</template>
