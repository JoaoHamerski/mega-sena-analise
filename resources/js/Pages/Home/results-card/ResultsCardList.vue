<script setup>
import { ref } from 'vue';
import { RecycleScroller } from 'vue-virtual-scroller'
import { useMegaSenaStore } from '@/pinia/mega-sena';

import ResultsCardListItem from './ResultsCardListItem.vue'

const emit = defineEmits(['results:load-more'])

const scroller = ref(null)
const megaSenaStore = useMegaSenaStore()

defineProps({
  results: {
    type: Array,
    required: true
  },
  hasMoreData: {
    type: Boolean,
    required: true
  }
})

const onItemClick = (game) => {
  megaSenaStore.setSelectedGame(game)
}

const loadMore = () => {
  emit('results:load-more')
}

defineExpose({ scroller })
</script>

<template>
  <RecycleScroller
    ref="scroller"
    class="scroller overflow-auto custom-scroll"
    :items="results"
    :item-size="90"
    style="height: 70vh"
    list-tag="ul"
    item-tag="li"
    item-class="border-b pb-3"
    :buffer="50"
    @scroll-end="loadMore"
  >
    <template #default="{ item: result }">
      <ResultsCardListItem
        :result="result"
        @click.prevent="onItemClick(result)"
      />
    </template>

    <template #after>
      <div
        v-if="!hasMoreData"
        class="text-center text-gray-600 text-sm"
      >
        Fim dos resultados
      </div>
    </template>
  </RecycleScroller>
</template>
