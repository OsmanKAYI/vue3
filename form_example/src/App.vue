<script setup>
import { RouterLink, RouterView } from 'vue-router'
import { useGlobalUserStore } from '@/stores/user'

const global = useGlobalUserStore()

</script>

<template>
  <header>
    <nav>
      <RouterLink to="/" style="margin-right: 15px">HOME</RouterLink>
      <RouterLink to="/about" style="margin-right: 15px">About</RouterLink>
      <RouterLink to="/login" style="margin-right: 15px" v-if="global.User.loggedIn == 0">Log In</RouterLink>
      <RouterLink to="/signup" style="margin-right: 15px" v-if="global.User.loggedIn == 0">Sign Up</RouterLink>
      <RouterLink to="/vuetify" style="margin-right: 15px">Vuetify</RouterLink>
    </nav>
  </header>

  <RouterView />
</template>

<style scoped></style>
