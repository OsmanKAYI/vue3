<template>
  <p v-if="num === 0">The number is 0</p>
  <p v-else-if="num > 0">The number is positive</p>
  <p v-else-if="num < 0">The number is negative</p>
  <p v-else>The value is not a number</p>
</template>

<script>
export default {
  data() {
    return {
      num: 'Osman Kayı'
    }
  }
}
</script>
