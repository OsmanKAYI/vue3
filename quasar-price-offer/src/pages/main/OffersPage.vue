<script setup lang="ts">
import { ref } from 'vue'

const onSubmit = () => {
  console.log('submit')
}

const offerNumber = ref('')
const date = ref('')

</script>

<template>
  <q-page padding class="justify-evenly">
    <q-card class="q-pa-xl q-ma-md" bordered>

      <q-form @submit="onSubmit" autocomplete="off" autocapitalize="on">
        <div class="row q-pa-md justify-center">
          <div class="col q-gutter-md" style="max-width: 800px">
            <div class="text-h6">New Offer</div>
            <div class="row justify-left">

              <q-input class="col-5" v-model="offerNumber" label="Offer Number" />
              <q-input class="col-6 offset-1" v-model="date" label="Offer Date" />
              <q-input class="col-12" v-model="date" label="Offer Date" />

            </div>
          </div>
        </div>
      </q-form>

    </q-card>
  </q-page>
</template>

<style scoped lang="scss"></style>
