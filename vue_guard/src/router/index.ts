import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '@/views/HomeView.vue'
import AboutView from '@/views/AboutView.vue'
import LoginView from '@/views/LoginView.vue'
import WelcomeView from '@/views/WelcomeView.vue'
import NotFoundView from '@/views/NotFoundView.vue'
import { useGlobalStore } from '@/stores/global'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeView,
      alias: ['/home'],
      meta: {
        isShown: 1,
        requiresAuth: true
      }
    },
    {
      path: '/about',
      name: 'about',
      component: AboutView,
      meta: {
        isShown: 1,
        requiresAuth: false
      }
    },
    {
      path: '/login',
      name: 'login',
      component: LoginView,
      meta: {
        isShown: 1,
        requiresAuth: false
      }
    },
    {
      path: '/welcome',
      name: 'welcome',
      component: WelcomeView,
      meta: {
        isShown: 0,
        requiresAuth: true
      }
    },
    {
      // path: "*",
      path: '/:catchAll(.*)',
      name: 'notfound',
      component: NotFoundView,
      meta: {
        isShown: 0,
        requiresAuth: false
      }
    }
  ]
})

router.beforeEach((to, from, next) => {
  const globalStore = useGlobalStore() // you should define global store here because of the calling order
  if (to.meta.requiresAuth) {
    if (globalStore.isLoggedIn) {
      //if (localStorage.getItem('token')) {
      next()
    } else {
      next({ name: 'login' })
    }
  } else {
    next()
  }
})

export default router
