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
  <main>

    <div>
      <form @submit.prevent="signUpForm">
        <p class="error" v-if="error">{{ error }}</p>
        Username:<input type="text" v-model="global.User.name" id="username" placeholder="username" /> <br>
        TC :<input type="text" v-model="global.User.tc" name="tc" id="tc" placeholder="tc" /> <br>
        Age :<input type="number" v-model="global.User.age" name="age" id="age" placeholder="age" min="0" /> <br>
        EMail :<input type="email" v-model="global.User.email" name="email" id="email" placeholder="email" /> <br>
        City :<input type="combo" v-model="global.User.city" name="city" id="city" placeholder="city" /> <br>
        Courses :<input type="multiple" v-model="global.User.courses" name="courses" id="courses" placeholder="courses" />
        <br>
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