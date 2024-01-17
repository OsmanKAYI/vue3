import { createRouter, createWebHistory } from 'vue-router'
import { useGlobalUserStore } from '@/stores/user'

import HomeView from '../views/HomeView.vue'
import AboutView from '../views/AboutView.vue'
import LogInView from '../views/LogInView.vue'
import RegisterView from '../views/RegisterView.vue'
import NotFoundView from '../views/NotFoundView.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeView,
      meta: {
        requiresAuth: false, // If session control is required for this page, make it true
        showLoggedIn: true,
        showNotLoggedIn: true
      }
    },
    {
      path: '/about',
      name: 'about',
      component: AboutView,
      meta: {
        requiresAuth: true,
        showLoggedIn: true,
        showNotLoggedIn: false
      }
    },
    {
      path: '/login',
      name: 'login',
      component: LogInView,
      meta: {
        requiresAuth: false,
        showLoggedIn: false,
        showNotLoggedIn: true
      }
    },
    {
      path: '/register',
      name: 'register',
      component: RegisterView,
      meta: {
        requiresAuth: false,
        showLoggedIn: false,
        showNotLoggedIn: true
      }
    },
    {
      path: '/notfound',
      name: 'notfound',
      component: NotFoundView,
      meta: {
        requiresAuth: false,
        showLoggedIn: false,
        showNotLoggedIn: false
      }
    },
    // default redirect
    {
      path: '/:pathMatch(.*)*',
      redirect: '/'
    }
  ]
})

// Function to be used as middleware
const checkAuthentication = (to, from, next) => {
  const global = useGlobalUserStore()

  if (to.matched.some((record) => record.meta.requiresAuth)) {
    // If session control is required for this page
    if (!global.isLoggedIn) {
      // If the user is not logged in, redirect to the login page
      next({
        name: 'login',
        query: { redirect: to.fullPath }
      })
    } else {
      // Allow the page if the user is logged in
      next()
    }
  } else {
    // Allow page that does not require session control
    next()
  }
}

router.beforeEach(checkAuthentication)

export default router
