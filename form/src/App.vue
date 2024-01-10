<script setup>
import { RouterLink, RouterView } from 'vue-router'
</script>

<template>
  <header>
    <nav>
      <RouterLink to="/" style="margin-right: 15px">Home</RouterLink>
      <RouterLink to="/about" style="margin-right: 15px">About</RouterLink>
      <RouterLink to="/pinia" style="margin-right: 15px">Pinia</RouterLink>
      <RouterLink to="/vuetify" style="margin-right: 15px">Vuetify</RouterLink>
      <RouterLink to="/busSeat" style="margin-right: 15px">Seats</RouterLink>
    </nav>
  </header>

  <RouterView />
</template>

<style scoped></style>
