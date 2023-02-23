<template>
  <h1>Register</h1>
  <table border="1" cellpadding="10" cellspacing="0" width="500">
    <tr>
      <th>Name</th>
      <th>EMail</th>
    </tr>
    <tr>
      <td nowrap><input type="text" v-model="newUser.name" /></td>
      <td nowrap><input type="text" v-model="newUser.email" /></td>
    </tr>
  </table>
  <button @click="addUser">Register</button>
</template>

<script setup>
import { reactive } from "vue";
import fetchUsers from "./listUser.vue";

const newUser = reactive({
  name: "",
  email: "",
});

const clearForm = () => {
  newUser.name = "";
  newUser.email = "";
};

const addUser = () => {
  const formData = new FormData();
  formData.append("VERI", JSON.stringify(newUser));

  fetch("http://localhost/vue3/pdo.php/insert.php", {
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
