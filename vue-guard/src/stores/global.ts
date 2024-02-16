import { defineStore } from 'pinia'
import { computed, reactive } from 'vue'

interface User {
  id: number
  name: string
  isLoggedIn: boolean
}

export const useGlobalStore = defineStore('global', () => {
  // stage variables
  const user = reactive<User>({ id: 0, name: '', isLoggedIn: false })
  // const user = reactive({ id: 0 as number, name: '' as string, isLoggedIn: false as boolean }) // use it without interface

  // computed variables
  const isLoggedIn = computed(() => user.isLoggedIn)

  // methods/actions
  function login(utoken: string, uid: number, uname: string) {
    localStorage.setItem('token', utoken)
    user.id = uid
    user.name = uname
    user.isLoggedIn = true
  }

  function logout() {
    user.id = 0
    user.name = ''
    user.isLoggedIn = false
    localStorage.removeItem('token')
    localStorage.clear()
  }

  return { user, isLoggedIn, login, logout }
})

/*
//  OPTIONS API
//  OPTIONS API
//  OPTIONS API

import { defineStore } from 'pinia'

export const useGlobalStore = defineStore({
  id: 'global',
  state: () => ({
    user: {
      id: 0,
      name: '',
      isLoggedIn: false // initial value
    }
  }),
  actions: {
    login(utoken: string, uid: number, uname: string) {
      localStorage.setItem('token', utoken)
      this.user = { id: uid, name: uname, isLoggedIn: true }
    },
    logout() {
      this.user = { id: 0, name: '', isLoggedIn: false }
      localStorage.removeItem('token')
      localStorage.clear()
    }
  }
})
*/
