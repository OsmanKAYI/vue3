<script setup lang="ts">
import { ref, computed } from 'vue'
import { useRoute, useRouter } from 'vue-router';
const route = useRoute();
const router = useRouter();
import { useQuasar } from 'quasar'
const $q = useQuasar()
import type { TableColumn, RowType } from 'src/types/types'

let generalTheme = computed(() => {
  return $q.dark.isActive ? 'glossy bg-grey-7 text-white' : 'glossy bg-grey-5 text-black';
})

const offerId = ref<string>('')
const offerDate = ref<string>('')
const title = ref<string>('')
const firmName = ref<string>('')
const firmAdress = ref<string>('')
const authName = ref<string>('')
const authPhone = ref<string>('')
const authEmail = ref<string>('')
const situation = ref<string>('')
const discount = ref<number>()
const currency = ref<string>('')
const hasPhoto = ref<string>('')
const tax = ref<string>('')
const transportation = ref<string>('')
const assembly = ref<string>('')
const extra = ref<string[]>(['']);
const notes = ref<string>('')

const columns: TableColumn[] = [
  { name: 'itemId', required: true, label: 'Item Id', align: 'left', field: (row: RowType) => row.itemId, format: (val: string) => `${val}`, sortable: true },
  { name: 'sortOrder', required: true, label: 'Sort Order', align: 'left', field: (row: RowType) => row.sortOrder, format: (val: string) => `${val}`, sortable: true },
  { name: 'productName', required: true, label: 'Product Name', align: 'left', field: (row: RowType) => row.productName, format: (val: string) => `${val}`, sortable: true },
  { name: 'quantity', required: true, label: 'Quantity ', align: 'left', field: (row: RowType) => row.quantity, format: (val: string) => `${val}`, sortable: false },
  { name: 'unit', required: true, label: 'Unit ', align: 'left', field: (row: RowType) => row.unit, format: (val: string) => `${val}`, sortable: true },
  { name: 'unitPrice', required: true, label: 'Unit Price', align: 'left', field: (row: RowType) => row.unitPrice, format: (val: string) => `${val}`, sortable: true },
  { name: 'total', required: true, label: 'Total ', align: 'left', field: (row: RowType) => row.total, format: (val: string) => `${val}`, sortable: true },
  { name: 'picture', required: true, label: 'Picture ', align: 'left', field: (row: RowType) => row.picture, format: (val: string) => `${val}`, sortable: true },
];

const rows = ref<RowType[]>([
  { itemId: 1, sortOrder: 10, productName: '', quantity: 0, unit: '', unitPrice: 0, total: 0, picture: '' },
]);

const navigateToEditPage = () => {
  console.log('Offer ID:', offerId.value); // Log the offerId.value
  if (offerId.value) {
    router.push(`/home/offer/edit/${offerId.value}`);
  } else {
    $q.notify({
      type: 'negative',
      message: 'Offer ID not found in route query parameters',
      position: 'top',
      timeout: 1000
    })
  }
}

const printCardContents = () => {
  // Clone the content of the q-card
  const cardContent = document.querySelector('.q-card')?.cloneNode(true);
  // Create a new window to contain the cloned content
  const printWindow = window.open('', '_blank');
  // Append the cloned content to the new window's document
  printWindow?.document.body.appendChild(cardContent ?? document.createElement('div'));
  // Trigger the print dialog for the new window
  printWindow?.print();
}

const getWhatsAppLink = () => {
  const baseUrl = window.location.origin; // Get the base URL of the current page
  //console.log(baseUrl)
  const offerId = route.query.offerId;
  const offerLink = `${baseUrl}/home/offer/show/${offerId}`; // Construct the offer link
  const message = encodeURIComponent(`Check out this offer: ${offerLink}`);
  return `https://api.whatsapp.com/send?text=${message}`;
}

const copyLink = () => {
  const currentUrl = window.location.href;
  navigator.clipboard.writeText(currentUrl)
    .then(() => {
      // Show success message or perform other actions if needed
      $q.notify({
        type: 'positive',
        message: 'Link copied to clipboard !!!',
        position: 'top',
        timeout: 1000
      })
    })
    .catch((error) => {
      // Handle any errors that may occur during the copy process
      $q.notify({
        type: 'negative',
        message: 'Failed to copy link to clipboard:',
        caption: error,
        position: 'top',
        timeout: 1000
      })
    });
}
</script>

<template>
  <q-page padding class="justify-evenly">
    <div class="row q-pa-md justify-between">
      <div class="col">
        <q-btn class="q-px-md" @click="navigateToEditPage" label="Edit" />
        <q-btn class="q-px-md" @click="printCardContents" label="Print" icon-right="print" />
        <q-btn class="q-px-md" tag="a" :href="getWhatsAppLink()" target="_blank" label="WhatsApp" icon-right="forward" />
        <q-btn class="q-px-md" @click="copyLink" label="Copy" icon-right="content_copy" />
      </div>
    </div>

    <q-card bordered class="q-pa-xl q-ma-md">

      <div class="row q-pa-md justify-center">
        <div class="col" style="max-width: 800px">
          <div class="text-h4 q-pa-sm q-mb-sm text-weight-bold text-center" :class="generalTheme">
            Offer {{ $route.query.offerId }}</div>

          <div class="row q-col-gutter-xs">
            <q-input :disable="true" class="col-12 col-md-4" filled v-model="offerId" label="Offer ID">
              <template v-slot:prepend>
                <q-icon name="fingerprint" />
              </template>
              <template #label>
                <div class="text-cyan">Offer ID</div>
              </template>
            </q-input>

            <q-input :disable="true" class="col-12 col-md-8" filled v-model="offerDate" label="Offer Date" mask="date">
              <template #prepend><q-icon name="today" size="32px" /></template>
              <template #label>
                <div class="text-cyan">Offer Date</div>
              </template>
            </q-input>

            <q-input :disable="true" filled class="col-12 col-md-12" v-model="title" label="Title">
              <template #prepend>
                <q-icon name="title" />
              </template>
              <template #label>
                <div class="text-cyan">Title</div>
              </template>
            </q-input>
            <q-input :disable="true" filled class="col-12 col-md-12" v-model="firmName" label="Firm Name">
              <template #prepend>
                <q-icon name="badge" />
              </template>
              <template #label>
                <div class="text-cyan">Firm Name</div>
              </template>
            </q-input>

            <q-input :disable="true" filled class="col-12 col-md-12" type="textarea" v-model="firmAdress"
              label="Firm Adress">
              <template #prepend>
                <q-icon name="business" />
              </template>
              <template #label>
                <div class="text-cyan">Firm Adress</div>
              </template>
            </q-input>

            <q-input :disable="true" filled class="col-12 col-md-7" v-model="authName" label="Authorised Name">
              <template #prepend>
                <q-icon name="person" />
              </template>
              <template #label>
                <div class="text-cyan">Authorised Name</div>
              </template>
            </q-input>

            <q-input :disable="true" filled class="col-12 col-md-5" v-model="authPhone" label="Authorised Phone"
              mask="phone">
              <template #prepend>
                <q-icon name="phone" />
              </template>
              <template #label>
                <div class="text-cyan">Authorised Phone</div>
              </template>
            </q-input>

            <q-input :disable="true" filled class="col-12 col-md-12" v-model="authEmail" label="Authorised Email">
              <template #prepend>
                <q-icon name="mail" />
              </template>
              <template #label>
                <div class="text-cyan">Authorised Email</div>
              </template>
            </q-input>

            <q-input :disable="true" filled class="col-12 col-md-12" v-model="situation" label="Situation">
              <template #prepend>
                <q-icon name="turned_in" />
              </template>
              <template #label>
                <div class="text-cyan">Situation</div>
              </template>
            </q-input>

            <q-input :disable="true" filled class="col-12 col-md-4" v-model="discount" label="Discount">
              <template #prepend>
                <q-icon name="price_change" />
              </template>
              <template #label>
                <div class="text-cyan">Discount</div>
              </template>
            </q-input>

            <q-input :disable="true" filled class="col-12 col-md-4" v-model="currency" label="Currency">
              <template #prepend>
                <q-icon name="currency_exchange" />
              </template>
              <template #label>
                <div class="text-cyan">Currency</div>
              </template>
            </q-input>

            <q-input :disable="true" filled class="col-12 col-md-4" v-model="hasPhoto" label="Has Photo">
              <template #prepend>
                <q-icon name="photo" />
              </template>
              <template #label>
                <div class="text-cyan">Has Photo</div>
              </template>
            </q-input>

            <q-input :disable="true" filled class="col-12 col-md-5" v-model="tax" label="Tax">
              <template #prepend>
                <q-icon name="request_quote" />
              </template>
              <template #label>
                <div class="text-cyan">Tax</div>
              </template>
            </q-input>

            <q-input :disable="true" filled class="col-12 col-md-7" v-model="transportation" label="Transportation">
              <template #prepend>
                <q-icon name="local_shipping" />
              </template>
              <template #label>
                <div class="text-cyan">Transportation</div>
              </template>
            </q-input>

            <q-input :disable="true" filled class="col-12 col-md-5" v-model="assembly" label="Assembly">
              <template #prepend>
                <q-icon name="download_done" />
              </template>
              <template #label>
                <div class="text-cyan">Assembly</div>
              </template>
            </q-input>

            <q-input :disable="true" filled class="col-12 col-md-7" v-model="extra[0]" label="Extra">
              <template #prepend>
                <q-icon name="expand_circle_down" />
              </template>
              <template #label>
                <div class="text-cyan">Extra</div>
              </template>
            </q-input>

            <q-input :disable="true" filled class="col-12 col-md-12" type="textarea" v-model="notes" label="Notes">
              <template #prepend>
                <q-icon name="note_add" />
              </template>
              <template #label>
                <div class="text-cyan">Notes</div>
              </template>
            </q-input>
          </div>

          <div class="row q-pt-xs">
            <div class="col col-md-12 text-h6 q-pa-xs q-mb-xs text-weight-bold text-center" :class="generalTheme">
              Items</div>
            <q-table class="col-12" bordered :rows="rows" :columns="columns" row-key="name" binary-state-sort>
              <template #body="props">
                <q-tr :props="props">
                  <q-td :disable="true" v-for="column in  columns " :key="column.name" :props="props">
                    {{ props.row[column.name] }}
                  </q-td>
                </q-tr>
              </template>
            </q-table>
          </div>

        </div>
      </div>

    </q-card>
  </q-page>
</template>

<style scoped lang="css">
@media (max-width: 600px) {

  /* Styles for mobile screens */
  .q-page {
    padding: 0;
  }

  .q-card {
    padding: 0;
    margin: 0;
    border: none;
  }
}
</style>
