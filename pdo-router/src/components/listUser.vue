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
      <tr v-for="user in users" :key="user.id">
        <td>{{ user.id }}</td>
        <td nowrap>{{ user.name }}</td>
        <td nowrap>{{ user.email }}</td>
        <td>
          <RouterLink :to="`/update/${user.id}`">Edit1</RouterLink> &nbsp;
          <RouterLink :to="{ name: 'update', params: { id: user.id } }"
            >Edit2</RouterLink
          >
        </td>
      </tr>
    </table>
  </div>
</template>

<script setup>
import { ref, onMounted } from "vue";

const users = ref([]);

const fetchUsers = () => {
  fetch("http://localhost/vue3/pdo.php/list.php")
    .then((result) => result.json())
    .then((json) => {
      users.value = json;
      //console.log(json);
    });
};
onMounted(() => {
  fetchUsers();
  //console.log("evet");
});
</script>
