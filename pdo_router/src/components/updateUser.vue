<template>
  <h1>Update User</h1>
  <table border="1" cellpadding="10" cellspacing="0" width="500">
    <tr>
      <th>ID</th>
      <th>Name</th>
      <th>EMail</th>
    </tr>
    <tr>
      <td nowrap>{{ editUser.id }}</td>
      <td nowrap><input type="text" v-model="editUser.name" /></td>
      <td nowrap><input type="text" v-model="editUser.email" /></td>
    </tr>
  </table>
  <button @click="updateUser">Update</button>
</template>

<script setup>
import { reactive } from "vue";
import fetchUsers from "./listUser.vue";

const editUser = reactive({});

const clearForm = () => {
  editUser.id = "";
  editUser.name = "";
  editUser.email = "";
};

const updateUser = () => {
  const formData = new FormData();
  formData.append("VERI", JSON.stringify(editUser));

  fetch("http://localhost/vue3/pdo.php/update.php", {
    method: "post",
    body: formData,
  })
    .then((response) => response.json())
    .then((json) => {
      console.log(json);
      clearForm();
      fetchUsers();
    });
};
</script>
