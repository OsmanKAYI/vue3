import { RouteRecordRaw } from 'vue-router';

const routes: RouteRecordRaw[] = [
  {
    path: '/',
    component: () => import('layouts/welcome/WelcomeLayout.vue'),
    children: [
      { path: '', component: () => import('pages/welcome/IndexPage.vue') },
      {
        path: 'about',
        component: () => import('pages/welcome/AboutPage.vue'),
      },
      {
        path: 'register',
        component: () => import('pages/welcome/RegisterPage.vue'),
      },
      {
        path: 'login',
        component: () => import('pages/welcome/LoginPage.vue'),
      },
    ],
  },
  {
    path: '/home',
    component: () => import('layouts/main/MainLayout.vue'),
    children: [
      { path: '', component: () => import('pages/main/IndexPage.vue') },
      {
        path: 'offer/create',
        component: () => import('pages/main/OfferCreatePage.vue'),
      },
      {
        path: 'offer/show/:id',
        component: () => import('components/OfferShow.vue'),
      },
      {
        path: 'pictures',
        component: () => import('pages/main/PicturesPage.vue'),
      },
    ],
  },

  // Always leave this as last one,
  // but you can also remove it
  {
    path: '/:catchAll(.*)*',
    component: () => import('pages/welcome/ErrorNotFound.vue'),
  },
];

export default routes;
