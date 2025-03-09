<template>
  <div class="form-container">
    <h1>Изменить статью</h1>
    <form @submit.prevent="submitForm" class="article-form">
      <div class="form-group">
        <label>Название:</label>
        <input v-model="form.title" required />
      </div>

      <div class="form-group">
        <label>Автор:</label>
        <input v-model="form.author" />
      </div>

      <div class="form-group">
        <label>Краткое содержание (до 500 символов):</label>
        <textarea
          v-model="form.brief"
          maxlength="500"
          placeholder="Введите краткое описание статьи..."
        />
      </div>

      <div class="form-group">
        <label>Полный текст:</label>
        <textarea
          v-model="form.full_text"
          rows="8"
          placeholder="Введите полный текст статьи..."
        />
      </div>

      <div class="button-group">
        <button type="submit" class="primary-btn">Обновить статью</button>
        <router-link to="/" class="secondary-btn">Отмена</router-link>
      </div>
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
  async created() {
    try {
      const response = await axios.get(`api/v1/article/${this.$route.params.id}`)
      this.form = response.data.data
    } catch (error) {
      console.error('Error fetching article:', error)
      this.$router.push('/')
    }
  },
  methods: {
    async submitForm() {
      try {
        await axios.put(`api/v1/article/${this.$route.params.id}`, this.form)
        this.$router.push(`/article/${this.$route.params.id}`)
      } catch (error) {
        console.error('Error updating article:', error)
      }
    }
  }
}
</script>

<style scoped>
.form-container {
  max-width: 800px;
  margin: 40px auto;
  padding: 2rem;
  background: white;
  border-radius: 12px;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

.article-form {
  display: grid;
  gap: 1.5rem;
}

.form-group {
  display: flex;
  flex-direction: column;
  gap: 0.5rem;
}

label {
  font-weight: 600;
  color: #333;
}

input, textarea {
  width: 100%;
  padding: 12px;
  border: 2px solid #e0e0e0;
  border-radius: 6px;
  font-size: 1rem;
  transition: border-color 0.3s ease;
}

input:focus, textarea:focus {
  border-color: #4CAF50;
  outline: none;
}

textarea {
  resize: vertical;
  min-height: 150px;
}

.button-group {
  display: flex;
  gap: 1rem;
  justify-content: flex-end;
  margin-top: 2rem;
}

.primary-btn {
  background: #4CAF50;
  color: white;
  padding: 12px 24px;
  border: none;
  border-radius: 6px;
  cursor: pointer;
  font-weight: 600;
  transition: background 0.3s ease;
}

.primary-btn:hover {
  background: #45a049;
}

.secondary-btn {
  background: #f8f9fa;
  color: #333;
  padding: 12px 24px;
  border: 2px solid #ddd;
  border-radius: 6px;
  text-decoration: none;
  transition: all 0.3s ease;
}

.secondary-btn:hover {
  background: #e2e6ea;
}

/* Responsive */
@media (max-width: 600px) {
  .form-container {
    padding: 1.5rem;
    margin: 20px;
  }

  input, textarea {
    font-size: 0.9rem;
  }
}
</style>
