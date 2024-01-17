<script setup>
import router from '@/router';
import { useGlobalUserStore } from '@/stores/user'

const global = useGlobalUserStore()

function logOutMe() {
  global.isLoggedIn = 0;
  router.push({ name: 'login' });
}
</script>

<template>
  <div>
    <p>Hello from About Component</p>

    <button @click="logOutMe">Log Out</button>
  </div>
</template>
