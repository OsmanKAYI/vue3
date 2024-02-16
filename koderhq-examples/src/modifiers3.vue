<template>
  <!-- This will work even if Shift and another key is pressed-->
  <p><button @click.shift="shiftAnyHandler">Shift + Any + Click</button></p>

  <!-- This will only work when Shift and no other keys are pressed-->
  <p><button @click.shift.exact="shiftOnlyHandler">Shift + Click Only</button></p>


  <!-- This will only work when no key modifiers are pressed-->
  <p><button @click.exact="clickOnlyHandler">Click Only</button></p>
</template>

<script>
export default {
  methods: {
    shiftAnyHandler() { alert('Shift + Any + Click') },
    shiftOnlyHandler() { alert('Shift + Click Only') },
    clickOnlyHandler() { alert('Click Only') }
  }
}
</script>
