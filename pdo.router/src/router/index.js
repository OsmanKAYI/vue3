import { createRouter, createWebHistory } from "vue-router";

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: "/",
      name: "list",
      component: () => import("../views/listView.vue"),
    },
    {
      path: "/register",
      name: "register",
      component: () => import("../views/registerView.vue"),
    },
    {
      path: "/update",
      name: "update",
      component: () => import("../views/updateView.vue"),
    },
    {
      path: "/delete",
      name: "delete",
      component: () => import("../views/deleteView.vue"),
    },
    {
      path: "/help",
      name: "help",
      component: () => import("../views/helpView.vue"),
    },
  ],
});

export default router;
