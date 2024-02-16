<script setup>
import { RouterView } from 'vue-router'
import navBar from '@/components/navBar.vue'


</script>

<template>
  <header>
    <div class="container">
      <navBar />
    </div>
  </header>

  <RouterView />
</template>

<style scoped></style>
