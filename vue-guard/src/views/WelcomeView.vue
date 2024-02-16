<script setup lang="ts">
import { useGlobalStore } from '@/stores/global';

const globalStore = useGlobalStore();

</script>

<template>
  <main v-if="globalStore.user.isLoggedIn">
    <h3>Welcome {{ globalStore.user.name }}</h3>
  </main>
</template>


