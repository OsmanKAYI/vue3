<template>
  <q-page class="row items-center justify-evenly">
    <example-component
      title="Example component"
      active
      :todos="todos"
      :meta="meta"
    ></example-component>
    <q-btn label="Custom Buttons" color="primary" @click="customBtn" />
  </q-page>
</template>

<script setup lang="ts">
import { Todo, Meta } from 'components/models';
import ExampleComponent from 'components/ExampleComponent.vue';
import { ref } from 'vue';
import { useQuasar } from 'quasar';
const $q = useQuasar();

function customBtn() {
  $q.dialog({
    title: 'Confirm',
    message: 'Would you like to turn on the wifi?',
    ok: {
      push: true,
    },
    cancel: {
      push: true,
      color: 'negative',
    },
    persistent: true,
  })
    .onOk(() => {
      alert('Wifi turned on!!!');
    })
    .onCancel(() => {
      alert('Wifi is not turned on!!!');
    })
    .onDismiss(() => {
      // console.log('I am triggered on both OK and Cancel')
    });
}
const todos = ref<Todo[]>([
  {
    id: 1,
    content: 'ct1',
  },
  {
    id: 2,
    content: 'ct2',
  },
  {
    id: 3,
    content: 'ct3',
  },
  {
    id: 4,
    content: 'ct4',
  },
  {
    id: 5,
    content: 'ct5',
  },
]);
const meta = ref<Meta>({
  totalCount: 1200,
});
</script>
