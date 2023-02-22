<template>
  <div>
    <h1>örnek</h1>

    <h1>Kullanıcı Ekle</h1>
    <table border="1" cellpadding="10" cellspacing="0" width="500">
      <tr>
        <th>Name</th>
        <th>EMail</th>
      </tr>
      <tr>
        <td nowrap><input type="text" v-model="newName" /></td>
        <td nowrap><input type="text" v-model="newEmail" /></td>
      </tr>
    </table>
    <button @click="addUser">Register</button>

    <p>{{ newName }}</p>

    <h1>KAYITLI KULLANICILAR</h1>
    <table border="1" cellpadding="10" cellspacing="0" width="500">
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>EMail</th>
      </tr>
      <tr v-for="user in users">
        <td>{{ user.id }}</td>
        <td nowrap>{{ user.name }}</td>
        <td nowrap>{{ user.email }}</td>
      </tr>
    </table>
  </div>
</template>

<script setup>
import { ref, reactive, onMounted } from "vue";

const users = ref([]);
const newName = ref("");
const newEmail = ref("");

const newUser = reactive({
  newName: "",
  newEmail: "",
});

const clearForm = () => {
  newName.value = "";
  newEmail.value = "";
};
const addUser = () => {
  // console.log(newName.value);
  const formData = new FormData();
  formData.append("name", newName.value);
  formData.append("email", newEmail.value);

  fetch("http://localhost/vue3/pdo.php/insert.php", {
    method: "post",
    body: formData,
  })
    .then((response) => response.json())
    .then((json) => {
      //console.log(json);
      fetchUsers();
      // alert(json.message);
      clearForm();
    });
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
  // console.log('evet')
});
</script>

<style scoped></style>
