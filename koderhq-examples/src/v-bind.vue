<template>
  <h2>Hello from {{ userObj.fName }} {{ userObj.lName }}</h2>
  <h2>Hello from {{ userArr[0] }} {{ userArr[1] }}</h2>

  <a v-bind:href="link">Osman KAYI</a>
  or
  <a :href="link">Osman KAYI</a>

  <br>

  <button :disabled="isDisabled">Boolean Attribute Binding</button>
</template>

<script>
export default {
  data() {
    return {
      userObj: { fName: 'Osman', lName: 'KAYI' },
      userArr: ['Osman', 'KAYI'],
      link: 'https://osmankayi.com',
      isDisabled: false,
    }
  }
}
</script>