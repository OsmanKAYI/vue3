<script setup lang="ts">
import { computed, ref } from 'vue'
import { useQuasar } from 'quasar'
const $q = useQuasar()
import { useRouter } from 'vue-router';
const router = useRouter();
import type { Offer } from 'src/types/types';

const btnTheme = computed(() => {
  return $q.dark.isActive ? 'bg-purple-5 text-black' : 'bg-purple-9 text-white';
})

const headingTheme = computed(() => {
  return $q.dark.isActive ? 'text-white' : 'text-black'
})

const picWidth = computed(() => {
  return $q.platform.is.mobile ? 'width: 100px' : 'width: 150px'
})

const numOffersToShow = ref(0);

const listItems = (num: number) => {
  numOffersToShow.value = num;
}

const filteredOffers = computed(() => {
  if (numOffersToShow.value === 0) {
    return offers; // Show all offers
  } else {
    return offers.slice(0, numOffersToShow.value); // Show selected number of offers
  }
});

const offers = [
  { name: 'Frozen Yogurt', number: 159, date: '2024/02/07', firm: 'KAYI EMLAK', itemCount: 24, total: 4 },
  { name: 'Frozen Yogurt', number: 160, date: '2024/02/07', firm: 'KAYI EMLAK', itemCount: 24, total: 4 },
  { name: 'Frozen Yogurt', number: 161, date: '2024/02/07', firm: 'KAYI EMLAK', itemCount: 24, total: 4 },
  { name: 'Frozen Yogurt', number: 162, date: '2024/02/07', firm: 'KAYI EMLAK', itemCount: 24, total: 4 },
  { name: 'Frozen Yogurt', number: 163, date: '2024/02/07', firm: 'KAYI EMLAK', itemCount: 24, total: 4 },
  { name: 'Frozen Yogurt', number: 164, date: '2024/02/07', firm: 'KAYI EMLAK', itemCount: 24, total: 4 },
  { name: 'Frozen Yogurt', number: 165, date: '2024/02/07', firm: 'KAYI EMLAK', itemCount: 24, total: 4 },
  { name: 'Frozen Yogurt', number: 166, date: '2024/02/07', firm: 'KAYI EMLAK', itemCount: 24, total: 4 },
  { name: 'Frozen Yogurt', number: 166, date: '2024/02/07', firm: 'KAYI EMLAK', itemCount: 24, total: 4 },
  { name: 'Frozen Yogurt', number: 167, date: '2024/02/07', firm: 'KAYI EMLAK', itemCount: 24, total: 4 },
  { name: 'Frozen Yogurt', number: 168, date: '2024/02/07', firm: 'KAYI EMLAK', itemCount: 24, total: 4 },
  { name: 'Frozen Yogurt', number: 169, date: '2024/02/07', firm: 'KAYI EMLAK', itemCount: 24, total: 4 },
  { name: 'Frozen Yogurt', number: 170, date: '2024/02/07', firm: 'KAYI EMLAK', itemCount: 24, total: 4 },
  { name: 'Frozen Yogurt', number: 171, date: '2024/02/07', firm: 'KAYI EMLAK', itemCount: 24, total: 4 },
  { name: 'Frozen Yogurt', number: 172, date: '2024/02/07', firm: 'KAYI EMLAK', itemCount: 24, total: 4 },
  { name: 'Frozen Yogurt', number: 173, date: '2024/02/07', firm: 'KAYI EMLAK', itemCount: 24, total: 4 },
  { name: 'Frozen Yogurt', number: 174, date: '2024/02/07', firm: 'KAYI EMLAK', itemCount: 24, total: 4 },
  { name: 'Frozen Yogurt', number: 175, date: '2024/02/07', firm: 'KAYI EMLAK', itemCount: 24, total: 4 },
  { name: 'Frozen Yogurt', number: 176, date: '2024/02/07', firm: 'KAYI EMLAK', itemCount: 24, total: 4 },
  { name: 'Frozen Yogurt', number: 177, date: '2024/02/07', firm: 'KAYI EMLAK', itemCount: 24, total: 4 },
  { name: 'Frozen Yogurt', number: 178, date: '2024/02/07', firm: 'KAYI EMLAK', itemCount: 24, total: 4 },
  { name: 'Frozen Yogurt', number: 179, date: '2024/02/07', firm: 'KAYI EMLAK', itemCount: 24, total: 4 },
];

// Function to show the offer details
const showOffer = (offer: Offer) => {
  router.push({
    path: `/home/offer/show/${offer.number}`,
    query: {
      offerDetails: JSON.stringify(offer),
      offerId: offer.number,
      offerDate: offer.date,
      firmName: offer.firm,
      itemCount: offer.itemCount,
      total: offer.total
    }
  });
};
// Function to edit the offer
const editOffer = (offer: Offer) => {
  router.push({
    path: `/home/offer/edit/${offer.number}`,
    query: {
      offerDetails: JSON.stringify(offer),
      offerId: offer.number,
      offerDate: offer.date,
      firmName: offer.firm,
      itemCount: offer.itemCount,
      total: offer.total
    }
  });
};
</script>

<template>
  <q-page padding>
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
          <tr v-for="(offer, index) in filteredOffers" :key="index">
            <td class="text-left">
              <q-btn @click="showOffer(offer)" color="primary" icon="visibility" class="q-mr-sm" flat round dense />
              <q-btn @click="editOffer(offer)" color="primary" icon="edit" flat round dense />
            </td>
            <td class="text-left">{{ offer.number }}</td>
            <td class="text-center">{{ offer.date }}</td>
            <td class="text-center">{{ offer.firm }}</td>
            <td class="text-center">{{ offer.itemCount }}</td>
            <td class="text-center">{{ offer.total }}</td>
          </tr>
        </tbody>
      </q-markup-table>
    </div>

  </q-page>
</template>
