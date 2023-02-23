<template>
  <h1>Delete User</h1>
  <table border="1" cellpadding="10" cellspacing="0" width="500">
    <tr>
      <th>ID</th>
      <th>Name</th>
      <th>EMail</th>
    </tr>
    <tr>
      <td nowrap>{{ editUser.id }}</td>
      <td nowrap>{{ editUser.name }}</td>
      <td nowrap>{{ editUser.email }}</td>
    </tr>
  </table>
  <button @click="deleteUser">Delete</button>
</template>

<script setup>
import fetchUsers from "./listUser.vue";
import editUser from "./updateUser.vue";

const deleteUser = () => {
  const formData = new FormData();
  formData.append("VERI", JSON.stringify(editUser));

  fetch("http://localhost/vue3/pdo.php/delete.php", {
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
