import { createRouter, createWebHistory } from 'vue-router'
import HomePage from "@/views/HomePage.vue";

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomePage,
    },
    {
      path: '/auth/sign-in',
      name: 'sign-in',
      component: () => import('../views/auth/SignInPage.vue'),
    },
    {
      path: '/transactions',
      name: 'transactions',
      component: () => import('../views/transaction/TransactionsPage.vue'),
    },
  ],
})

export default router
