<script setup>
defineProps({
  title: {
    type: String,
    required: true,
  },
  updateUser: {
    type: Boolean,
    value: false,
  },
});
</script>

<template>
  <div>
    <h1>{{ title }}</h1>
  </div>
</template>

<style scoped></style>
