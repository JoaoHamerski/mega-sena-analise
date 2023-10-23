<script setup>
import { ref, provide, computed, onMounted } from 'vue';
import { router } from '@inertiajs/vue3';

import NumbersCard from './numbers-card/NumbersCard.vue'
import ResultsCard from './results-card/ResultsCard.vue'
import StatsCard from './stats-card/StatsCard.vue'
import axios from '@/plugins/axios';

defineProps({
  numbers: {
    type: Array,
    default: () => []
  },
  results: {
    type: Object,
    default: () => ({})
  }
})

const month = ref(route().params.month ?? undefined)
const hasMoreResults = ref(true)
const resultsItems = ref([])
const numbersItems = ref([])

const params = computed(() => ({
  ...route().params,
  ...{month: month.value}
}))

const onFetchResultsSuccess = ({ props }) => {
  if (!props.results.next_page_url) {
    hasMoreResults.value = false
  }

  if (props.results.current_page === 1) {
    resultsItems.value = []
  }

  resultsItems.value = [...resultsItems.value, ...props.results.data]
}

const onFetchNumbersSuccess = ({ props }) => {
  numbersItems.value = props.numbers

  // axios.get(route('stats.sequential-numbers'))
  //   .then((data) => {
  //     console.log(data)
  //   })
}

const onFetchSuccess = (data) => {
  onFetchResultsSuccess(data)
  onFetchNumbersSuccess(data)
}

const onLoadMoreResults = () => {
  const page = +(route().params.page || 1) + 1

  router.reload({
    only: ['results'],
    data: {...params.value, page },
    onSuccess: onFetchResultsSuccess
  })
}

const refreshData = () => {
  router.reload({
    only: ['numbers', 'results'],
    data: {...params.value, page: 1},
    preserveState: true,
    onSuccess: onFetchSuccess
  })

}

const updateMonth = (value) => {
  month.value = value
  refreshData()
}

provide('month', { month, updateMonth })

onMounted(() => {
  refreshData()
})
</script>

<template>
  <div class="py-10 px-10">
    <div class="grid grid-cols-[1.7fr,.9fr,1.1fr] gap-x-5 mb-5">
      <NumbersCard :numbers="numbersItems" />
      <ResultsCard
        :results="resultsItems"
        :has-more-data="hasMoreResults"
        @results:load-more="onLoadMoreResults"
      />
      <StatsCard />
    </div>
  </div>
</template>
