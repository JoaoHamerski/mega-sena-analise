<script setup>
import { ref, computed, onMounted, watch } from 'vue';
import { router, usePage } from '@inertiajs/vue3';
import ResultsCardList from './ResultsCardList.vue'

const resultsCardList = ref(null)
const page = ref(0)
const items = ref([])
const hasMoreData = ref(true)

const currentQueryMonth = computed(() => usePage().props.query.month)

const onFetchDataSuccess = ({ props }) => {
  if (!props.results.next_page_url) {
    hasMoreData.value = false
  }

  if (props.results.current_page === 1) {
    resetResults()
  }

  items.value = [...items.value, ...props.results.data]
}

const resetResults = () => {
  items.value = []
  resultsCardList.value.scroller.scrollToItem(0)
}

const fetchData = () => {
  router.reload({
    only: ['results'],
    data: { page: page.value++ },
    onSuccess: onFetchDataSuccess
  })
}

watch(currentQueryMonth, () => {
  page.value = 1

  fetchData()
})

onMounted(() => { fetchData() })
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
          :results="items"
          @results:load-more="fetchData"
        />
      </div>
    </template>
  </AppCard>
</template>
