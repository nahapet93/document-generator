import { createApp } from 'vue/dist/vue.esm-bundler';
import DocumentForm from './components/DocumentForm.vue';

const app = createApp({
    components: {
        'document-form' : DocumentForm,
    }
});

app.mount('#app');
