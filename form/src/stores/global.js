import { ref } from 'vue'
import { defineStore } from 'pinia'

export const useGlobalStore = defineStore('counter', () => {
  const userName = ref('Osman Kayı')
  const count = ref(0)

  return { userName, count }
})
