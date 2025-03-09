<template>
  <div>
    <h1>Статьи</h1>
    <router-link :to="{ name: 'CreateArticle' }" class="new-article">
      Новая статья
    </router-link>

    <div v-for="article in articles" :key="article.id" class="article-card">
      <h2>{{ article.title }}</h2>
      <p class="author">{{ article.author || 'Anonymous' }}</p>
      <p class="brief">{{ article.brief }}</p>
      <router-link :to="{ name: 'ArticleDetail', params: { id: article.id } }">
        Читать далее
      </router-link>
    </div>

    <div class="pagination">
      <button
        @click="changePage(currentPage - 1)"
        :disabled="currentPage === 1"
      >
        Предыдущая
      </button>

      <span class="page-info">
        Страница {{ currentPage }} из {{ totalPages }}
      </span>

      <button
        @click="changePage(currentPage + 1)"
        :disabled="currentPage === totalPages"
      >
        Следующая
      </button>
    </div>

    <div class="per-page-selector">
      <label>Статей на страницу:</label>
      <select v-model="perPage" @change="handlePerPageChange">
        <option>5</option>
        <option>10</option>
        <option>15</option>
        <option>20</option>
      </select>
    </div>
  </div>
</template>

<script>
import axios from 'axios'

export default {
  data() {
    return {
      articles: {
        data: [],
        meta: {}
      },
      currentPage: 1,
      perPage: 5,
      totalPages: 1
    }
  },
  watch: {
    currentPage() {
      this.fetchArticles()
    }
  },
  async mounted() {
    await this.fetchArticles()
  },
  methods: {
    async fetchArticles() {
      try {
        const response = await axios.get('api/v1/article', {
          params: {
            page: this.currentPage,
            per_page: this.perPage
          }
        })

        this.articles = response.data.data
        this.totalPages = response.data.last_page
      } catch (error) {
        console.error('Error fetching articles:', error)
      }
    },
    changePage(newPage) {
      if (newPage > 0 && newPage <= this.totalPages) {
        this.currentPage = newPage
      }
    },
    handlePerPageChange() {
      this.currentPage = 1
      this.fetchArticles()
    }
  }
}
</script>

<style scoped>

div {
  max-width: 800px;
  margin: 0 auto;
  padding: 1.5rem 1rem;
  background-color: #f8f9fa;
}

h1 {
  text-align: center;
  font-size: 2.5rem;
  color: #2c3e50;
  margin-bottom: 2rem;
  padding-bottom: 1rem;
  border-bottom: 2px solid #e0e0e0;
}

.new-article {
  display: inline-block;
  margin: 1rem 0 2rem;
  padding: 0.8rem 1.5rem;
  background: #4299e1;
  color: white !important;
  border-radius: 6px;
  text-decoration: none;
  transition: transform 0.2s, box-shadow 0.2s;
  box-shadow: 0 2px 8px rgba(66, 153, 225, 0.2);
}

.new-article:hover {
  transform: translateY(-2px);
  box-shadow: 0 4px 12px rgba(66, 153, 225, 0.3);
}

.article-card {
  background: white;
  border-radius: 6px;
  padding: 0.8rem 1rem 0.6rem;
  margin-bottom: 0.5rem;
  box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
  border: 1px solid #eee;
}

.article-card:hover {
  transform: translateY(-3px);
  box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}

.article-card h2 {
  font-size: 1.1rem;
  margin-bottom: 0.3rem;
  line-height: 1.3;
  color: #2c3e50;
}

.author {
  color: #718096;
  font-size: 0.9rem;
  margin-bottom: 0.8rem;
  font-style: italic;
}

.brief {
  color: #4a5568;
  line-height: 1.3;
  margin-bottom: 0.3rem !important;
  display: -webkit-box;
  -webkit-box-orient: vertical;
  overflow: hidden;
}

.article-card a {
  font-size: 0.9rem;
  display: inline-block;
  margin-top: 0.4rem;
  padding: 0.1rem 0;
  padding: 0.2rem 0;
  color: #4299e1 !important;
  text-decoration: none;
  font-weight: 500;
  transition: color 0.2s;
}

.article-card a:hover {
  color: #3182ce !important;
}

.article-card a::after {
  content: "→";
  margin-left: 0.5rem;
  transition: margin 0.2s;
}

.article-card a:hover::after {
  margin-left: 0.8rem;
}

.pagination {
  margin: 1.5rem 0 1rem;
  gap: 1rem;
}

.pagination button {
  margin: 0 0.3rem;
  padding: 0.6rem 1.2rem;
  background: #4299e1;
  color: white;
  border: none;
  border-radius: 6px;
  cursor: pointer;
  transition: background 0.2s, transform 0.2s;
  font-size: 0.95rem;
}

.pagination button:hover:not(:disabled) {
  background: #3182ce;
  transform: translateY(-1px);
}

.pagination button:disabled {
  background: #cbd5e0;
  cursor: not-allowed;
  opacity: 0.7;
}

.page-info {
  color: #718096;
  font-size: 0.95rem;
  min-width: 140px;
  text-align: center;
}

.per-page-selector {
  margin: 2rem 0;
  text-align: center;
}

.per-page-selector label {
  color: #4a5568;
  margin-right: 0.5rem;
}

.per-page-selector select {
  padding: 0.4rem 0.8rem;
  border: 1px solid #e2e8f0;
  border-radius: 6px;
  background: white;
  color: #4a5568;
  transition: border-color 0.2s;
}

.per-page-selector select:hover {
  border-color: #cbd5e0;
}

.per-page-selector select:focus {
  outline: none;
  border-color: #4299e1;
  box-shadow: 0 0 0 2px rgba(66, 153, 225, 0.1);
}

.article-card > *:last-child {
  margin-bottom: 0;
}
@media (max-width: 768px) {
  div {
    padding: 1.5rem 1rem;
  }

  h1 {
    font-size: 2rem;
  }

  .article-card {
    padding: 1rem;
  }

  .pagination {
    flex-wrap: wrap;
    gap: 1rem;
    margin: 2rem 0;
  }

  .page-info {
    order: -1;
    width: 100%;
  }
}
</style>
