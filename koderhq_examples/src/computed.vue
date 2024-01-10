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

  <hr>

  <p>Num: {{ num }}</p>
  <button @click="incrementNum">Increment</button>
</template>

<script>
export default {
  data() {
    return {
      firstName: '',
      lastName: '',
      num: 0
    }
  },

  methods: {
    incrementNum() { this.num++ }
  },

  computed: {
    fullName() {
      console.log('Re-evaluating fullName')
      return this.firstName + '' + this.lastName
    }
  }
}
</script>
