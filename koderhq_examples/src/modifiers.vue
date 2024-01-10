<template>
  <p>{{ counter }}</p>
  <button @click.right="increment">Increment</button>
  <button @click="decrement">Decrement</button>

  <form @submit.prevent="submitForm">
    <p>
      <button>Submit Form</button>
    </p>
  </form>
</template>

<script>
export default {
  data() {
    return { counter: 0 }
  },

  methods: {
    submitForm() {
      /*event.preventDefault()*/
      alert('The form was submitted')
    },
    increment() { this.counter++ },
    decrement() { this.counter-- }
  }
}
</script>
