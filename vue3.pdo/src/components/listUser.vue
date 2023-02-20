
<script>

export default {
  data() {
    return {
      users: [],
      title: "aaa",

    }
  },
  computed: {
  //
  },
  watch: {
//
  },
  methods: {
    //
  },
  mounted() {


    fetch("http://localhost/vue3.pdo.php/list.php")
    .then(result => result.json())
    .then( json => {
        console.log(json)
    }
    )
  }

}

</script>


<template>

  <div>
    <h1>{{ title }}</h1>


    <button click="addUser">Register</button>
    

    <table border='1' cellpadding='10' cellspacing='0' width='500'>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>EMail</th>
        </tr>
        <tr v-for="user in users">
            <td>{{user.id}}</td>
            <td nowrap>{{user.name}}</td>
            <td nowrap>{{user.email}}</td>
        </tr>
    </table>

  </div>

</template>


<style scoped>

</style>
