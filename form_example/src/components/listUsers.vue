<script setup>
import { onMounted, ref, computed, reactive } from 'vue';
import axios from 'axios';

const users = ref([]);
const fields = ['ID', 'Name', 'TC', 'Age', 'Email', 'City', 'Courses', 'Password'];
const myCities = ref([]);
const myCourses = ref([]);

const activeUsers = computed(() => users.value.filter(user => user.is_active == 1));

const update = ref(false);
const updateUserForm = reactive({
  user: {},
});

onMounted(async () => {
  try {
    const citiesResponse = await axios.get('http://localhost/vue3/form_example/api/get.php?method=get.cities');
    myCities.value = citiesResponse.data;

    const coursesResponse = await axios.get('http://localhost/vue3/form_example/api/get.php?method=get.courses');
    myCourses.value = coursesResponse.data;

    const userResponse = await axios.get('http://localhost/vue3/form_example/api/get.php?method=get.users');
    users.value = userResponse.data;
  } catch (error) {
    console.error(error);
  }
});

function deleteUser(user) {
  try {
    const response = axios.get(`http://localhost/vue3/form_example/api/get.php?method=delete.user&id=${user.id}`);
    console.log('Deleted User Response:', response.data);
    user.is_active = 0;
  } catch (error) {
    console.error(error);
  }
}

function showUpdateForm(user) {
  update.value = true;
  updateUserForm.user = user; //{ ...user, city: user.city, courses: user.courses }; // Create a copy of the user for form editing
}


function updateUser() {
  try {
    console.log('updateUserForm.user');
    const response = axios.post(`http://localhost/vue3/form_example/api/get.php?method=update.user&id=${updateUserForm.user.id}`, {
      ...updateUserForm.user
    });

    if (updateUserForm.user.courses) {
      updateUserForm.user.courses = updateUserForm.user.courses.join(',');
    }
    console.log('Updated User Response:', response.data);
    // Optionally, update the local user data based on the server response
    // You may need to handle this according to your server's response structure

    update.value = false; // Hide the update form after successful update
  } catch (error) {
    console.error(error);
  }
}
</script>

<template>
  <div>
    <form v-if="update" method="post">
      Username: <input type="text" v-model="updateUserForm.user.name" />
      TC: <input type="text" v-model="updateUserForm.user.tc" />
      Age: <input type="text" v-model="updateUserForm.user.age" />
      Email: <input type="email" v-model="updateUserForm.user.email" />

      City:
      <select v-model="updateUserForm.user.city">
        <option v-for="city in myCities" :key="city.id" :value="city.id">{{ city.name }}</option>
      </select>

      <label>
        Courses
        <select v-model="updateUserForm.user.courses" multiple>
          <option v-for="course in myCourses" :key="course.id" :value="course.id"
            :selected="updateUserForm.user.courses.includes(course.id)">{{
              course.name }}</option>
        </select>
        <small>Select max of 3 courses</small>
      </label>

      Password: <input type="text" v-model="updateUserForm.user.password" />
      <button @click.prevent="updateUser">Update</button>
    </form>

    <table v-if="!update">
      <thead>
        <tr>
          <th v-for="field in fields" :key="field">{{ field }}</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="user in activeUsers" :key="user.id">
          <td v-for="field in fields" :key="field">{{ user[field.toLowerCase()] }}</td>
          <td> <button @click="deleteUser(user)">Delete</button> </td>
          <td> <button @click="showUpdateForm(user)">Update</button> </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>