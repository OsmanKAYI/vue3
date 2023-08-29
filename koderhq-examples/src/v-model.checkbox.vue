<template>
  <p>Done: {{ shoppingList.join(', ') }}</p>

  <label><input type="checkbox" value="Bread" v-model="shoppingList">Bread</label><br>
  <label><input type="checkbox" value="Milk" v-model="shoppingList">Milk</label><br>
  <label><input type="checkbox" value="Eggs" v-model="shoppingList">Eggs</label>
</template>

<script>
export default {
  data() {
    return {
      shoppingList: []
    }
  }
}
</script>
