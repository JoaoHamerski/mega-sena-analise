<script setup>
import { ref, watch, inject } from 'vue';

import ResultsCardList from './ResultsCardList.vue'

const emit = defineEmits(['results:load-more'])

defineProps({
  results: {
    type: Array,
    default: () => []
  },
  hasMoreData: {
    type: Boolean,
    required: true
  }
})

const resultsCardList = ref(null)

const { month } = inject('month')

const onLoadMore = () => {
  emit('results:load-more')
}

const scrollToFirstItem = () => {
  resultsCardList.value.scroller.scrollToItem(0)
}

watch(month, () => {
  scrollToFirstItem()
})
</script>

<template>
  <AppCard
    color="bg-blue-600"
    :padding="false"
  >
    <template #header>
      <FWIcon
        icon="fas fa-list"
        fixed-width
      />
      Lista de concursos
    </template>
    <template #body>
      <div class="max-h-[70vh] py-5">
        <ResultsCardList
          ref="resultsCardList"
          :has-more-data="hasMoreData"
          :results="results"
          @results:load-more="onLoadMore"
        />
      </div>
    </template>
  </AppCard>
</template>
