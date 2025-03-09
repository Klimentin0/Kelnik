import axios from 'axios';

const apiClient = axios.create({
    baseURL: 'http://api/api/v1',
    headers: {
        'Content-Type': 'application/json',
    }
});

export default {
    async getArticles(limit = 5) {
        return apiClient.get('/articles', {
          params: { limit }
        });
    },

    async getArticle(id) {
        return apiClient.get(`/articles/${id}`);
    },

    async createArticle(articleData) {
        return apiClient.post('/articles', articleData);
    },

    async updateArticle(id, articleData) {
        return apiClient.put(`/articles/${id}`, articleData);
    },

    async deleteArticle(id) {
        return apiClient.delete(`/articles/${id}`);
    }
};
