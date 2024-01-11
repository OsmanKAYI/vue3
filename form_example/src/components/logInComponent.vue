<script setup>
import { useGlobalUserStore } from '@/stores/user'
import axios from 'axios'
import { ref } from 'vue';

const global = useGlobalUserStore()
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
    // Access to this.user provides access to the user object within the store
    await axios.post('http://localhost/vue3/form_example/api/user.php', global.User);
    done.value = 'Login successful!';
  } catch (err) {
    error.value = 'An error occurred.';
    console.error(error, err);
  }
}

</script>

<template>
  <main>

    <div>
      <form @submit.prevent="logInForm">
        <p class="error" v-if="error">{{ error }}</p>
        Username:<input type="text" v-model="global.User.name" id="username" placeholder="username" /> <br>
        Password :<input type="password" v-model="global.User.password" name="password" id="password"
          placeholder="password" /> <br>
        <button class="submit" type="submit">Submit</button>
        <p class="done" v-if="done">{{ done }}</p>
      </form>
    </div>

  </main>
</template>


<style scoped>
form {
  background-color: rgb(147, 153, 151);
  margin: 30px;
  border: 3px solid black;
  place-content: center;
  padding: 10px;
  border-radius: 10px;
}

input {
  margin: 5px;
  background-color: rgb(229, 230, 241);
  border: 1px solid black;
  align-content: center;
  border-radius: 5px;
}

.submit {
  background-color: rgb(212, 16, 16);
  color: white;
  border: 1px solid black;
}

.error {
  color: red;
}

.done {
  color: green;
}
</style>