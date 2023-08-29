<template>
  <p>Countries Visited: {{ visited.join(', ') }}</p>

  <select multiple v-model="visited">
    <option value="">Please select your country</option>
    <option value="TR">Türkiye</option>
    <option value="IQ">Iraq</option>
    <option value="IR">Iran</option>
    <option value="UAE">United Arab Emirates</option>
  </select>
</template>

<script>
export default {
  data() {
    return {
      visited: []
    }
  }
}
</script>
