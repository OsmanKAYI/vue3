<script setup lang="ts">
import { ref, reactive, computed } from 'vue'
import { useQuasar } from 'quasar'
const $q = useQuasar()
import { date } from 'quasar'
const currentDate = date.formatDate(Date.now(), 'YYYY-MM-DDTHH:mm:ss.SSSZ')
import { useVuelidate, ValidationRule } from '@vuelidate/core';
import { required, email, minLength, sameAs } from '@vuelidate/validators';

const btnTheme = computed(() => {
  return $q.dark.isActive ? 'bg-grey-5 text-black' : 'bg-grey-9 text-white';
})

const userForm = reactive({
  fullName: '',
  userName: '',
  email: '',
  birthday: '',
  password: '',
  terms: false
})

// Define a custom validation rule to check if a given date string is a valid date
const isValidDate: ValidationRule = (value: string) => {
  // Use JavaScript's built-in Date object to check if the value can be parsed as a date
  return !isNaN(Date.parse(value));
};

const userFormRules = computed(() => {
  return {
    fullName: { required, minLength: minLength(5) }, //!! Required and minimum 5 characters long
    userName: { required, minLength: minLength(3) }, //!! Required and minimum 3 characters long
    email: { required, email }, //!! Required and must be an email
    birthday: { required, isValidDate, birthdayRange },// Adjust the birthday validation to check if it's a valid date and within a reasonable range
    password: { required, minLength: minLength(8) }, //!! Required and minimum 8 characters long
    terms: { sameAs: sameAs(true) }, //!! Automatically true if terms are accepted. Have the terms been accepted?
  }
})

// Define a custom validation rule to ensure the birthday falls within a reasonable range
const birthdayRange: ValidationRule = (value: string) => {
  const [year, month, day] = value.split('/').map(Number); // Split the date string and convert components to numbers
  const birthdayDate = new Date(year, month - 1, day); // Month is zero-based, so subtract 1
  const minDate = new Date();
  minDate.setFullYear(minDate.getFullYear() - 18); // 18 years ago
  const maxDate = new Date();
  maxDate.setFullYear(maxDate.getFullYear() - 150); // 150 years ago

  if (birthdayDate > minDate || birthdayDate < maxDate) {
    return false; // Validation fails
  } else {
    return true; // Validation passes
  }
};

const tempDate = ref(currentDate)
function updateDate() {
  tempDate.value = userForm.birthday
}
function saveDate() {
  userForm.birthday = tempDate.value
}

const isPwd = ref(true)
const passType = computed(() => {
  return isPwd.value ? 'password' : 'text'
})
const passIcon = computed(() => {
  return isPwd.value ? 'visibility_off' : 'visibility'
})

const user$ = useVuelidate(userFormRules, userForm as any)

const onSubmit = async () => {
  const result = await user$.value.$validate();
  if (!result) return;
  $q.notify({
    color: 'green-4',
    textColor: 'white',
    icon: 'cloud_done',
    message: ' Successfully registered!!!'
  })
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

            <q-input class="q-mt-sm" filled v-model="userForm.fullName" label="Full Name *"
              @input="user$.fullName.$touch()" :error="user$.fullName.$error">
              <template #prepend><q-icon name="account_circle" color="grey" size="32px" /></template>
            </q-input>
            <span v-for="error in user$.fullName.$errors" :key="error.$uid" class="text-red">
              {{ error.$message }}
            </span>

            <q-input class="q-mt-sm" filled v-model="userForm.userName" label="Username *"
              @input="user$.userName.$touch()" :error="user$.userName.$error">
              <template #prepend><q-icon name="face" color="grey" size="32px" /></template>
            </q-input>
            <span v-for="error in user$.userName.$errors" :key="error.$uid" class="text-red">
              {{ error.$message }}
            </span>

            <q-input class="q-mt-sm" filled v-model="userForm.email" label="Email *" @input="user$.email.$touch()"
              :error="user$.email.$error">
              <template #prepend><q-icon name="mail" color="grey" size="32px" /></template>
            </q-input>
            <span v-for="error in user$.email.$errors" :key="error.$uid" class="text-red">
              {{ error.$message }}
            </span>

            <q-input class="q-mt-sm" filled v-model="userForm.birthday" label="Date of Birth *" mask="date"
              :error="user$.birthday.$error">
              <template #prepend><q-icon name="celebration" color="grey" size="32px" /></template>
              <template v-slot:append>
                <q-icon name="event" class="cursor-pointer" :style="user$.birthday.$error ? 'color: red' : 'color: grey'">
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
            <!-- Display error message for birthday -->
            <span v-if="user$.birthday.$error" class="text-red">
              {{ user$.birthday.$errors && user$.birthday.$errors[0].$message ? user$.birthday.$errors[0].$message :
                'You must be at least 18 and at most 150 years old !!!' }}
            </span>

            <q-input class="q-mt-sm" filled v-model="userForm.password" :type="passType" label="Password *"
              @input="user$.password.$touch()" :error="user$.password.$error">
              <template v-slot:prepend><q-icon name="vpn_key" color="grey" size="32px" /></template>
              <template v-slot:append>
                <q-icon :name="passIcon" class="cursor-pointer" @click="isPwd = !isPwd" />
              </template>
            </q-input>
            <span v-for="error in user$.password.$errors" :key="error.$uid" class="text-red">
              {{ error.$message }}
            </span>
          </div>

          <q-toggle v-model="userForm.terms" label="I accept the license and terms" @toggle="user$.terms.$touch()">
          </q-toggle> <br>
          <span v-if="user$.terms.$error" class="text-red">
            <b>You must accept the license and terms</b>
          </span>

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
