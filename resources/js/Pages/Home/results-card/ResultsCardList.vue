<script setup>
import { onMounted } from 'vue';
import ResultsCardListItem from './ResultsCardListItem.vue'
import { RecycleScroller } from 'vue-virtual-scroller'

const emit = defineEmits(['results:load-more'])

defineProps({
  results: {
    type: Array,
    required: true
  },
  heatmap: {
    type: Boolean,
    default: false
  }
})

const loadMore = () => {
  emit('results:load-more')
}

onMounted(() => {
  loadMore()
})
</script>

<template>
  <RecycleScroller
    class="scroller overflow-auto custom-scroll -mr-3 pr-2"
    :items="results"
    :item-size="100"
    style="height: 70vh"
    list-tag="ul"
    item-tag="li"
    item-class="mb-5"
    :buffer="50"
    @scroll-end="loadMore"
  >
    <template #default="{ item: result }">
      <ResultsCardListItem
        :result="result"
        :heatmap="heatmap"
      />
    </template>
  </RecycleScroller>
</template>
