<script setup>
import { chunk } from "lodash-es";
import { computed } from "vue";

const props = defineProps({
  numbers: {
    type: Array,
    required: true,
  },
});

const chunkedNumbers = computed(() => {
  return chunk(props.numbers, 10);
});
</script>

<template>
  <table
    class="border-separate"
  >
    <tbody>
      <tr
        v-for="(chunkNumbers, index) in chunkedNumbers"
        :key="index"
      >
        <td
          v-for="number in chunkNumbers"
          :key="number.number"
          class="px-4 py-2 text-center rounded border border-slate-500"
        >
          <div class="text-xl font-bold">
            {{ number.number }}
          </div>
          <div class="text-slate-600">
            {{ number.occurences }}
          </div>
        </td>
      </tr>
    </tbody>
  </table>
</template>
