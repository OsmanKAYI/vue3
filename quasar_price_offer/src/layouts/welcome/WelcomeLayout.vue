<script setup lang="ts">
import { ref, computed } from 'vue'
import { useQuasar } from 'quasar'
const $q = useQuasar()

const drawer = ref(false);
const drawerWidth = ref(300);
const drawerBreakpoint = ref(400);
let myTheme = computed(() => {
  return $q.dark.isActive ? 'glossy bg-grey-7 text-white' : 'glossy bg-grey-5 text-black';
})

const menuList = [
  {
    icon: 'home',
    label: 'Home',
    to: '/',
    separator: false
  },
  {
    icon: 'info',
    label: 'About',
    to: '/about',
    separator: true
  },
  {
    icon: 'person',
    label: 'Register',
    to: '/register',
    separator: false
  },
  {
    icon: 'login',
    label: 'Login',
    to: '/login',
    separator: false
  }
]
</script>

<template>
  <q-layout view="hHh lpr fff" class="shadow-2 rounded-borders">
    <q-header elevated :class="myTheme">
      <q-toolbar bordered>
        <q-btn flat @click="drawer = !drawer" round dense icon="menu" />
        <q-btn flat to="/">
          <q-avatar size="lg">
            <img src="https://cdn.quasar.dev/logo-v2/svg/logo-mono-white.svg">
          </q-avatar>
          <q-toolbar-title> Price Offer </q-toolbar-title>
        </q-btn>

        <q-btn flat class="q-ml-auto" @click="$q.dark.toggle()" round dense icon="dark_mode" />

      </q-toolbar>

    </q-header>

    <q-drawer v-model="drawer" :width="drawerWidth" :breakpoint="drawerBreakpoint" overlay bordered :class="myTheme">
      <q-scroll-area class="fit" style=" height: calc(100% - 150px); margin-top: 150px; border-right: 1px solid #ddd">
        <q-list>

          <template v-for="(menuItem, index) in menuList" :key="index">
            <q-item clickable :active="menuItem.label === 'Outbox'" v-ripple :to="menuItem.to">
              <q-item-section avatar>
                <q-icon :name="menuItem.icon" />
              </q-item-section>
              <q-item-section>
                {{ menuItem.label }}
              </q-item-section>
            </q-item>
            <q-separator :key="'sep' + index" v-if="menuItem.separator" />
          </template>

        </q-list>
      </q-scroll-area>

      <q-img class="absolute-top" src="https://cdn.quasar.dev/img/material.png" style="height: 150px">
        <div class="absolute-bottom bg-transparent">
          <q-avatar size="56px" class="q-mb-sm">
            <img
              src="https://0.gravatar.com/avatar/834de371b1d5dd047e85bb3c7470d703e407cb7b73e2794ad549a6ee2a2e969b?size=256">
          </q-avatar>
          <div class="text-weight-bold">Welcome Dear Guest</div>
          <div>@priceoffer</div>
        </div>
      </q-img>

    </q-drawer>

    <q-page-container>
      <router-view />
    </q-page-container>

  </q-layout>
</template>

<style scoped lang="scss"></style>
