<template>
  <p>Full Name: {{ fullName }}</p>
  <p>
    <label for="firstName">First Name:</label>
    <input id="firstName" type="text" v-model="firstName">
  </p>
  <p>
    <label for="lastName">Last Name:</label>
    <input id="lastName" type="text" v-model="lastName">
  </p>
</template>

<script>
export default {
  data() {
    return {
      firstName: '',
      lastName: '',
      fullName: ''
    }
  },

  watch: {
    firstName(newValue) {
      this.fullName = newValue + ' ' + this.lastName
    },
    lastName(newValue) {
      this.fullName = this.firstName + ' ' + newValue
    }
  }
}
</script>
