<template>
  <q-page class="row items-center justify-evenly">
    <example-component title="Example component" active :todos="todos" :meta="meta"></example-component>

    <q-btn color="positive" @click="triggerPositive"> SELAM </q-btn>
    <q-btn label='Alert' color="primary" @click="alert"> </q-btn>
    <q-btn :label='btnName' color="primary" @click="prompt" />
    <q-btn label="Checkbox Options" color="primary" @click="checkbox" />

  </q-page>
</template>

<script setup lang="ts">
import { Todo, Meta } from 'components/models';
import ExampleComponent from 'components/ExampleComponent.vue';
import { ref } from 'vue';
import { useQuasar } from 'quasar'
const $q = useQuasar()

function checkbox() {
  $q.dialog({
    title: 'Options',
    message: 'Choose your options:',
    options: {
      type: 'checkbox',
      model: [],
      // inline: true
      items: [
        { label: 'Option 1', value: 'opt1', color: 'secondary' },
        { label: 'Option 2', value: 'opt2' },
        { label: 'Option 3', value: 'opt3' }
      ]
    },
    cancel: true,
    persistent: true
  }).onOk(data => {
    // console.log('>>>> OK, received', data)
    console.log(data)
    $q.dialog({
      title: 'Selected',
      message: data.join(', ')
    })
  }).onCancel(() => {
    // console.log('>>>> Cancel')
  }).onDismiss(() => {
    // console.log('I am triggered on both OK and Cancel')
  })
}

const btnName = ref('NAME')
function prompt() {
  $q.dialog({
    title: 'Prompt',
    message: 'What is your name?',
    prompt: {
      model: '',
      type: 'text' // optional
    },
    cancel: true,
    persistent: true
  }).onOk(data => {
    // console.log('>>>> OK, received', data)
    btnName.value = data
  }).onCancel(() => {
    // console.log('>>>> Cancel')
  }).onDismiss(() => {
    // console.log('I am triggered on both OK and Cancel')
  })
}

function alert() {
  $q.dialog({
    title: 'Kullanıcı SİL',
    message: 'Silmek istediğinize emin misiniz?',
    cancel: true,
    persistent: true
  }).onOk(() => {
    //console.log('KULLANICI SİLİNDİ')
    $q.notify({
      message: 'KULLANICI SİLİNDİ',
      color: 'warning'
    })
  }).onCancel(() => {
    console.log('KULLANICI SİLİNEMEDİ')
  }).onDismiss(() => {
    // console.log('I am triggered on both OK and Cancel')
  })
}

function triggerPositive() {
  $q.notify({
    message: 'Burdayım be burdayım. BURR DAA YIIMM',
    color: 'negative',
    position: 'top-right',
    icon: 'warning',

  })
}



const todos = ref<Todo[]>([
  {
    id: 1,
    content: 'ct1'
  },
  {
    id: 2,
    content: 'ct2'
  },
  {
    id: 3,
    content: 'ct3'
  },
  {
    id: 4,
    content: 'ct4'
  },
  {
    id: 5,
    content: 'ct5'
  }
]);
const meta = ref<Meta>({
  totalCount: 1200
});
</script>
