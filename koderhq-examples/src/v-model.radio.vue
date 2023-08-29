<template>
  <p>Rate this lesson: {{ rating }}</p>

  <label><input type="radio" name="rating" value="Bad" v-model="rating" />Bad</label><br>
  <label><input type="radio" name="rating" value="Okay" v-model="rating" />Okay</label><br>
  <label><input type="radio" name="rating" value="Good" v-model="rating" />Good</label>
</template>

<script>
export default {
  data() {
    return {
      rating: ''
    }
  }
}
</script>
