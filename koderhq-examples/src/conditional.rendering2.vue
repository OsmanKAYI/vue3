<template>
  <template v-if="displayNotice">
    <h2>Notice</h2>
    <p>Thank you for noticing this notice</p>
  </template>
</template>

<script>
export default {
  data() {
    return {
      displayNotice: true
    }
  }
}
</script>
