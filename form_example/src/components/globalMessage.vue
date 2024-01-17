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
  if (props.messageType == 'success' || props.messageType == 'error') {
    return props.messageType;
  }
  return '';
})
</script>

<template>
  <h3 v-if="messageType" :class="computedStyle">
    <slot />
  </h3>

  <button v-if="toPage" @click="router.push({ name: props.toPage });"> {{ btnMessage }} </button>
</template>

<style scoped>
.success {
  color: green;
}

.error {
  color: red;
}
</style>