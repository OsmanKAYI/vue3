<script setup lang="ts">
import { ref } from 'vue'
const offerId = ref<string>('') // Initialize offerId as a string ref
import type { TableColumn, RowType } from 'src/types/types'

const offerDate = ref('')
const title = ref('')
const firmName = ref('')
const firmAdress = ref('')
const authName = ref('')
const authPhone = ref('')
const authEmail = ref('')
const situation = ref('')
const discount = ref()
const currency = ref('')
const hasPhoto = ref('')
const tax = ref('')
const transportation = ref('')
const assembly = ref('')
const extra = ref<string[]>(['']);
const notes = ref('')

const columns: TableColumn[] = [
  { name: 'itemId', required: true, label: 'Item Id', align: 'left', field: (row: RowType) => row.itemId, format: (val: string) => `${val}`, sortable: true },
  { name: 'sortOrder', required: true, label: 'Sort Order', align: 'left', field: (row: RowType) => row.sortOrder, format: (val: string) => `${val}`, sortable: true },
  { name: 'productName', required: true, label: 'Product Name', align: 'left', field: (row: RowType) => row.productName, format: (val: string) => `${val}`, sortable: true },
  { name: 'amount', required: true, label: 'Amount ', align: 'left', field: (row: RowType) => row.amount, format: (val: string) => `${val}`, sortable: false },
  { name: 'unit', required: true, label: 'Unit ', align: 'left', field: (row: RowType) => row.unit, format: (val: string) => `${val}`, sortable: true },
  { name: 'unitPrice', required: true, label: 'Unit Price', align: 'left', field: (row: RowType) => row.unitPrice, format: (val: string) => `${val}`, sortable: true },
  { name: 'total', required: true, label: 'Total ', align: 'left', field: (row: RowType) => row.total, format: (val: string) => `${val}`, sortable: true },
  { name: 'picture', required: true, label: 'Picture ', align: 'left', field: (row: RowType) => row.picture, format: (val: string) => `${val}`, sortable: true },
];

const rows = ref<RowType[]>([
  { itemId: 1, sortOrder: 10, productName: 'deneme', amount: 0, unit: 'deneme', unitPrice: 0, total: 0, picture: 'yes' },
]);

</script>

<template>
  <q-page padding class="justify-evenly">
    <q-card bordered class="q-pa-xl q-ma-md">

      <div class="row q-pa-md justify-center">
        <div class="col" style="max-width: 800px">
          <div class="text-h4 q-pa-sm q-mb-sm text-weight-bold text-center"
            style="color: grey; background-color: lightgrey">
            Offer {{ offerId }}</div>

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
            <q-table class="col-12" bordered title="Items" :rows="rows" :columns="columns" row-key="name"
              binary-state-sort>
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
