<template>
  <p>Lazy First Name: {{ firstName }}</p>
  <input type="text" v-model.lazy="firstName">

  <p>Realtime Lirst Name: {{ lastName }}</p>
  <input type="text" v-model="lastName">
</template>

<script>
export default {
  data() {
    return {
      firstName: '',
      lastName: ''
    }
  }
}
</script>
