<template>
  <p>{{ name }} ({{ job }})</p>
  <button @click="changeName('Veysel Kayı'), changeJob('Officer')">Change name</button>
</template>

<script>
export default {
  data() {
    return {
      name: 'Osman Kayı',
      job: 'Civil Engineer'
    }
  },

  methods: {
    changeName(name) {
      this.name = name
    },
    changeJob(job) {
      this.job = job
    }
  }
}
</script>
