<script setup>
import { onMounted, ref } from 'vue';
import ResultsCardListItem from './ResultsCardListItem.vue'
import { RecycleScroller } from 'vue-virtual-scroller'

const emit = defineEmits(['results:load-more'])

const scroller = ref(null)

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

const loadMore = () => {
  emit('results:load-more')
}

onMounted(() => {
  loadMore()
})

defineExpose({ scroller })
</script>

<template>
  <RecycleScroller
    ref="scroller"
    class="scroller overflow-auto custom-scroll -mr-3 pr-2"
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
      <ResultsCardListItem :result="result" />
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
