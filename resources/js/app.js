import './bootstrap';
import { createApp } from "vue";
import App  from "./src/App.vue";
import router from "@/router/router.js";
import {createPinia} from "pinia";
import '@/Axios/Api.js'

const app = createApp(App);
const pinia = createPinia();
app.use(router)
app.use(pinia)

app.mount('#app');
