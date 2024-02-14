<script setup lang="ts">
import { ref, reactive, computed } from 'vue'
import { useQuasar } from 'quasar'
const $q = useQuasar()
import { date } from 'quasar'
const currentDate = date.formatDate(Date.now(), 'YYYY-MM-DDTHH:mm:ss.SSSZ')

let person = reactive({
  fullName: '',
  userName: '',
  email: '',
  birthDate: '',
  accept: false,
  password: '',
})

const tempDate = ref(currentDate)
const isPwd = ref(true)

let btnTheme = computed(() => {
  return $q.dark.isActive ? 'bg-grey-5 text-black' : 'bg-grey-9 text-white';
})

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

function updateDate() {
  tempDate.value = person.birthDate
}

function saveDate() {
  person.birthDate = tempDate.value
}

let passType = computed(() => {
  return isPwd.value ? 'password' : 'text'
})
let passIcon = computed(() => {
  return isPwd.value ? 'visibility_off' : 'visibility'
})

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
</script>

<template>
  <q-page class="q-pa-lg q-mt-xl">
    <div class="q-gutter-md row">
      <q-card class="q-pa-md col-md-6 col-sm-9 col-xs-12">
        <q-form @submit="onSubmit">
          <div class="q-ml-md">

            <q-card-section>
              <div class="text-h6">WELCOME</div>
              <div class="text-subtitle1">Register Page</div>
            </q-card-section>

            <q-input filled v-model="person.fullName" label="Full Name *" hint="name and surname" lazy-rules
              :rules="[val => val && val.length > 0 || 'Please type something']">
              <template #prepend><q-icon name="account_circle" color="grey" size="32px" /></template>
            </q-input>

            <q-input filled v-model="person.userName" label="Username *" hint="will be used in login" lazy-rules
              :rules="[val => val && val.length > 0 || 'Please type something']">
              <template #prepend><q-icon name="face" color="grey" size="32px" /></template>
            </q-input>

            <q-input filled v-model="person.email" label="Email *" hint="will be used to confim your account" lazy-rules
              :rules="[validateEmail]">
              <template #prepend><q-icon name="mail" color="grey" size="32px" /></template>
            </q-input>

            <q-input filled v-model="person.birthDate" label="Birth Date *" mask="date" :rules="['birthDate']">
              <template #prepend><q-icon name="celebration" color="grey" size="32px" /></template>
              <template v-slot:append>
                <q-icon name="event" class="cursor-pointer">
                  <q-popup-proxy @before-show="updateDate" cover transition-show="scale" transition-hide="scale">
                    <q-date v-model="tempDate">
                      <div class="row items-center justify-end q-gutter-sm">
                        <q-btn :class="btnTheme" label="Cancel" flat v-close-popup />
                        <q-btn :class="btnTheme" label="OK" flat @click="saveDate" v-close-popup />
                      </div>
                    </q-date>
                  </q-popup-proxy>
                </q-icon>
              </template>
            </q-input>

            <q-input filled v-model="person.password" :type="passType" label="Password *"
              hint="must be at least 8 characters" lazy-rules
              :rules="[val => val && val.length > 0 || 'Password must be at least 8 characters']">
              <template v-slot:prepend><q-icon name="vpn_key" color="grey" size="32px" /></template>
              <template v-slot:append>
                <q-icon :name="passIcon" class="cursor-pointer" @click="isPwd = !isPwd" />
              </template>
            </q-input>
          </div>

          <q-toggle v-model="person.accept" label="I accept the license and terms" />

          <div class="row q-mt-md">
            <q-btn :class="btnTheme" label="Register" type="submit" />
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
