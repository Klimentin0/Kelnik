<template>
  <div class="form-container">
    <h1>Edit Article</h1>
    <form @submit.prevent="submitForm">
      <div class="form-group">
        <label>Title:</label>
        <input v-model="form.title" />
      </div>

      <div class="form-group">
        <label>Author:</label>
        <input v-model="form.author" />
      </div>

      <div class="form-group">
        <label>Brief:</label>
        <textarea v-model="form.brief" maxlength="500" />
      </div>

      <div class="form-group">
        <label>Full Text:</label>
        <textarea v-model="form.full_text" rows="6" />
      </div>

      <button type="submit">Update Article</button>
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
      const response = await axios.get(`/v1/articles/${this.$route.params.id}`)
      this.form = response.data.data
    } catch (error) {
      console.error('Error fetching article:', error)
      this.$router.push('/')
    }
  },
  methods: {
    async submitForm() {
      try {
        await axios.put(`/v1/articles/${this.$route.params.id}`, this.form)
        this.$router.push(`/articles/${this.$route.params.id}`)
      } catch (error) {
        console.error('Error updating article:', error)
      }
    }
  }
}
</script>

<style scoped>
/* Same styles as CreateArticle component */
</style>
