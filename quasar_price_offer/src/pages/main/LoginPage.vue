<template>
  <q-page class="q-pa-lg">
    <div class="q-gutter-md row justify-center">
      <q-card class="q-pa-md col-md-6 col-sm-9 col-xs-12">
        <q-form @submit="onSubmit">
          <div class="q-ml-sm items-center">

            <q-card-section>
              <div class="text-h6">LOGIN</div>
              <div class="text-subtitle1">Login Page</div>
            </q-card-section>

            <q-input filled v-model="username" label="Username *" hint="will be used in login" lazy-rules
              :rules="[val => val && val.length > 0 || 'Please type something']">
              <template v-slot:prepend><q-icon name="face" color="grey" size="32px" /></template>
            </q-input>

            <q-input filled type="password" v-model="password" label="Password *" hint="must be at least 8 characters"
              lazy-rules :rules="[val => val && val.length > 0 || 'Password must be at least 8 characters']">
              <template v-slot:prepend><q-icon name="vpn_key" color="grey" size="32px" /></template>
            </q-input>
          </div>

          <q-toggle v-model="rememberMe" label="Remember me!" />

          <div class="row justify-center q-mt-md">
            <q-btn label="Login" type="submit" color="primary" />
          </div>
        </q-form>
      </q-card>
    </div>
  </q-page>
</template>

<script setup lang="ts">
import { ref } from 'vue'
import { useQuasar } from 'quasar'

const $q = useQuasar()

const username = ref('')
const rememberMe = ref(false)
const password = ref('')

function onSubmit() {
  if (rememberMe.value == true) {
    $q.notify({
      color: 'yellow-5',
      textColor: 'black',
      icon: 'warning',
      message: 'Logged in successfully with remember me!'
    })
  } else {
    $q.notify({
      color: 'green-4',
      textColor: 'white',
      icon: 'cloud_done',
      message: 'Logged in successfully'
    })
  }
}
</script>
