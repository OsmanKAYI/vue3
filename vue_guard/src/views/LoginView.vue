<script setup lang="ts">
import axios from 'axios';
import { reactive } from 'vue';
import jwtDecode from 'jwt-decode';
import router from '@/router';
import { useGlobalStore } from '@/stores/global';

const globalStore = useGlobalStore();

interface JwtPayload {
  sub: number
  exp: number
  name: string
}

const formData = reactive({
  username: '',
  password: ''
})

function login() {

  axios.post('/index.php', {
    method: 'login',
    user: formData
  })
    .then(function (response) {
      if (response.data.success) {
        const decoded = jwtDecode<JwtPayload>(response.data.token); // Returns with the JwtPayload type
        globalStore.login(response.data.token, decoded.sub, decoded.name);
        router.push({ name: 'welcome' });
        //console.log(decoded);
      } else {
        localStorage.removeItem('token');
        // localStorage.clear(); // clear all when logged out
        globalStore.user.isLoggedIn = false;
      }
      console.log(response);
    })
    .catch(function (error) {
      console.log(error);
    });

  //console.log(globalStore.isLoggedIn);

}

</script>

<template>
  <main>
    <h1>Welcome to LoginView</h1>

    <form autocomplete="off" @submit.prevent="login">

      <!-- Grid -->
      <div class="grid">

        <label for="username">
          Username
          <input type="text" v-model="formData.username" placeholder="Username">
        </label>

        <label for="password">Password
          <input type="password" v-model="formData.password" placeholder="Password">
          <small>Password must be at least 8 characters</small>
        </label>

      </div>

      <!-- Button -->
      <button @click="login" type="submit">Submit</button>

    </form>
  </main>
</template>
