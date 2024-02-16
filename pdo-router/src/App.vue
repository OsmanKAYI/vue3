<template>
  <header>
    <div>
      <nav>
        <RouterLink to="/"><b>Home</b></RouterLink> &nbsp;
        <RouterLink to="/help"><b>Help</b></RouterLink> &nbsp;
      </nav>

      <RouterView></RouterView>
    </div>
  </header>
</template>

<script setup>
import { RouterLink, RouterView } from "vue-router";
</script>

<style scoped></style>
