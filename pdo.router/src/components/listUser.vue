<template>
  <div id="list">
    <h1>Users List</h1>
    <table border="1" cellpadding="10" cellspacing="0" width="500">
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>EMail</th>
        <th>İşlem</th>
      </tr>
      <tr v-for="user in users">
        <td>{{ user.id }}</td>
        <td nowrap>{{ user.name }}</td>
        <td nowrap>{{ user.email }}</td>
        <td>
          <input type="button" @click="btnEditUser(user)" value="Edit" />
        </td>
      </tr>
    </table>
  </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import editUser from "./updateUser.vue";

const users = ref([]);

const btnEditUser = (user) => {
  Object.assign(editUser, user);
};

const fetchUsers = () => {
  fetch("http://localhost/vue3/pdo.php/list.php")
    .then((result) => result.json())
    .then((json) => {
      users.value = json;
      console.log(json);
    });
};
onMounted(() => {
  fetchUsers();
  //console.log("evet");
});
</script>
