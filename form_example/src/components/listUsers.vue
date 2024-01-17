<script setup>
import { onMounted, ref } from 'vue';
import axios from 'axios';

const users = ref([]);
const fields = ['ID', 'Username', 'TC', 'Email', 'City', 'Courses', 'Password', 'Edit/Delete'];

onMounted(async () => {
  try {
    const userResponse = await axios.get('http://localhost/vue3/form_example/api/get.php?method=get.users');
    users.value = userResponse.data;
  } catch (error) {
    console.error(error);
  }
});

</script>

<template>
  <div>
    <table>
      <thead>
        <tr>
          <th v-for="field in fields" :key="field">{{ field }}</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="user in users" :key="user.id">
          <td v-for="field in fields" :key="field">{{ user[field.toLowerCase()] }}</td>
        </tr>
      </tbody>
    </table>
  </div>
</template>