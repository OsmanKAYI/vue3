<script setup lang="ts">
import { ref } from 'vue'
import { useQuasar } from 'quasar'

const $q = useQuasar()

const fullName = ref('')
const username = ref('')
const email = ref('')
const age = ref('')
const accept = ref(false)
const password = ref('')

function onSubmit() {
  if (accept.value !== true) {
    $q.notify({
      color: 'red-5',
      textColor: 'white',
      icon: 'warning',
      message: 'You need to accept the license and terms first'
    })
  }
  else {
    $q.notify({
      color: 'green-4',
      textColor: 'white',
      icon: 'cloud_done',
      message: 'Submitted'
    })
  }
}

function validateEmail(val: string) {
  // Regular expression for email validation
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

  // Check if the input matches the email format
  if (emailRegex.test(val)) {
    return true; // Valid email
  } else {
    return 'Please enter a valid email address'; // Invalid email
  }
}
</script>

<template>
  <q-page class="q-pa-lg">
    <div class="q-gutter-md row">
      <q-card class="q-pa-md col-md-6 col-sm-9 col-xs-12">
        <q-form @submit="onSubmit">
          <div class="q-ml-md">

            <q-card-section>
              <div class="text-h6">WELCOME</div>
              <div class="text-subtitle1">Register Page</div>
            </q-card-section>

            <q-input filled v-model="fullName" label="Full Name *" hint="name and surname" lazy-rules
              :rules="[val => val && val.length > 0 || 'Please type something']">
              <template #prepend><q-icon name="account_circle" color="grey" size="32px" /></template>
            </q-input>

            <q-input filled v-model="username" label="Username *" hint="will be used in login" lazy-rules
              :rules="[val => val && val.length > 0 || 'Please type something']">
              <template #prepend><q-icon name="face" color="grey" size="32px" /></template>
            </q-input>

            <q-input filled v-model="email" label="Email *" hint="will be used to confim your account" lazy-rules
              :rules="[validateEmail]">
              <template #prepend><q-icon name="mail" color="grey" size="32px" /></template>
            </q-input>

            <q-input filled type="number" v-model="age" label="Age" lazy-rules :rules="[
              val => val !== null && val !== '' || 'Please type your age',
              val => val > 0 && val < 100 || 'Please type a real age'
            ]">
              <template #prepend><q-icon name="cake" color="grey" size="32px" /></template>
            </q-input>

            <q-input filled type="password" v-model="password" label="Password *" hint="must be at least 8 characters"
              lazy-rules :rules="[val => val && val.length > 0 || 'Password must be at least 8 characters']">
              <template #prepend><q-icon name="vpn_key" color="grey" size="32px" /></template>
            </q-input>
          </div>

          <q-toggle v-model="accept" label="I accept the license and terms" />

          <div class="row q-mt-md">
            <q-btn label="Register" type="submit" color="primary" />
          </div>
        </q-form>
      </q-card>
    </div>
  </q-page>
</template>

<style scoped lang="css">
div {
  justify-items: center;
  justify-content: center;
}
</style>
