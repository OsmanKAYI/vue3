<script setup lang="ts">
import { computed, ref } from 'vue'
import { useQuasar } from 'quasar'
const $q = useQuasar()

const btnTheme = computed(() => {
  return $q.dark.isActive ? 'bg-purple-5 text-black' : 'bg-purple-9 text-white';
})

const headingTheme = computed(() => {
  return $q.dark.isActive ? 'text-white' : 'text-black'
})

const picWidth = computed(() => {
  return $q.platform.is.mobile ? 'width: 100px' : 'width: 150px'
})

const numItemsToShow = ref(0);

const listItems = (num: number) => {
  numItemsToShow.value = num;
}

const filteredItems = computed(() => {
  if (numItemsToShow.value === 0) {
    return items; // Show all items
  } else {
    return items.slice(0, numItemsToShow.value); // Show selected number of items
  }
});

const items = [
  { name: 'Frozen Yogurt', number: 159, date: 6, firm: 24, itemCount: 24, total: 4 },
  { name: 'Frozen Yogurt', number: 159, date: 6, firm: 24, itemCount: 24, total: 4 },
  { name: 'Frozen Yogurt', number: 159, date: 6, firm: 24, itemCount: 24, total: 4 },
  { name: 'Frozen Yogurt', number: 159, date: 6, firm: 24, itemCount: 24, total: 4 },
  { name: 'Frozen Yogurt', number: 159, date: 6, firm: 24, itemCount: 24, total: 4 },
  { name: 'Frozen Yogurt', number: 159, date: 6, firm: 24, itemCount: 24, total: 4 },
  { name: 'Frozen Yogurt', number: 159, date: 6, firm: 24, itemCount: 24, total: 4 },
  { name: 'Frozen Yogurt', number: 159, date: 6, firm: 24, itemCount: 24, total: 4 },
  { name: 'Frozen Yogurt', number: 159, date: 6, firm: 24, itemCount: 24, total: 4 },
  { name: 'Frozen Yogurt', number: 159, date: 6, firm: 24, itemCount: 24, total: 4 },
  { name: 'Frozen Yogurt', number: 159, date: 6, firm: 24, itemCount: 24, total: 4 },
  { name: 'Frozen Yogurt', number: 159, date: 6, firm: 24, itemCount: 24, total: 4 },
  { name: 'Frozen Yogurt', number: 159, date: 6, firm: 24, itemCount: 24, total: 4 },
  { name: 'Frozen Yogurt', number: 159, date: 6, firm: 24, itemCount: 24, total: 4 },
  { name: 'Frozen Yogurt', number: 159, date: 6, firm: 24, itemCount: 24, total: 4 },
  { name: 'Frozen Yogurt', number: 159, date: 6, firm: 24, itemCount: 24, total: 4 },
  { name: 'Frozen Yogurt', number: 159, date: 6, firm: 24, itemCount: 24, total: 4 },
  { name: 'Frozen Yogurt', number: 159, date: 6, firm: 24, itemCount: 24, total: 4 },
  { name: 'Frozen Yogurt', number: 159, date: 6, firm: 24, itemCount: 24, total: 4 },
  { name: 'Frozen Yogurt', number: 159, date: 6, firm: 24, itemCount: 24, total: 4 },
  { name: 'Frozen Yogurt', number: 159, date: 6, firm: 24, itemCount: 24, total: 4 },
  { name: 'Frozen Yogurt', number: 159, date: 6, firm: 24, itemCount: 24, total: 4 },
];
</script>

<template>
  <q-page padding>
    <div class="text-h6">MAIN</div>
    <div class="text-subtitle1">Index Page</div>
    <q-btn :class="btnTheme" class="q-ma-sm" label="Show All Offers" color="primary"
      @click="$router.push('/home/offers')" />

    <div class="q-pa-md">
      <q-markup-table bordered binary-state-sort>
        <thead :class="$q.dark.isActive ? 'bg-green-9' : 'bg-green-6'">
          <tr>
            <th colspan="6">
              <div class="row no-wrap items-center">
                <div class="col-1 q-mr-xl">
                  <q-img :style="picWidth" :ratio="1" class="rounded-borders"
                    src="https://0.gravatar.com/avatar/834de371b1d5dd047e85bb3c7470d703e407cb7b73e2794ad549a6ee2a2e969b?size=256" />
                </div>
                <div class="col-11 q-ml-xl">
                  <div :class="headingTheme" class="row text-h4 q-mb-xl q-ml-md text-weight-bold text-center"> Offers List
                  </div>
                  <div class="row q-ml-md">
                    <q-btn :class="btnTheme" class="col-1 q-ml-xs rounded-borders" @click="listItems(0)">All</q-btn>
                    <q-btn :class="btnTheme" class="col-1 q-ml-xs rounded-borders" @click="listItems(10)">10</q-btn>
                    <q-btn :class="btnTheme" class="col-1 q-ml-xs rounded-borders" @click="listItems(50)">50</q-btn>
                    <q-btn :class="btnTheme" class="col-1 q-ml-xs rounded-borders" @click="listItems(100)">100</q-btn>
                    <q-btn :class="btnTheme" class="col-1 q-ml-xs rounded-borders" @click="listItems(200)">200</q-btn>
                  </div>
                </div>

              </div>
            </th>
          </tr>
          <tr>
            <th class="text-left">Details</th>
            <th class="text-center">#</th>
            <th class="text-right">Offer Date</th>
            <th class="text-right">Firm Name</th>
            <th class="text-right"># of Items</th>
            <th class="text-right">Total</th>
          </tr>
        </thead>
        <tbody :class="$q.dark.isActive ? 'bg-grey-9' : 'bg-grey-3'">
          <tr v-for="(item, index) in filteredItems" :key="index">
            <td class="text-left">{{ item.name }}</td>
            <td class="text-right">{{ item.number }}</td>
            <td class="text-right">{{ item.date }}</td>
            <td class="text-right">{{ item.firm }}</td>
            <td class="text-right">{{ item.itemCount }}</td>
            <td class="text-right">{{ item.total }}</td>
          </tr>
        </tbody>
      </q-markup-table>
    </div>

  </q-page>
</template>
