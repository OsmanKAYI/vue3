<script setup lang="ts">
import { ref } from 'vue'

const onSubmit = () => {
  console.log('submit')
}

const offerNumber = ref('')
const date = ref('')
const title = ref('')
const firmName = ref('')
const firmAdress = ref('')
const authName = ref('')
const authPhone = ref('')
const authEmail = ref('')
const situation = ref('')
const discount = ref('')
const currency = ref('')
const hasPhoto = ref('')
const tax = ref('')
const transportation = ref('')
const assembly = ref('')
const extra = ref('')
const notes = ref('')

</script>

<template>
  <q-page padding class="justify-evenly">
    <q-card class="q-pa-xl q-ma-md" bordered>

      <q-form @submit="onSubmit" autocomplete="off" autocapitalize="on">
        <div class="row q-pa-md justify-center">
          <div class="col q-gutter-md" style="max-width: 800px">
            <div class="text-h6">New Offer</div>

            <div class="row bg-blue-1 q-gutter-sm" style="width: 100%;">
              <q-input filled class="col-5" v-model="offerNumber" label="Offer Number" />
              <q-input filled class="col-6" v-model="date" label="Offer Date" />
              <q-input filled class="col-11" v-model="title" label="Title" />
              <q-input filled class="col-11" v-model="firmName" label="Firm Name" />
              <q-input filled class="col-11" type="textarea" v-model="firmAdress" label="Firm Adress" />
              <q-input filled class="col-6" v-model="authName" label="Authorised Name" />
              <q-input filled class="col-5" v-model="authPhone" label="Authorised Phone" />
              <q-input filled class="col-11" v-model="authEmail" label="Authorised Email" />
              <q-input filled class="col-11" v-model="situation" label="Situation" />
              <q-input filled class="col-6" v-model="discount" label="Discount" />
              <q-input filled class="col-2" v-model="currency" label="Currency" />
              <q-input filled class="col-2" v-model="hasPhoto" label="Has Photo" />
              <q-input filled class="col-3" v-model="tax" label="Tax" />
              <q-input filled class="col-3" v-model="transportation" label="Transportation" />
              <q-input filled class="col-3" v-model="assembly" label="Assembly" />
              <q-input filled class="col-11" v-model="extra" label="Extra" />
              <q-input filled class="col-11" type="textarea" v-model="notes" label="Notes" />
            </div>

          </div>
        </div>
      </q-form>

    </q-card>
  </q-page>
</template>

<style scoped lang="scss"></style>
