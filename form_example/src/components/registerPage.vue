<script setup>
//import router from '@/router';
import { useGlobalUserStore } from '@/stores/user'
import axios from 'axios';
import { ref, reactive, onMounted } from 'vue';
import globalMessage from './globalMessage.vue';

const global = useGlobalUserStore();

const message = reactive({
  hasError: false,
  text: '',
});

const registered = ref(false);
const myCities = ref([]);
const myCourses = ref([]);

onMounted(async () => {
  try {
    const citiesResponse = await axios.get('http://localhost/vue3/form_example/api/get.php?method=get.cities');
    myCities.value = citiesResponse.data;

    const coursesResponse = await axios.get('http://localhost/vue3/form_example/api/get.php?method=get.courses');
    myCourses.value = coursesResponse.data;
  } catch (error) {
    console.error(error);
  }
});

async function registerForm() {
  try {
    const response = await axios.post('http://localhost/vue3/form_example/api/register.php', global.User);
    message.hasError = false;
    message.text = 'You have signed up successfully!';
    registered.value = true;
    console.log('Successfully sent:', response.data);
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

    <globalMessage v-if="registered" toPage="login" btnMessage="Go to Login Page" messageType="success">
      Successfully registered !!!
    </globalMessage>

    <form v-if="!registered" form @submit.prevent="registerForm" autocomplete="off">
      <article data-theme="ligth">
        <div class="grid">
          <label>
            Name
            <input type="text" v-model="global.User.name" placeholder="username" />
          </label>
          <div class="grid">
            <label>
              TC
              <input type="text" v-model="global.User.tc" placeholder="identity number" />
            </label>
            <label>
              Age
              <input type="number" v-model="global.User.age" placeholder="age" min="0" />
            </label>
          </div>
        </div>
        <div class="grid">
          <label>
            Email
            <input type="email" v-model="global.User.email" placeholder="email" />
            <small>We'll never share your email with anyone else.</small>
          </label>
          <label>
            Password
            <input type="password" v-model="global.User.password" placeholder="password" />
          </label>
        </div>
        <div class="grid">
          <label>
            City
            <select v-model="global.User.city">
              <option value="0" selected>
                ** Select **
              </option>
              <option v-for="city in myCities" :key="city" :value="city.id"> {{ city.name }} </option>
            </select>
          </label>
          <details class="dropdown">
            Courses
            <summary>
              Select your courses ...
            </summary>
            <select v-model="global.User.courses">
              <option v-for="course in myCourses" :key="course" :value="course.id">{{ course.name }}</option>
            </select>
            <small>Select max of 3 courses</small>
          </details>
        </div>
      </article>
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
