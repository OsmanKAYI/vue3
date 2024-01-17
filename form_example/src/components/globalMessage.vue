<script setup>
import router from '@/router';
import { computed } from 'vue';

const props = defineProps({
  messageType: {
    type: String,
    default: ''
  },
  toPage: {
    type: String,
    default: 'home'
  },
  btnMessage: {
    type: String,
    default: 'Go to Home Page'
  }
})

const computedStyle = computed(() => {
  if (props.messageType == 'success') {
    return 'success';
  } if (props.messageType == 'error') {
    return 'error';
  }
  return '';
})
</script>

<template>
  <h1 v-if="messageType" :class="computedStyle">
    <slot />
  </h1>

  <button @click="router.push({ name: props.toPage });"> {{ btnMessage }} </button>
</template>

<style scoped>
.success {
  color: green;
}

.error {
  color: red;
}
</style>