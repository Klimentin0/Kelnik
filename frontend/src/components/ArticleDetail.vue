<template>
  <div v-if="article">
    <h1>{{ article.title }}</h1>
    <p class="author">{{ article.author || 'Anonymous' }}</p>
    <p class="brief">{{ article.brief }}</p>
    <div class="full-text">{{ article.full_text }}</div>

    <div class="actions">
      <router-link
        :to="{ name: 'EditArticle', params: { id: article.id } }"
        class="edit-button"
      >
        Править
      </router-link>
      <button @click="deleteArticle" class="delete-button">Удалить</button>
    </div>
  </div>
  <div v-else>
    ЗАГРУЗКА
  </div>
</template>

<script>
import axios from 'axios'

export default {
  data() {
    return {
      article: null
    }
  },
  async created() {
    try {
      const response = await axios.get(`api/v1/article/${this.$route.params.id}`)
      this.article = response.data.data
    } catch (error) {
      console.error('Error fetching article:', error)
      this.$router.push('/')
    }
  },
  methods: {
    async deleteArticle() {
      try {
        await axios.delete(`api/v1/article/${this.$route.params.id}`)
        this.$router.push('/')
      } catch (error) {
        console.error('Error deleting article:', error)
      }
    }
  }
}
</script>

<style scoped>
.full-text {
  white-space: pre-wrap;
  line-height: 1.6;
  margin: 2rem 0;
}
.actions {
  margin-top: 2rem;
}
.edit-button, .delete-button {
  padding: 0.5rem 1rem;
  margin-right: 1rem;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}
.edit-button {
  background: #2196F3;
  color: white;
  text-decoration: none;
}
.delete-button {
  background: #f44336;
  color: white;
}
</style>
