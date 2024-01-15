<script setup>
import { useGlobalUserStore } from '@/stores/user';
import axios from 'axios';
import { ref } from 'vue';

const global = useGlobalUserStore();
const error = ref('');
const done = ref('');

async function logInForm() {
  // Reset messages
  error.value = '';
  done.value = '';

  // Check if any of the required fields is empty
  if (!global.User.name || !global.User.password) {
    error.value = 'Please fill out all required fields.';
    return;
  }

  try {
    const response = await axios.post('http://localhost/vue3/form_example/api/login.php', global.User, { headers: { 'Content-Type': 'application/json' } });

    if (response.data.success) {
      done.value = 'Login successful!';
      // Set the user as logged in
      global.User.loggedIn = 1;
    } else {
      error.value = 'Invalid credentials.';
    }
  } catch (err) {
    error.value = 'An error occurred.';
    console.error(error, err);
  }
}
</script>

<template>
  <main class="container">
    <hgroup>
      <h1>
        <slot />
      </h1>
      <p style="color: red">{{ error }}</p>
      <!-- <alert v-if="error">{{ error }}</alert> -->
    </hgroup>
    <div>
      <form @submit.prevent="logInForm">
        Username:<input type="text" v-model="global.User.name" id="username" placeholder="username" /> <br>
        Password :<input type="password" v-model="global.User.password" name="password" id="password"
          placeholder="password" /> <br>
        <button class="submit" type="submit">Log In</button>
      </form>
    </div>

  </main>
</template>
