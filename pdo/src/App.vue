<template>
  <div>
    <h1>örnek</h1>

    <h1>Sil</h1>
    <table border="1" cellpadding="10" cellspacing="0" width="500">
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>EMail</th>
      </tr>
      <tr>
        <td nowrap>{{ EDITUser.id }}</td>
        <td nowrap>{{ EDITUser.name }}</td>
        <td nowrap>{{ EDITUser.email }}</td>
      </tr>
    </table>
    <button @click="deleteUser">Delete</button>

    <h1>Düzenle</h1>
    <table border="1" cellpadding="10" cellspacing="0" width="500">
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>EMail</th>
      </tr>
      <tr>
        <td nowrap>{{ EDITUser.id }}</td>
        <td nowrap><input type="text" v-model="EDITUser.name" /></td>
        <td nowrap><input type="text" v-model="EDITUser.email" /></td>
      </tr>
    </table>
    <button @click="updateUser">Update</button>

    <h1>Kullanıcı Ekle</h1>
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

    <h1>KAYITLI KULLANICILAR</h1>
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
        <td><input type="button" @click="btnEditUser(user)" value="Edit" /></td>
      </tr>
    </table>
  </div>
</template>

<script setup>
import { ref, reactive, onMounted } from "vue";

const users = ref([]);

const EDITUser = reactive({});

const newUser = reactive({
  name: "",
  email: "",
});

const clearForm = () => {
  newUser.name = "";
  newUser.email = "";
  EDITUser.id = "";
  EDITUser.name = "";
  EDITUser.email = "";
};

const btnEditUser = (user) => {
  Object.assign(EDITUser, user);
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
      fetchUsers();
      clearForm();
    });
};

const updateUser = () => {
  const formData = new FormData();
  formData.append("VERI", JSON.stringify(EDITUser));

  fetch("http://localhost/vue3/pdo.php/update.php", {
    method: "post",
    body: formData,
  })
    .then((response) => response.json())
    .then((json) => {
      console.log(json);
      fetchUsers();
    });
};

const deleteUser = () => {
  const formData = new FormData();
  formData.append("VERI", JSON.stringify(EDITUser));

  fetch("http://localhost/vue3/pdo.php/delete.php", {
    method: "post",
    body: formData,
  })
    .then((response) => response.json())
    .then((json) => {
      console.log(json);
      fetchUsers();
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
