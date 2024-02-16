<template>
  <p>Your name: {{ name }}</p>
  <input type="text" @input="getInput($event, 'Kayı')">
</template>

<script>
export default {
  data() {
    return {
      name: '',
    }
  },

  methods: {
    getInput(event, lastName) {
      this.name = event.target.value + ' ' + lastName
    }
  }
}
</script>
