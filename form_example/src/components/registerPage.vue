<script setup>
//import router from '@/router';
import { useGlobalUserStore } from '@/stores/user'
import axios from 'axios'
import { ref, reactive } from 'vue';

import globalMessage from './globalMessage.vue';

const global = useGlobalUserStore()
const message = reactive({
  hasError: false,
  text: ''
});
const registered = ref(false);

async function registerForm() {
  /*
    // Check if any of the fields is empty
    if (!global.User.name || !global.User.tc || !global.User.age || !global.User.email || !global.User.city || !global.User.courses || !global.User.password) {
      message.hasError = true;
      message.text = 'Please fill out all fields.';
      return;
    }
  */
  try {
    // Access to this.user provides access to the user object within the store
    const response = await axios.post('http://localhost/vue3/form_example/api/register.php', global.User);
    message.hasError = false;
    message.text = 'You have signed up successfully!';
    registered.value = true;
    console.log('Successfully sent:', response.data);

    /*
    // Wait for 2-3 seconds before redirecting to the login page
    setTimeout(() => {
      router.push({ name: 'login' });
    }, 2000); // Adjust the delay as needed (in milliseconds)
    */
  } catch (err) {
    message.hasError = true;
    message.text = 'An error occurred.';
    console.error(message, err);
  }
}

</script>

<template>
  <main class="container">

    <h1>
      <slot />
    </h1>

    <globalMessage v-if="registered" toPage="login" btnMessage="Go to Login Page" messageType="success"> Successfully
      registered !!!
    </globalMessage>

    <form v-if="!registered" form @submit.prevent="registerForm" autocomplete="off">
      <div class="grid">
        <label for="username">
          Name
          <input type="text" v-model="global.User.name" id="username" placeholder="username" />
        </label>
        <div class="grid">
          <label for="tc">
            TC
            <input type="text" v-model="global.User.tc" name="tc" id="tc" placeholder="identity number" />
          </label>
          <label for="age">
            Age
            <input type="number" v-model="global.User.age" name="age" id="age" placeholder="age" min="0" />
          </label>
        </div>
      </div>
      <div class="grid">
        <label for="email">
          Email
          <input type="email" v-model="global.User.email" name="email" id="email" placeholder="email" />
          <small>We'll never share your email with anyone else.</small>
        </label>
        <label for="password">
          Password
          <input type="password" v-model="global.User.password" name="password" id="password" placeholder="password" />
        </label>
      </div>
      <div class="grid">
        <label for="city">
          City
          <input type="combo" v-model="global.User.city" name="city" id="city" placeholder="city" />
        </label>
        <label for="courses">
          Courses
          <input type="multiple" v-model="global.User.courses" name="courses" id="courses" placeholder="courses" />
        </label>
      </div>
      <!-- Button -->
      <button class="submit" type="submit">Sign Up</button>
    </form>
  </main>
</template>

<style scoped>
.error {
  color: red;
}

.success {
  color: green;
}
</style>