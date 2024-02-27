<script setup lang="ts">
import { computed, ref } from 'vue'
import { useQuasar } from 'quasar'
const $q = useQuasar()
import { useRouter } from 'vue-router';
const router = useRouter();

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

// Function to show the offer details
const showOffer = (offer: any) => {
  router.push({ path: `/home/offer/show/${offer.id}`, query: { offerDetails: JSON.stringify(offer) } });
};
// Function to show the offer details
const editOffer = (offer: any) => {
  router.push({ path: `/home/offer/edit/${offer.id}`, query: { offerDetails: JSON.stringify(offer) } });
};
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
                <div class="col-10 q-ml-xl">
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
            <th class="col-3 text-left">Operation</th>
            <th class="col-1 text-left">#</th>
            <th class="col-2 text-center">Offer Date</th>
            <th class="col-2 text-center">Firm Name</th>
            <th class="col-1 text-center"># of Items</th>
            <th class="col-1 text-center">Total</th>
          </tr>
        </thead>
        <tbody :class="$q.dark.isActive ? 'bg-grey-9' : 'bg-grey-3'">
          <tr v-for="(item, index) in filteredItems" :key="index">
            <td class="text-left">
              <q-btn @click="showOffer(item)" color="primary" icon="visibility" class="q-mr-sm" flat round dense />
              <q-btn @click="editOffer(item)" color="primary" icon="edit" flat round dense />
            </td>
            <td class="text-left">{{ item.number }}</td>
            <td class="text-center">{{ item.date }}</td>
            <td class="text-center">{{ item.firm }}</td>
            <td class="text-center">{{ item.itemCount }}</td>
            <td class="text-center">{{ item.total }}</td>
          </tr>
        </tbody>
      </q-markup-table>
    </div>

  </q-page>
</template>
