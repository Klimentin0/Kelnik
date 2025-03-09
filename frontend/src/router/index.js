import { createRouter, createWebHistory } from 'vue-router'
import ArticleList from '@/components/ArticleList.vue'
import ArticleDetail from '@/components/ArticleDetail.vue'
import CreateArticle from '@/components/CreateArticle.vue'
import EditArticle from '@/components/EditArticle.vue'

const routes = [
  { path: '/', name: 'ArticleList', component: ArticleList },
  { path: '/article/new', name: 'CreateArticle', component: CreateArticle },
  { path: '/article/:id', name: 'ArticleDetail', component: ArticleDetail },
  { path: '/article/edit/:id', name: 'EditArticle', component: EditArticle },
]

const router = createRouter({
  history: createWebHistory(),
  routes
})

export default router
