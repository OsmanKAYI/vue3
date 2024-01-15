<script setup>
import { RouterLink, RouterView } from 'vue-router'
import { useGlobalUserStore } from '@/stores/user'

const global = useGlobalUserStore()

</script>

<template>
  <header>
    <div class="container">
      <nav>
        <ul>
          <li>
            <RouterLink to="/" style="margin-right: 15px">HOME</RouterLink>
          </li>
        </ul>
        <ul>
          <li>
            <RouterLink to="/about" style="margin-right: 15px">About</RouterLink>
          </li>
        </ul>
        <ul>
          <li>
            <RouterLink to="/login" style="margin-right: 15px" v-if="global.User.loggedIn == 0">Log In</RouterLink>
          </li>
        </ul>
        <ul>
          <li>
            <RouterLink to="/signup" style="margin-right: 15px" v-if="global.User.loggedIn == 0">Sign Up</RouterLink>
          </li>
        </ul>
      </nav>
    </div>
  </header>

  <RouterView />
</template>

<style scoped></style>
