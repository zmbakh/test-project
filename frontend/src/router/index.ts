import { createRouter, createWebHistory } from 'vue-router'
import HomePage from "@/views/HomePage.vue";
import {useUserStore} from "@/stores/user.ts";
import NotFound from "@/views/error/NotFound.vue";

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      meta: { auth: true },
      component: HomePage,
    },
    {
      path: '/auth/sign-in',
      name: 'sign-in',
      meta: { guest: true },
      component: () => import('../views/auth/SignInPage.vue'),
    },
    {
      path: '/transactions',
      name: 'transactions',
      meta: { auth: true },
      component: () => import('../views/transaction/TransactionsPage.vue'),
    },
    {
      path: '/:pathMatch(.*)*',
      component: NotFound,
    },
  ],
})

router.beforeEach((to, from, next) => {
  const userStore = useUserStore()

  if (to.meta.auth && !userStore.token) {
    next('/auth/sign-in')
  } else if (to.meta.guest && userStore.token) {
    next('/')
  } else {
    next()
  }
})


export default router
