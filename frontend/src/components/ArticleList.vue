<template>
  <div>
    <h1>Articles</h1>
    <router-link :to="{ name: 'CreateArticle' }" class="new-article">
      Create New Article
    </router-link>
    <div v-for="article in articles" :key="article.id" class="article-card">
      <h2>{{ article.title }}</h2>
      <p class="author">{{ article.author || 'Anonymous' }}</p>
      <p class="brief">{{ article.brief }}</p>
      <router-link :to="{ name: 'ArticleDetail', params: { id: article.id } }">
        Read More
      </router-link>
    </div>
  </div>
</template>

<script>
import axios from 'axios'

export default {
  data() {
    return {
      articles: []
    }
  },
  async mounted() {
    try {
      const response = await axios.get('/v1/articles')
      this.articles = response.data.data
    } catch (error) {
      console.error('Error fetching articles:', error)
    }
  }
}
</script>

<style scoped>
.article-card {
  border: 1px solid #ddd;
  padding: 1rem;
  margin: 1rem 0;
  border-radius: 4px;
}
.author {
  color: #666;
  font-style: italic;
}
.brief {
  color: #444;
}
.new-article {
  display: inline-block;
  margin-bottom: 1rem;
  padding: 0.5rem 1rem;
  background: #4CAF50;
  color: white;
  text-decoration: none;
  border-radius: 4px;
}
</style>
