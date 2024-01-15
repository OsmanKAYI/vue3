import { defineStore } from 'pinia'

export const useGlobalUserStore = defineStore('user', () => {
  const User = {}
  const isLoggedIn = 0

  return { User, isLoggedIn }
})
