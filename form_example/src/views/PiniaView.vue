<script setup>
import { useGlobalUserStore } from '@/stores/global'
const global = useGlobalUserStore()
</script>

<template>
  <main>
    <h1>Welcome to PiniaView</h1>
    <button @click="global.count++">Artır</button>
    <h3>global.counter adedi:</h3>
    {{ global.count }}
  </main>
</template>
