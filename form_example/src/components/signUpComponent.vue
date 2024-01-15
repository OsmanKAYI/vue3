<script setup>
import { useGlobalUserStore } from '@/stores/user'
import axios from 'axios'
import { ref } from 'vue';

const global = useGlobalUserStore()
const error = ref('');
const done = ref('');

async function signUpForm() {
  // Reset messages
  error.value = '';
  done.value = '';

  // Check if any of the required fields is empty
  if (!global.User.name || !global.User.tc || !global.User.age || !global.User.email || !global.User.city || !global.User.courses || !global.User.password) {
    error.value = 'Please fill out all required fields.';
    return;
  }

  try {
    // Access to this.user provides access to the user object within the store
    const response = await axios.post('http://localhost/vue3/form_example/api/signUp.php', global.User);
    done.value = 'Form submitted successfully!';
    console.log('Successfully sent:', response.data);
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
      <p style="color: green">{{ done }}</p>
      <!-- <alert v-if="done">{{ done }}</alert> -->
      <p style="color: red">{{ error }}</p>
      <!-- <alert v-if="error">{{ error }}</alert> -->
    </hgroup>
    <form @submit.prevent="signUpForm" autocomplete="off">
      <div class="grid">
        <label for="username">
          Name
          <input type="text" v-model="global.User.name" id="username" placeholder="username" required />
        </label>
        <div class="grid">
          <label for="tc">
            TC
            <input type="text" v-model="global.User.tc" name="tc" id="tc" placeholder="identity number" required />
          </label>
          <label for="age">
            Age
            <input type="number" v-model="global.User.age" name="age" id="age" placeholder="age" min="0" required />
          </label>
        </div>
      </div>
      <div class="grid">
        <label for="email">
          Email
          <input type="email" v-model="global.User.email" name="email" id="email" placeholder="email" required />
          <small>We'll never share your email with anyone else.</small>
        </label>
        <label for="password">
          Password
          <input type="password" v-model="global.User.password" name="password" id="password" placeholder="password"
            required />
        </label>
      </div>
      <div class="grid">
        <label for="city">
          City
          <input type="combo" v-model="global.User.city" name="city" id="city" placeholder="city" required />
        </label>
        <label for="courses">
          Courses
          <input type="multiple" v-model="global.User.courses" name="courses" id="courses" placeholder="courses"
            required />
        </label>
      </div>
      <!-- Button -->
      <button class="submit" type="submit">Sign Up</button>
    </form>
  </main>
</template>
