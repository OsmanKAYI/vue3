<template>
  <p>Your name: {{ name }}</p>
  <input type="text" @keyup.enter="getConfirmedInput">
</template>

<script>
export default {
  data() {
    return {
      name: '',
    }
  },

  methods: {
    getConfirmedInput(event) {
      this.name = event.target.value
    }
  }
}
</script>
