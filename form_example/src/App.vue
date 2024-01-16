<script setup>
import { RouterView } from 'vue-router'
import navBarComponent from '@/components/navBarComponent.vue'


</script>

<template>
  <header>
    <div class="container">
      <navBarComponent />
    </div>
  </header>

  <RouterView />
</template>

<style scoped></style>
