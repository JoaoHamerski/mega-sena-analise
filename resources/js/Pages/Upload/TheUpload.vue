<script setup>
import { useForm } from '@inertiajs/vue3';

const form = useForm({
  file: ''
})

const onSubmit = () => {
  form.post('/upload')
}
</script>

<template>
  <div class="flex justify-center items-center h-full">
    <div class="bg-white w-1/3 p-5 rounded-lg shadow-lg py-10">
      <div class="text-xl font-bold text-center mb-5">
        Enviar arquivo
      </div>

      <div>
        <form @submit.prevent="onSubmit">
          <input
            id="file"
            name="file"
            type="file"
            accept=".csv,.xlsx"
            class="file-input w-full file-input-primary"
            @input="form.file = $event.target.files[0]"
          >

          <div class="mt-10 text-center">
            <button
              type="submit"
              class="btn btn-primary px-10 text-white"
            >
              Enviar
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>
