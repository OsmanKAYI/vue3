<template>
  <q-layout view="hHh lpr fff">
    <q-header elevated>
      <q-toolbar class="glossy">

        <q-btn flat to="/">
          <q-avatar size="lg">
            <img src="https://cdn.quasar.dev/logo-v2/svg/logo-mono-white.svg">
          </q-avatar>
          <q-toolbar-title> Price Offer </q-toolbar-title>
        </q-btn>

        <div class="q-gutter-md">
          <q-btn flat icon="home" to="/" label="Home"></q-btn>
          <q-btn flat icon="info" to="/about" label="About"></q-btn>
          <q-btn flat icon="person" to="/register" label="Register"></q-btn>
          <q-btn flat icon="login" to="/login" label="Login"></q-btn>
        </div>

      </q-toolbar>
    </q-header>

    <q-page-container>
      <router-view />
    </q-page-container>
  </q-layout>
</template>

<script setup lang="ts">
</script>
