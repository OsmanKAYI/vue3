<template>
  <header>
    <div>
      <nav>
        <RouterLink to="/"><b>Users</b></RouterLink>
        <RouterLink to="/help"><b>Help</b></RouterLink> &nbsp;
        <RouterLink to="/update"><b>Update User Informations</b></RouterLink>
        <RouterLink to="/delete"><b>Delete User</b></RouterLink>
      </nav>

      <listUser />
      <updateUser />
      <registerUser />
      <deleteUser />
    </div>
  </header>
</template>

<script setup>
import { RouterLink, RouterView } from "vue-router";
import listUser from "./components/listUser.vue";
import registerUser from "./components/registerUser.vue";
import updateUser from "./components/updateUser.vue";
import deleteUser from "./components/deleteUser.vue";
</script>

<style scoped></style>
