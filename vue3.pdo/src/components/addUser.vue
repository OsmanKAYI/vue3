<script setup>

defineProps({
	title: {
    type: String,
    required: true
  },
	addUser: {
		type: Boolean,
		value: false
	}
})

</script>


<template>

  <div>
    <h1>{{ title }}</h1>

		<pre>
    <b>User Name:</b> <input type="text" v-model="name"><br>
    <b>eMail:    </b> <input type="text" v-model="email"><br>
    <button @click="register">REGISTER</button>
</pre>

    <p><a href='listUser.vue'>Homepage</a></p>
  </div>

</template>


<style scoped>

</style>
