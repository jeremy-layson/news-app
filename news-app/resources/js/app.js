import './bootstrap';

import { createApp } from "vue";
import News from './components/News.vue';
import './bootstrap.js';
import 'bootstrap/dist/css/bootstrap.min.css';

const app = createApp();

app.component('news', News);

app.mount("#app");