<template>
  <h1>{{ greeting() }}</h1>
</template>

<script>
export default {
  methods: {
    greeting() {
      return 'Hello there'
    }
  }
}
</script>
