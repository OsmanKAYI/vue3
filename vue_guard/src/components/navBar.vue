<script setup lang="ts">
import { RouterLink } from 'vue-router';
import type { RouteRecordRaw } from 'vue-router';
import router from '@/router/index'
import routes from '@/router/index';
import { useGlobalStore } from '@/stores/global';

const globalStore = useGlobalStore();

const myRoutes = routes.options.routes;

function shouldShowRoute(route: RouteRecordRaw) {
  const requiresAuth = route.meta && route.meta.requiresAuth;
  const isShown = route.meta && route.meta.isShown;
  return (requiresAuth && globalStore.user.isLoggedIn && isShown) || (!requiresAuth && !globalStore.user.isLoggedIn && isShown);
}

function toPascalCase(str: string): string {
  return str.replace(/(\w)(\w*)/g, (_, firstChar, rest) => firstChar.toUpperCase() + rest.toLowerCase());
}

function logOut() {
  globalStore.logout();
  router.push({ name: 'home' })
}
</script>

<template>
  <nav>
    <ul>
      <li @click="$router.push({ name: 'home' })"><strong>Price Offer</strong></li>
    </ul>
    <ul>
      <li v-for="route in myRoutes" :key="route.path">
        <RouterLink v-if="shouldShowRoute(route)" :to="route.path">
          {{ typeof route.name === 'string' ? toPascalCase(route.name) : '' }}
        </RouterLink>
      </li>
      <a href="#" role="button" class="contrast" style="background-color: red;" v-if="globalStore.user.isLoggedIn"
        @click="logOut">Log Out</a>
    </ul>
  </nav>
</template>

