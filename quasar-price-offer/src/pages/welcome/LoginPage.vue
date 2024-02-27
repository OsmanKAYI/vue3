<script setup lang="ts">
import { ref, reactive, computed } from 'vue'
import { useQuasar } from 'quasar'
const $q = useQuasar()

const btnTheme = computed(() => {
  return $q.dark.isActive ? 'bg-grey-5 text-black' : 'bg-grey-9 text-white';
})

const userForm = reactive({
  userName: '',
  password: '',
  rememberMe: true,
})

const isPwd = ref(true)

function onSubmit() {
  if (userForm.rememberMe == true) {
    $q.notify({
      color: 'green-4',
      textColor: 'white',
      icon: 'remember_me',
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

<template>
  <q-page class="q-pa-lg">
    <div class="q-gutter-md row">
      <q-card class="q-pa-md col-md-6 col-sm-9 col-xs-12">
        <q-form @submit="onSubmit">
          <div class="q-ml-md">

            <q-card-section>
              <div class="text-h6">WELCOME</div>
              <div class="text-subtitle1">Login Page</div>
            </q-card-section>

            <q-input filled v-model="userForm.userName" label="Username *" hint="will be used in login" lazy-rules
              :rules="[val => val && val.length > 0 || 'Please type something']">
              <template v-slot:prepend><q-icon name="face" color="grey" size="32px" /></template>
            </q-input>

            <q-input filled v-model="userForm.password" :type="isPwd ? 'password' : 'text'" label="Password *"
              hint="must be at least 8 characters" lazy-rules
              :rules="[val => val && val.length > 0 || 'Password must be at least 8 characters']">
              <template v-slot:prepend><q-icon name="vpn_key" color="grey" size="32px" /></template>
              <template v-slot:append>
                <q-icon :name="isPwd ? 'visibility_off' : 'visibility'" class="cursor-pointer" @click="isPwd = !isPwd" />
              </template>
            </q-input>
          </div>

          <q-toggle v-model="userForm.rememberMe" label="Remember me!" />

          <div class="row q-mt-md">
            <q-btn :class="btnTheme" label="Login" type="submit" to="/home" />
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
