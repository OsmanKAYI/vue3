<script setup lang="ts">
import { ref, computed, watchEffect } from 'vue'
import { useQuasar, date, scroll } from 'quasar'
const $q = useQuasar()
const { getScrollTarget, setVerticalScrollPosition } = scroll
import { TableColumn, RowType } from 'src/types/types'

// takes an element object
function scrollToElement(el: Element) {
  const target = getScrollTarget(el)
  const offset = (el as HTMLElement).offsetTop
  const duration = 1000
  setVerticalScrollPosition(target, offset, duration)
}

const btnTheme = computed(() => {
  return $q.dark.isActive ? 'bg-grey-5 text-black' : 'bg-grey-9 text-white';
})

const offerDate = ref(date.formatDate(Date.now(), 'YYYY-MM-DD'))
const title = ref('')
const firmName = ref('')
const firmAddress = ref('')
const authName = ref('')
const authPhone = ref('')
const authEmail = ref('')
const situation = ref('')
const discount = ref()
const currency = ref('');
const currencyOptions = [{ label: 'Currency', value: '', disable: true }, 'TL', 'USD', 'EUR', 'RUB', 'UAH']
const hasPhoto = ref('')
const hasPhotoOptions = [{ label: 'Has Photo', value: '', disable: true }, 'YES', 'NO']
const tax = ref('')
const taxOptions = [{ label: 'Tax', value: '', disable: true }, 'VAX Included', 'VAX is NOT Included']
const transportation = ref('')
const transportationOptions = [{ label: 'Transportation', value: '', disable: true }, 'Transportation Included', 'Transportation is NOT Included']
const assembly = ref('')
const assemblyOptions = [{ label: 'Assembly', value: '', disable: true }, 'Assembly Included', 'Assembly is NOT Included']
const extra = ref<Array<string>>([]);
const extraOptions = [{ label: 'Extras', value: '', disable: true }, 'Extra 1', 'Extra 2', 'Extra 3', 'Extra 4']
const notes = ref('')

const tempDate = ref()
function saveDate() {
  offerDate.value = tempDate.value
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

const rows = ref([
  { itemId: 1, sortOrder: 10, productName: '', amount: 0, unit: '', unitPrice: 0, total: 0, picture: '' },
]);

watchEffect(() => {
  rows.value.forEach(item => {
    item.total = item.amount * item.unitPrice;
  });
});

const onSave = () => {
  console.log('Offer created !')
}

const addItem = () => {
  const newItem = {
    itemId: rows.value.length + 1,
    sortOrder: rows.value.length * 10 + 10,
    productName: '',
    amount: 0,
    unit: '',
    unitPrice: 0,
    total: 0, // Remove the static value here
    picture: ''
  };
  // Push the new item to the rows array
  rows.value.push(newItem);

  // Scroll to the bottom
  const bottomAnchor = document.getElementById('bottom');
  if (bottomAnchor) {
    scrollToElement(bottomAnchor);
  }
}
</script>

<template>
  <q-page padding class="justify-evenly">
    <q-card bordered class="q-pa-xl q-ma-md">

      <q-form @submit="onSave" autocomplete="off" autocapitalize="on">
        <div class="row q-pa-md justify-center">
          <div class="col" style="max-width: 800px">
            <div class="text-h4 q-pa-sm q-mb-sm text-weight-bold text-center"
              style="color: grey; background-color: lightgrey">
              New Offer</div>

            <div class="row q-col-gutter-xs">
              <q-input class="col-12 col-md-4" filled v-model="offerDate" label="Offer Date" mask="date">
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

              <q-input filled class="col-12 col-md-8" v-model="title" label="Title">
                <template #prepend>
                  <q-icon name="title" />
                </template>
                <template #label>
                  <div class="text-cyan">Title</div>
                </template>
              </q-input>
              <q-input filled class="col-12 col-md-12" v-model="firmName" label="Firm Name">
                <template #prepend>
                  <q-icon name="badge" />
                </template>
                <template #label>
                  <div class="text-cyan">Firm Name</div>
                </template>
              </q-input>

              <q-input filled class="col-12 col-md-12" type="textarea" v-model="firmAddress" label="Firm Address">
                <template #prepend>
                  <q-icon name="business" />
                </template>
                <template #label>
                  <div class="text-cyan">Firm Address</div>
                </template>
              </q-input>

              <q-input filled class="col-12 col-md-7" v-model="authName" label="Authorised Name">
                <template #prepend>
                  <q-icon name="person" />
                </template>
                <template #label>
                  <div class="text-cyan">Authorised Name</div>
                </template>
              </q-input>

              <q-input filled class="col-12 col-md-5" v-model="authPhone" label="Authorised Phone" mask="phone">
                <template #prepend>
                  <q-icon name="phone" />
                </template>
                <template #label>
                  <div class="text-cyan">Authorised Phone</div>
                </template>
              </q-input>

              <q-input filled class="col-12 col-md-12" v-model="authEmail" label="Authorised Email">
                <template #prepend>
                  <q-icon name="mail" />
                </template>
                <template #label>
                  <div class="text-cyan">Authorised Email</div>
                </template>
              </q-input>

              <q-input filled class="col-12 col-md-12" v-model="situation" label="Situation">
                <template #prepend>
                  <q-icon name="turned_in" />
                </template>
                <template #label>
                  <div class="text-cyan">Situation</div>
                </template>
              </q-input>

              <q-input filled class="col-12 col-md-4" v-model="discount" label="Discount">
                <template #prepend>
                  <q-icon name="price_change" />
                </template>
                <template #label>
                  <div class="text-cyan">Discount</div>
                </template>
              </q-input>

              <q-select filled class="col-12 col-md-4" v-model="currency" label="Currency" options-cover
                transition-show="flip-up" transition-hide="flip-down" :options="currencyOptions">
                <template #prepend>
                  <q-icon name="currency_exchange" />
                </template>
                <template #label>
                  <div class="text-cyan">Currency</div>
                </template>
              </q-select>

              <q-select filled class="col-12 col-md-4" v-model="hasPhoto" label="Has Photo" options-cover
                transition-show="flip-up" transition-hide="flip-down" :options="hasPhotoOptions">
                <template #prepend>
                  <q-icon name="photo" />
                </template>
                <template #label>
                  <div class="text-cyan">Has Photo</div>
                </template>
              </q-select>

              <q-select filled class="col-12 col-md-5" v-model="tax" label="Tax" options-cover transition-show="flip-up"
                transition-hide="flip-down" :options="taxOptions">
                <template #prepend>
                  <q-icon name="request_quote" />
                </template>
                <template #label>
                  <div class="text-cyan">Tax</div>
                </template>
              </q-select>

              <q-select filled class="col-12 col-md-7" v-model="transportation" label="Transportation" options-cover
                transition-show="flip-up" transition-hide="flip-down" :options="transportationOptions">
                <template #prepend>
                  <q-icon name="local_shipping" />
                </template>
                <template #label>
                  <div class="text-cyan">Transportation</div>
                </template>
              </q-select>

              <q-select filled class="col-12 col-md-5" v-model="assembly" label="Assembly" options-cover
                transition-show="flip-up" transition-hide="flip-down" :options="assemblyOptions">
                <template #prepend>
                  <q-icon name="download_done" />
                </template>
                <template #label>
                  <div class="text-cyan">Assembly</div>
                </template>
              </q-select>

              <q-select filled class="col-12 col-md-7" v-model="extra" label="Extra" options-cover
                transition-show="flip-up" transition-hide="flip-down" :options="extraOptions" multiple>
                <template #prepend>
                  <q-icon name="expand_circle_down" />
                </template>
                <template #label>
                  <div class="text-cyan">Extra</div>
                </template>
              </q-select>

              <q-input filled class="col-12 col-md-12" type="textarea" v-model="notes" label="Notes">
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
                    <q-td v-for="column in  columns " :key="column.name" :props="props">
                      <template v-if="column.name === 'picture' || column.name === 'unit'">
                        <q-select filled v-model="props.row[column.name]"
                          :options="props.row[column.name as keyof TableColumn]" dense outlined />
                      </template>
                      <template v-else-if="column.name === 'total'">
                        <span style="font-weight: bold;">{{ props.row[column.name] }}</span>
                      </template>
                      <template v-else>
                        <q-input filled v-model="props.row[column.name]" dense outlined />
                      </template>
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
    <div id="bottom" />
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
