<script setup>
import busSeat from '@/components/busSeat.vue'
</script>

<template>
  <h1>Welcome to BusSeatView</h1>
  <main style="width: 600px;">
    <bus-seat gender="F" seatNumber="10" />
    <bus-seat gender="M" seatNumber="11" />
    <bus-seat gender="" seatNumber="12" />
    <bus-seat gender="B" seatNumber="12" />
    <bus-seat seatNumber="12" />
  </main>
</template>
