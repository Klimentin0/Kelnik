import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import axios from 'axios'

const app = createApp(App)
app.use(router)

// Configure axios
axios.defaults.baseURL = 'http://localhost:8000' // Update with your Laravel URL
axios.defaults.withCredentials = true

app.mount('#app')
