<script setup>
import { RouterLink, useRoute } from 'vue-router';
import router from '@/router'; // Change the import statement to import the router
import { useGlobalUserStore } from '@/stores/user';
const global = useGlobalUserStore();

// Helper function to convert string to Pascal Case
const toPascalCase = (str) => {
  return str ? str.charAt(0).toUpperCase() + str.slice(1) : '';
};

const getTo = (route) => {
  const fullPath = useRoute().fullPath;
  if (route.name) {
    return fullPath === '/' && route.name === 'home' ? '/' : `/${toPascalCase(route.name)}`;
  }
  return { path: '' };
};

</script>

<template>
  <div>
    <nav>
      <ul>
        <li v-for="route in router.options.routes" :key="route.name">
          <RouterLink
            v-if="route.meta && ((global.isLoggedIn && route.meta.showLoggedIn) || (!global.isLoggedIn && route.meta.showNotLoggedIn))"
            :to="getTo(route)" style="margin-right: 15px">{{ toPascalCase(route.name) }}</RouterLink>
        </li>
      </ul>
    </nav>
  </div>
</template>

<style scoped></style>