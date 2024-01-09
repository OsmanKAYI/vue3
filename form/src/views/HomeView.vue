<script setup>
import { useGlobalStore } from '@/stores/global'
const global = useGlobalStore()
</script>

<template>
  <main>
    <h1>Welcome to HelloView</h1>
    <p>Username: {{ global.userName }}</p>
    <p>Counter: {{ global.count }}</p>
  </main>
</template>
