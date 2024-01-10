<template>
  <p>Full Name: {{ fullName }}</p>
  <button @click="changeName">Change Name</button>
</template>

<script>
export default {
  data() {
    return {
      firstName: 'Osman',
      lastName: 'Kayı',
    }
  },

  methods: {
    changeName() { this.fullName = 'Furkan Kayı' }
  },

  computed: {
    fullName: {
      get() {
        return this.firstName + ' ' + this.lastName
      },
      set(value) {
        const names = value.split(' ')
        this.firstName = names[0]
        this.lastName = names[1]
      }
    }
  }
}
</script>
