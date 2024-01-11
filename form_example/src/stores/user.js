import { defineStore } from 'pinia'

export const useGlobalUserStore = defineStore('user', () => {
  const User = {
    loggedIn: 0
  }

  return { User }
})
