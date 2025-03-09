<template>
  <div class="form-container">
    <h1>Новая статья</h1>
    <form @submit.prevent="submitForm">
      <div class="form-group">
        <label>Название:</label>
        <input v-model="form.title" required />
      </div>

      <div class="form-group">
        <label>Автор:</label>
        <input v-model="form.author" />
      </div>

      <div class="form-group">
        <label>Краткое содержание:</label>
        <textarea v-model="form.brief" required maxlength="500" />
      </div>

      <div class="form-group">
        <label>Полный текст:</label>
        <textarea v-model="form.full_text" required rows="6" />
      </div>

      <button type="submit">Создать статью</button>
    </form>
  </div>
</template>

<script>
import axios from 'axios'

export default {
  data() {
    return {
      form: {
        title: '',
        author: '',
        brief: '',
        full_text: ''
      }
    }
  },
  methods: {
    async submitForm() {
      try {
        const response = await axios.post('api/v1/article', this.form)
        this.$router.push(`/article/${response.data.data.id}`)
      } catch (error) {
        console.error('Error creating article:', error)
      }
    }
  }
}
</script>

<style scoped>
.form-container {
  max-width: 800px;
  margin: 0 auto;
  padding: 2rem;
}
.form-group {
  margin-bottom: 1.5rem;
}
label {
  display: block;
  margin-bottom: 0.5rem;
}
input, textarea {
  width: 100%;
  padding: 0.5rem;
  border: 1px solid #ddd;
  border-radius: 4px;
}
button {
  background: #4CAF50;
  color: white;
  padding: 0.8rem 1.5rem;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}
</style>
