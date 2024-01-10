import { defineStore } from 'pinia'

export const useGlobalUserStore = defineStore('user', () => {
  const User = {}

  return { User }
})
