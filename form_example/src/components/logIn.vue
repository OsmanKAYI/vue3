<script setup>
import router from '@/router';
import { useGlobalUserStore } from '@/stores/user';
import axios from 'axios';
import { reactive } from 'vue';

const global = useGlobalUserStore();
const message = reactive({
  hasError: false,
  text: ''
});
async function logInForm() {
  // Reset messages
  message.text = '';

  // Check if any of the required fields is empty
  if (!global.User.name || !global.User.password) {
    message.text = 'Please fill out all required fields.';
    return;
  }

  try {
    const response = await axios.post('http://localhost/vue3/form_example/api/logIn.php', global.User, { headers: { 'Content-Type': 'application/json' } });
    console.log('response', response.data);
    global.isLoggedIn = 0;
    if (response.data.success) {
      // Set the user as logged in
      global.isLoggedIn = 1;
      router.push({ name: 'about' });
    } else {
      message.text = 'Invalid credentials.';
    }
  } catch (err) {
    message.text = 'An error occurred.';
    console.error(message, err);
  }
}
</script>

<template>
  <main class="container">
    <hgroup>
      <h1>
        <slot />
      </h1>
      <p v-if="message.text" style="color: red">{{ message.text }}</p>
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
