<script setup lang="ts">
import { ref, computed } from 'vue'
import { useQuasar, date } from 'quasar'
const $q = useQuasar()

const btnTheme = computed(() => {
  return $q.dark.isActive ? 'bg-grey-5 text-black' : 'bg-grey-9 text-white';
})

const onSubmit = () => {
  console.log('submit')
}

const addItem = () => {
  rows.value.push({
    itemId: 0,
    sortOrder: rows.value.length * 10 + 10,
    productName: '',
    amount: 0,
    unit: '',
    unitPrice: 0,
    total: 0,
    picture: ''
  });
}

const offerDate = ref(date.formatDate(Date.now(), 'YYYY-MM-DD'))
const title = ref('')
const firmName = ref('')
const firmAdress = ref('')
const authName = ref('')
const authPhone = ref('')
const authEmail = ref('')
const situation = ref('')
const discount = ref('')
const currency = ref('');
const currencyOptions = ['TL', 'USD', 'EUR', 'RUB', 'UAH']
const hasPhoto = ref('')
const hasPhotoOptions = ['YES', 'NO']
const tax = ref('')
const taxOptions = ['VAX Included', 'VAX is NOT Included']
const transportation = ref('')
const transportationOptions = ['Transportation Included', 'Transportation is NOT Included']
const assembly = ref('')
const assemblyOptions = ['Assembly Included', 'Assembly is NOT Included']
const extra = ref([''])
const extraOptions = ['Extra 1', 'Extra 2', 'Extra 3', 'Extra 4']
const notes = ref('')

const tempDate = ref()
function saveDate() {
  offerDate.value = tempDate.value
}

interface TableColumn {
  name: string;
  required?: boolean;
  label: string;
  align: 'left' | 'center' | 'right';
  field: (row: RowType) => any;
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
  amount: number;
  unit: string;
  unitPrice: number;
  total: number;
  picture: string;
}

const amount = ref(0)
const unitPrice = ref(0)
const total = computed(() => amount.value * unitPrice.value);

const rows = ref([
  { itemId: 0, sortOrder: 10, productName: '', amount: amount.value, unit: '', unitPrice: unitPrice.value, total: total.value, picture: '' },
]);
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
              <q-input class="col-3 q-mt-sm" filled v-model="offerDate" label="Offer Date" mask="date">
                <template #prepend><q-icon name="today" size="32px" /></template>
                <template #label>
                  <div class="text-cyan">Offer Date</div>
                </template>
                <template #append>
                  <q-icon name="event" class="cursor-pointer">
                    <q-popup-proxy @before-show="offerDate == '' ? tempDate = new Date() : tempDate = offerDate" cover
                      transition-show="scale" transition-hide="scale">
                      <q-date v-model="tempDate">
                        <div class="row items-center justify-end q-gutter-sm">
                          <q-btn :class="btnTheme" label="Cancel" flat v-close-popup />
                          <q-btn :class="btnTheme" label="OK" flat @click="saveDate" v-close-popup />
                        </div>
                      </q-date>
                    </q-popup-proxy>
                  </q-icon>
                </template>
              </q-input>

              <q-input filled class="col-8" v-model="title" label="Title">
                <template #prepend>
                  <q-icon name="title" />
                </template>
                <template #label>
                  <div class="text-cyan">Title</div>
                </template>
              </q-input>

              <q-input filled class="col-12" v-model="firmName" label="Firm Name">
                <template #prepend>
                  <q-icon name="badge" />
                </template>
                <template #label>
                  <div class="text-cyan">Firm Name</div>
                </template>
              </q-input>

              <q-input filled class="col-12" type="textarea" v-model="firmAdress" label="Firm Adress">
                <template #prepend>
                  <q-icon name="business" />
                </template>
                <template #label>
                  <div class="text-cyan">Firm Adress</div>
                </template>
              </q-input>

              <q-input filled class="col-6" v-model="authName" label="Authorised Name">
                <template #prepend>
                  <q-icon name="person" />
                </template>
                <template #label>
                  <div class="text-cyan">Authorised Name</div>
                </template>
              </q-input>

              <q-input filled class="col-5" v-model="authPhone" label="Authorised Phone" mask="phone">
                <template #prepend>
                  <q-icon name="phone" />
                </template>
                <template #label>
                  <div class="text-cyan">Authorised Phone</div>
                </template>
              </q-input>

              <q-input filled class="col-12" v-model="authEmail" label="Authorised Email">
                <template #prepend>
                  <q-icon name="mail" />
                </template>
                <template #label>
                  <div class="text-cyan">Authorised Email</div>
                </template>
              </q-input>

              <q-input filled class="col-12" v-model="situation" label="Situation">
                <template #prepend>
                  <q-icon name="turned_in" />
                </template>
                <template #label>
                  <div class="text-cyan">Situation</div>
                </template>
              </q-input>

              <q-input filled class="col-5" v-model="discount" label="Discount">
                <template #prepend>
                  <q-icon name="price_change" />
                </template>
                <template #label>
                  <div class="text-cyan">Discount</div>
                </template>
              </q-input>

              <q-select filled class="col-3" v-model="currency" label="Currency" options-cover transition-show="flip-up"
                transition-hide="flip-down" :options="currencyOptions">
                <template #prepend>
                  <q-icon name="currency_exchange" />
                </template>
                <template #label>
                  <div class="text-cyan">Currency</div>
                </template>
              </q-select>

              <q-select filled class="col-3" v-model="hasPhoto" label="Has Photo" options-cover transition-show="flip-up"
                transition-hide="flip-down" :options="hasPhotoOptions">
                <template #prepend>
                  <q-icon name="photo" />
                </template>
                <template #label>
                  <div class="text-cyan">Has Photo</div>
                </template>
              </q-select>

              <q-select filled class="col-5" v-model="tax" label="Tax" options-cover transition-show="flip-up"
                transition-hide="flip-down" :options="taxOptions">
                <template #prepend>
                  <q-icon name="request_quote" />
                </template>
                <template #label>
                  <div class="text-cyan">Tax</div>
                </template>
              </q-select>

              <q-select filled class="col-6" v-model="transportation" label="Transportation" options-cover
                transition-show="flip-up" transition-hide="flip-down" :options="transportationOptions">
                <template #prepend>
                  <q-icon name="local_shipping" />
                </template>
                <template #label>
                  <div class="text-cyan">Transportation</div>
                </template>
              </q-select>

              <q-select filled class="col-6" v-model="assembly" label="Assembly" options-cover transition-show="flip-up"
                transition-hide="flip-down" :options="assemblyOptions">
                <template #prepend>
                  <q-icon name="download_done" />
                </template>
                <template #label>
                  <div class="text-cyan">Assembly</div>
                </template>
              </q-select>

              <q-select filled class="col-5" v-model="extra" label="Extra" options-cover transition-show="flip-up"
                transition-hide="flip-down" :options="extraOptions" multiple>
                <template #prepend>
                  <q-icon name="expand_circle_down" />
                </template>
                <template #label>
                  <div class="text-cyan">Extra</div>
                </template>
              </q-select>

              <q-input filled class="col-12" type="textarea" v-model="notes" label="Notes">
                <template #prepend>
                  <q-icon name="note_add" />
                </template>
                <template #label>
                  <div class="text-cyan">Notes</div>
                </template>
              </q-input>
            </div>

            <div class="row q-gutter-sm">
              <q-table class="col-12" bordered title="Items" :rows="rows" :columns="columns" row-key="name"
                binary-state-sort>
                <template #body="props">
                  <q-tr :props="props">
                    <q-td v-for="column in columns" :key="column.name" :props="props">
                      <q-input v-if="column.name !== 'total'" v-model="props.row[column.name]" dense outlined />
                      <span v-else>{{ props.row.total }}</span>
                    </q-td>
                  </q-tr>
                </template>
              </q-table>
              <q-btn glossy class=" q-ma-sm" label="Save" type="submit" color="primary" />
              <q-btn glossy class="q-ma-sm" label="Add Item" @click="addItem" color="positive" />
            </div>

          </div>
        </div>
      </q-form>

    </q-card>
  </q-page>
</template>

<style scoped lang="scss"></style>
