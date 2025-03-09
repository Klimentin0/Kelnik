<template>
  <div class="container">
    <h1>Статьи</h1>
    <ul v-if="articles && articles.length">
      <li v-for="article in articles" :key="article.id">
        {{ article.title }}
      </li>
    </ul>
    <p v-else>Загрузка...</p>
  </div>
</template>

<script>
import axios from 'axios'

export default {
  data() {
    return {
      articles: null
    }
  },
  mounted() {
    this.getArticles()
  },
  methods: {
    async getArticles() {
      try {
        const response = await axios.get('/api/v1/articles') // Вызываем API Laravel
        this.articles = response.data
      } catch (error) {
        console.error(error)
      }
    }
  }
}
</script>

<style scoped>
.container {
  max-width: 600px;
  margin: 0 auto;
  padding: 20px;
}
</style>
