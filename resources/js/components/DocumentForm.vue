<script setup>
import {ref} from "vue";
import axios from "axios";

let title = defineModel('title');
let date = defineModel('date');
let isGenerated = ref(false);
let link = ref('');

async function generateDocument() {
    const formData = new FormData();
    formData.append('title', title.value);
    formData.append('date', date.value);

    const response = await axios.post('/generate-document', formData, {
        responseType: 'blob'
    });

    link.value = window.URL.createObjectURL(new Blob([response.data]));
    isGenerated.value = true;
}
</script>

<template>

    <form @submit.prevent="generateDocument" class="max-w-sm mx-auto">
        <div class="mb-5">
            <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Название документа</label>
            <input type="text" v-model="title" id="title" required
                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"/>
        </div>

        <div class="mb-5">
            <label for="date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Дата создания документа</label>
            <input type="date" v-model="date" id="date" required
                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"/>
        </div>

        <div class="mb-5">
        <button type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            Сгенерировать
        </button>
        </div>

        <div class="mb-5">
            <a v-show="isGenerated" :href="link" :download="title + '.docx'"
               class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Скачать
            </a>
        </div>
    </form>
</template>

<style scoped>

</style>
