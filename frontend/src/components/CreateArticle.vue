<template>
  <div class="form-container">
    <h1>Новая статья</h1>
    <div v-if="error" class="error-message">
      {{ error }}
    </div>
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
function debounce(fn, delay) {
  let timeout
  return function(...args) {
    clearTimeout(timeout)
    timeout = setTimeout(() => fn.apply(this, args), delay)
  }
}
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
  watch: {
    form: {
      handler: debounce(function(form) {
        localStorage.setItem('articleDraft', JSON.stringify(form))
      }, 500),
      deep: true
    }
  },
  methods: {
    async submitForm() {
      try {
        const response = await axios.post('api/v1/article', this.form)
        localStorage.removeItem('articleDraft')
        this.$router.push(`/article/${response.data.data.id}`)
      } catch (error) {
        console.error('Error creating article:', error)
        this.error = error.response?.data?.message || 'Ошибка создания статьи'
        this.saveDraft()
      }
    }
  },
  mounted() {
    const draft = localStorage.getItem('articleDraft')
    if (draft) {
      this.form = JSON.parse(draft)
    }
  },
  beforeUnmount() {
  }
}
</script>

<style scoped>
.error-message {
  color: #dc3545;
  padding: 0.8rem;
  margin-bottom: 1.5rem;
  background: #f8d7da;
  border: 1px solid #f5c6cb;
  border-radius: 4px;
}
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
