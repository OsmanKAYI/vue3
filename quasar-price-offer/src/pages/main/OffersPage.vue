<script setup lang="ts">
import { ref } from 'vue'

const onSubmit = () => {
  console.log('submit')
}
const addItem = () => {
  console.log('added')
}

const offerId = ref('')
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

interface TableColumn {
  name: string;
  required?: boolean;
  label: string;
  align: 'left' | 'center' | 'right';
  field: (row: RowType) => string | number;
  format?: (val: string) => string;
  sortable?: boolean;
  style?: string;
  sort?: (a: string, b: string, rowA: RowType, rowB: RowType) => number;
}

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

interface RowType {
  itemId: number;
  sortOrder: number;
  productName: string;
  amount: string;
  unit: string;
  unitPrice: string;
  total: string;
  picture: string;
}

const rows = [
  { itemId: 1, sortOrder: 10, productName: '0', amount: '24', unit: '24', unitPrice: '24', total: '24', picture: '24' },
]

</script>

<template>
  <q-page padding class="justify-evenly">
    <q-card bordered class="q-pa-xl q-ma-md">

      <q-btn glossy class="q-ma-sm" label="Home" color="warning" to="/home" />

      <q-form @submit="onSubmit" autocomplete="off" autocapitalize="on">
        <div class="row q-pa-md justify-center">
          <div class="col q-gutter-md" style="max-width: 800px">
            <div class="text-h6">New Offer</div>

            <div class="row q-gutter-sm">
              <q-input filled class="col-5" v-model="offerId" label="Offer ID">
                <template v-slot:prepend>
                  <q-icon name="fingerprint" />
                </template>
              </q-input>
              <q-input filled class="col-6" v-model="date" label="Offer Date">
                <template v-slot:prepend>
                  <q-icon name="today" />
                </template>
              </q-input>
              <q-input filled class="col-11" v-model="title" label="Title">
                <template v-slot:prepend>
                  <q-icon name="title" />
                </template>
              </q-input>
              <q-input filled class="col-11" v-model="firmName" label="Firm Name">
                <template v-slot:prepend>
                  <q-icon name="badge" />
                </template>
              </q-input>
              <q-input filled class="col-11" type="textarea" v-model="firmAdress" label="Firm Adress">
                <template v-slot:prepend>
                  <q-icon name="business" />
                </template>
              </q-input>
              <q-input filled class="col-6" v-model="authName" label="Authorised Name">
                <template v-slot:prepend>
                  <q-icon name="person" />
                </template>
              </q-input>
              <q-input filled class="col-5" v-model="authPhone" label="Authorised Phone">
                <template v-slot:prepend>
                  <q-icon name="phone" />
                </template>
              </q-input>
              <q-input filled class="col-11" v-model="authEmail" label="Authorised Email">
                <template v-slot:prepend>
                  <q-icon name="mail" />
                </template>
              </q-input>
              <q-input filled class="col-11" v-model="situation" label="Situation">
                <template v-slot:prepend>
                  <q-icon name="turned_in" />
                </template>
              </q-input>
              <q-input filled class="col-6" v-model="discount" label="Discount">
                <template v-slot:prepend>
                  <q-icon name="price_change" />
                </template>
              </q-input>
              <q-input filled class="col-2" v-model="currency" label="Currency">
                <template v-slot:prepend>
                  <q-icon name="currency_exchange" />
                </template>
              </q-input>
              <q-input filled class="col-3" v-model="hasPhoto" label="Has Photo">
                <template v-slot:prepend>
                  <q-icon name="photo" />
                </template>
              </q-input>
              <q-input filled class="col-3" v-model="tax" label="Tax">
                <template v-slot:prepend>
                  <q-icon name="request_quote" />
                </template>
              </q-input>
              <q-input filled class="col-3" v-model="transportation" label="Transportation">
                <template v-slot:prepend>
                  <q-icon name="local_shipping" />
                </template>
              </q-input>
              <q-input filled class="col-3" v-model="assembly" label="Assembly">
                <template v-slot:prepend>
                  <q-icon name="download_done" />
                </template>
              </q-input>
              <q-input filled class="col-11" v-model="extra" label="Extra">
                <template v-slot:prepend>
                  <q-icon name="expand_circle_down" />
                </template>
              </q-input>
              <q-input filled class="col-11" type="textarea" v-model="notes" label="Notes">
                <template v-slot:prepend>
                  <q-icon name="note_add" />
                </template>
              </q-input>
            </div>

            <div class="row q-gutter-sm">
              <q-table class="col-12" bordered title="Items" :rows="rows" :columns="columns" row-key="name"
                binary-state-sort>
                <template v-slot:body="props">
                  <q-tr :props="props">
                    <q-td v-for="column in columns" :key="column.name" :props="props">
                      {{ props.row[column.name] }}
                      <q-popup-edit v-model="props.row[column.name]" v-slot="scope">
                        <q-input v-model="scope.value" dense autofocus counter @keyup.enter="scope.set" />
                      </q-popup-edit>
                    </q-td>
                  </q-tr>
                </template>
              </q-table>
              <q-btn glossy class="q-ma-sm" label="Save" type="submit" color="primary" />
              <q-btn glossy class="q-ma-sm" label="Add Item" @click="addItem" color="positive" />

            </div>

          </div>
        </div>
      </q-form>

    </q-card>
  </q-page>
</template>

<style scoped lang="scss"></style>
