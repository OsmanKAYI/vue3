<script setup>
import { onMounted, ref, computed } from 'vue';
import axios from 'axios';

const users = ref([]);
const fields = ['ID', 'Username', 'TC', 'Email', 'City', 'Courses', 'Password'];

const activeUsers = computed(() => users.value.filter(user => user.isActive == 1));

onMounted(async () => {
  try {
    const userResponse = await axios.get('http://localhost/vue3/form_example/api/get.php?method=get.users');
    users.value = userResponse.data;
  } catch (error) {
    console.error(error);
  }
});

function deleteUser(user) {
  try {
    const response = axios.get(`http://localhost/vue3/form_example/api/get.php?method=delete.user&id=${user.id}`);
    console.log('Delete User Response:', response.data);
    user.isActive = 0;
    // Update the users array to reflect the deletion
    /*
    const index = users.value.findIndex(user => user.id === id);
    if (index !== -1) {
      users.value.splice(index, 1);
    }
    */
  } catch (error) {
    console.error(error);
  }
}
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
        <tr v-for="user in activeUsers" :key="user.id">
          <td v-for="field in fields" :key="field">{{ user[field.toLowerCase()] }}</td>
          <td> <button @click="deleteUser(user)">Delete</button> </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>