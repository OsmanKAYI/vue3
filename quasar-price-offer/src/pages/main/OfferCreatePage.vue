<script setup lang="ts">
import { ref, computed, watchEffect } from 'vue'
import { useQuasar, date, scroll } from 'quasar'
const $q = useQuasar()
const { getScrollTarget, setVerticalScrollPosition } = scroll
import { TableColumn, RowType } from 'src/types/types'

const generalTheme = computed(() => {
  return $q.dark.isActive ? 'glossy bg-grey-7 text-white' : 'glossy bg-grey-5 text-black';
})

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
  { name: 'quantity', required: true, label: 'Quantity ', align: 'left', field: (row: RowType) => row.quantity, format: (val: string) => `${val}`, sortable: false },
  { name: 'unit', required: true, label: 'Unit ', align: 'left', field: (row: RowType) => row.unit, format: (val: string) => `${val}`, sortable: true },
  { name: 'unitPrice', required: true, label: 'Unit Price', align: 'left', field: (row: RowType) => row.unitPrice, format: (val: string) => `${val}`, sortable: true },
  { name: 'total', required: true, label: 'Total ', align: 'left', field: (row: RowType) => row.total, format: (val: string) => `${val}`, sortable: true },
  { name: 'picture', required: true, label: 'Picture ', align: 'left', field: (row: RowType) => row.picture, format: (val: string) => `${val}`, sortable: true },
];

const clearExtras = () => {
  extra.value = []; // Clear the selection
};

// add default 3 empty items
const defaultItemRow = { itemId: 1, sortOrder: 10, productName: '', quantity: 0, unit: '', unitPrice: 0, total: 0, picture: '' }
const itemRows = ref(Array(3).fill({ ...defaultItemRow }).map((row, index) => ({ ...row, sortOrder: row.sortOrder + (index * 10) })));

let dragItem: RowType | null = null;
const handleDragStart = (item: RowType, event: DragEvent) => {
  dragItem = item;
  event.dataTransfer?.setData('text/plain', ''); // Required for Firefox
}
const handleDragOver = (event: DragEvent) => {
  event.preventDefault();
}
const handleDrop = (targetItem: RowType) => {
  if (dragItem === null || dragItem === targetItem) {
    return;
  }
  const targetIndex = itemRows.value.indexOf(targetItem);
  const dragIndex = itemRows.value.indexOf(dragItem);

  itemRows.value.splice(targetIndex, 0, itemRows.value.splice(dragIndex, 1)[0]);

  // Update the sort order of items after rearranging
  itemRows.value.forEach((item, index) => {
    item.sortOrder = (index + 1) * 10; // Assuming a step of 10 for sort order
  });
  dragItem = null;
}
const dragMessage = ('* Drag and drop to reorder the items by holding the "Item Id" column in the row.');

watchEffect(() => {
  itemRows.value.forEach(item => {
    item.total = item.quantity * item.unitPrice;
  });
});

const onSave = () => {
  console.log('Offer created !')
}

const addItem = () => {
  const newItem = {
    itemId: itemRows.value.length + 1,
    sortOrder: itemRows.value.length * 10 + 10,
    productName: '',
    quantity: 0,
    unit: '',
    unitPrice: 0,
    total: 0,
    picture: ''
  };
  // Push the new item to the itemRows array
  itemRows.value.push(newItem);

  // Scroll to the bottom
  const bottomAnchor = document.getElementById('bottom');
  if (bottomAnchor) {
    scrollToElement(bottomAnchor);
  }
}

const calculateTotalPrice = () => {
  let sum = 0;
  for (const row of itemRows.value) {
    sum += parseFloat(row.total);
  }
  return sum.toFixed(2); // Adjust precision as needed
}
</script>

<template>
  <q-page padding class="justify-evenly">
    <q-card bordered class="q-pa-xl q-ma-md">

      <q-form @submit="onSave" autocomplete="off" autocapitalize="on">
        <div class="row q-pa-md justify-center">
          <div class="col col-md-12" style="max-width: 800px">
            <div class="text-h4 q-pa-sm q-mb-sm text-weight-bold text-center" :class="generalTheme"> New Offer</div>

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

              <q-input clearable clear-icon="delete" filled class="col-12 col-md-8" v-model="title" label="Title">
                <template #prepend>
                  <q-icon name="title" />
                </template>
                <template #label>
                  <div class="text-cyan">Title</div>
                </template>
              </q-input>
              <q-input clearable clear-icon="delete" filled class="col-12 col-md-12" v-model="firmName" label="Firm Name">
                <template #prepend>
                  <q-icon name="badge" />
                </template>
                <template #label>
                  <div class="text-cyan">Firm Name</div>
                </template>
              </q-input>

              <q-input clearable clear-icon="delete" filled class="col-12 col-md-12" type="textarea" v-model="firmAddress"
                label="Firm Address">
                <template #prepend>
                  <q-icon name="business" />
                </template>
                <template #label>
                  <div class="text-cyan">Firm Address</div>
                </template>
              </q-input>

              <q-input clearable clear-icon="delete" filled class="col-12 col-md-7" v-model="authName"
                label="Authorised Name">
                <template #prepend>
                  <q-icon name="person" />
                </template>
                <template #label>
                  <div class="text-cyan">Authorised Name</div>
                </template>
              </q-input>

              <q-input clearable clear-icon="delete" filled class="col-12 col-md-5" v-model="authPhone"
                label="Authorised Phone" mask="phone">
                <template #prepend>
                  <q-icon name="phone" />
                </template>
                <template #label>
                  <div class="text-cyan">Authorised Phone</div>
                </template>
              </q-input>

              <q-input clearable clear-icon="delete" filled class="col-12 col-md-12" v-model="authEmail"
                label="Authorised Email">
                <template #prepend>
                  <q-icon name="mail" />
                </template>
                <template #label>
                  <div class="text-cyan">Authorised Email</div>
                </template>
              </q-input>

              <q-input clearable clear-icon="delete" filled class="col-12 col-md-12" v-model="situation"
                label="Situation">
                <template #prepend>
                  <q-icon name="turned_in" />
                </template>
                <template #label>
                  <div class="text-cyan">Situation</div>
                </template>
              </q-input>

              <q-input clearable clear-icon="delete" filled class="col-12 col-md-4" v-model="discount" label="Discount">
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

              <q-select use-chips filled class="col-12 col-md-7" v-model="extra" label="Extra" options-cover
                transition-show="flip-up" transition-hide="flip-down" :options="extraOptions" multiple>
                <template #prepend>
                  <q-icon name="expand_circle_down" />
                </template>
                <template #label>
                  <div class="text-cyan">Extra</div>
                </template>
                <template #append>
                  <!-- Clear button added below -->
                  <q-btn flat v-if="extra.length > 0" class="cursor-pointer" @click="clearExtras" @click.stop>
                    <q-icon name="delete" />
                  </q-btn>
                </template>
              </q-select>

              <q-input clearable clear-icon="delete" filled class="col-12 col-md-12" type="textarea" v-model="notes"
                label="Notes">
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
              <q-table class="col-12" bordered :rows="itemRows" :columns="columns" row-key="name" binary-state-sort>
                <template #body="props">
                  <q-tr class="cursor-pointer" :props="props">
                    <q-td v-for="column in columns" :key="column.name" :props="props"
                      :draggable="column.name === 'itemId'" @dragstart="handleDragStart(props.row, $event)"
                      @dragover="handleDragOver" @drop="handleDrop(props.row)">
                      <template v-if="column.name === 'picture' || column.name === 'unit'">
                        <q-select filled v-model="props.row[column.name]"
                          :options="props.row[column.name as keyof TableColumn]" dense outlined />
                      </template>
                      <template v-else-if="column.name === 'total'">
                        <span style="font-weight: bold;">{{ props.row[column.name] }}</span>
                      </template>
                      <q-item-section v-else-if="column.name === 'itemId'" style=" cursor: move;">
                        <q-icon class="q-ma-sm q-pa-sm" size="xs" name="drag_indicator" />
                      </q-item-section>
                      <template v-else>
                        <q-input filled v-model="props.row[column.name]" dense outlined />
                      </template>
                    </q-td>
                  </q-tr>
                </template>
              </q-table>
              <!-- Add a div for the general sum -->
              <div class="col-12 q-pa-xs" style="max-width: 800px">
                <div class="text-h6 q-pr-lg text-weight-bold text-right" :class="generalTheme">
                  Total Price: {{ calculateTotalPrice() }} {{ currency }}
                </div>
              </div>
              <div class="col-12">
                <small class="text-green">{{ dragMessage }}</small>
              </div>
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

.drag-handle {
  cursor: grab;
}

/* Add styles for the draggable handle when being dragged */
.drag-handle:active {
  cursor: grabbing;
}
</style>
