<script setup>
import { useGlobalUserStore } from '@/stores/user'
import axios from 'axios'

const global = useGlobalUserStore()

async function submitForm() {
  try {
    // Access to this.user provides access to the user object within the store
    const response = await axios.post('http://localhost/vue3/form_example/api/user.php', global.User);
    console.log('Successfully sent:', response.data);
    // Additional actions can be performed upon successful completion of the request
  } catch (error) {
    console.error('An error occurred:', error);
    // Appropriate handling can be done in case of an error
  }
}

</script>

<template>
  <main>

    <p>Please fill out the form</p>

    <div>
      <form @submit.prevent="submitForm">
        Username:<input type="text" v-model="global.User.name" id="username" placeholder="username" /> <br>
        TC :<input type="text" v-model="global.User.tc" name="tc" id="tc" placeholder="tc" /> <br>
        Age :<input type="number" v-model="global.User.age" name="age" id="age" placeholder="age" min="0" /> <br>
        EMail :<input type="email" v-model="global.User.email" name="email" id="email" placeholder="email" /> <br>
        City :<input type="combo" v-model="global.User.city" name="city" id="city" placeholder="city" /> <br>
        Courses :<input type="multiple" v-model="global.User.courses" name="courses" id="courses" placeholder="courses" />
        <br>
        <button class="submit" type="submit">Submit</button>
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
</style>