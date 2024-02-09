import { RouteRecordRaw } from 'vue-router';

const routes: RouteRecordRaw[] = [
  {
    path: '/',
    component: () => import('layouts/main/MainLayout.vue'),
    children: [
      { path: '', component: () => import('pages/main/IndexPage.vue') },
      {
        path: 'home',
        component: () => import('pages/main/HomePage.vue'),
      },
      {
        path: 'about',
        component: () => import('pages/main/AboutPage.vue'),
      },
      {
        path: 'register',
        component: () => import('pages/main/RegisterPage.vue'),
      },
      {
        path: 'login',
        component: () => import('pages/main/LoginPage.vue'),
      },
    ],
  },
  {
    path: '/login',
    component: () => import('layouts/login/LoginLayout.vue'),
    children: [
      { path: '', component: () => import('pages/login/IndexPage.vue') },
      { path: 'help', component: () => import('pages/login/HelpPage.vue') },
    ],
  },

  // Always leave this as last one,
  // but you can also remove it
  {
    path: '/:catchAll(.*)*',
    component: () => import('pages/main/ErrorNotFound.vue'),
  },
];

export default routes;
