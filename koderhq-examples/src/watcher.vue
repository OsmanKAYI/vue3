<template>
  <p>Counter: {{ count }}</p>

  <button @click="count++">Increment</button>
  <button @click="count--">Decrement</button>
</template>

<script>
export default {
  data() {
    return {
      count: 0
    }
  },

  watch: {
    count(newValue, oldValue) {
      if (newValue > oldValue && newValue === 5) {
        alert('Inreasing the volume past 5 may damage your hearing !!!')
      }
    }
  }
}
</script>
