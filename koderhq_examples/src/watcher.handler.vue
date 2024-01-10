<template>
  <p>Title: <input type="text" v-model="film.title"></p>
  <p>Director: <input type="text" v-model="film.director"></p>
</template>

<script>
export default {
  data() {
    return {
      film: {
        title: '',
        director: ''
      }
    }
  },

  watch: {
    film: {
      handler(newValue) {
        console.log('Film: ' + newValue.title + ', directed by ' + newValue.director)
      },
      deep: true,
      immediate: true
    }
  }
}
</script>
