<script setup>
import { ref, computed } from 'vue';
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

const activeId = computed(() => megaSenaStore?.selectedGame?.id || null)

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
    class="scroller overflow-auto custom-scroll mr-1 pr-1"
    :items="results"
    :item-size="105"
    style="height: 70vh"
    list-tag="ul"
    item-tag="li"
    :buffer="50"
    @scroll-end="loadMore"
  >
    <template #default="{ item: result }">
      <ResultsCardListItem
        :active="result.id === activeId"
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
