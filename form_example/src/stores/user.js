import { defineStore } from 'pinia'

export const useGlobalUserStore = defineStore('user', () => {
  const User = {
    city: '0' // Set the default value to '0'
  }
  const isLoggedIn = 0

  return { User, isLoggedIn }
})
