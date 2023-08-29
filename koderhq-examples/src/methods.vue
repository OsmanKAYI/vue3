<template>
  <!--<h1>{{ greeting() }}</h1>-->
  <h1>{{ greeting('Osman KAYI') }}</h1>
</template>

<script>
/*
export default {
  data() {
    return {
      username: 'Osman'
    }
  },
  methods: {
    greeting() {
      return 'Hello there ' + this.username
    }
  }
}
*/
export default {
  methods: {
    greeting(username) {
      return 'Help us ' + username
    }
  }
}
</script>
