import { createApp } from "vue";
import App from "./App.vue";
import { createPinia } from "pinia";
import router from "@/router";
import axios from "axios";

// axios token starts
const token = localStorage.getItem("token");
if (token) {
  axios.defaults.headers.common["Authorization"] = `Bearer ${token}`; // Add JWT if exist
}

axios.defaults.baseURL = "http://localhost/vue3/vue_guard/public/api"; // do not add '/' at the end
axios.defaults.timeout = 5000; // 2.5 seconds
axios.defaults.headers.post["Content-Type"] = "application/json";
// axios.defaults.headers.common['Authorization'] = AUTH_TOKEN
// axios.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded' //  if the communication with PHP is maintained thanks to $_POST

// axios token ends
import "./../node_modules/@picocss/pico/css/pico.min.css";

/*
// Vuetify
import 'vuetify/styles'
import { createVuetify } from 'vuetify'
import * as components from 'vuetify/components'
import * as directives from 'vuetify/directives'

const vuetify = createVuetify({
  components,
  directives
})
*/

const app = createApp(App);
app.use(createPinia());
app.use(router);
// Add Axios to Vue
app.config.globalProperties.$axios = axios;
// app.use(vuetify)

app.mount("#app");
