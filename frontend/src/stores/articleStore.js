import { defineStore } from 'pinia';
import articleService from '@/api/articleService';

export const useArticleStore = defineStore('articles', {
    state: () => ({
        articles: [],
        currentArticle: null
    }),
    actions: {
        async fetchArticles(limit = 5) {
            try {
                const response = await articleService.getArticles(limit);
                this.articles = response.data.data;
            } catch (error) {
                console.error('Error fetching articles:', error);
            }
        },
        async fetchArticle(id) {
            try {
                const response = await articleService.getArticle(id);
                this.currentArticle = response.data.data;
            } catch (error) {
                console.error('Error fetching article:', error);
            }
        }
    }
});
