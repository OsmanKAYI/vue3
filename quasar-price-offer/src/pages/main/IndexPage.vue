<script setup lang="ts">
import { computed } from 'vue'
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
                    <q-btn :class="btnTheme" class="col-1 q-ml-xs rounded-borders">All</q-btn>
                    <q-btn :class="btnTheme" class="col-1 q-ml-xs rounded-borders">10</q-btn>
                    <q-btn :class="btnTheme" class="col-1 q-ml-xs rounded-borders">50</q-btn>
                    <q-btn :class="btnTheme" class="col-1 q-ml-xs rounded-borders">100</q-btn>
                    <q-btn :class="btnTheme" class="col-1 q-ml-xs rounded-borders">200</q-btn>
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
          <tr>
            <td class="text-left">Frozen Yogurt</td>
            <td class="text-right">159</td>
            <td class="text-right">6</td>
            <td class="text-right">24</td>
            <td class="text-right">24</td>
            <td class="text-right">4</td>
          </tr>
          <tr>
            <td class="text-left">Ice cream sandwich</td>
            <td class="text-right">237</td>
            <td class="text-right">9</td>
            <td class="text-right">37</td>
            <td class="text-right">37</td>
            <td class="text-right">4.3</td>
          </tr>
          <tr>
            <td class="text-left">Eclair</td>
            <td class="text-right">262</td>
            <td class="text-right">16</td>
            <td class="text-right">23</td>
            <td class="text-right">23</td>
            <td class="text-right">6</td>
          </tr>
          <tr>
            <td class="text-left">Cupcake</td>
            <td class="text-right">305</td>
            <td class="text-right">3.7</td>
            <td class="text-right">67</td>
            <td class="text-right">67</td>
            <td class="text-right">4.3</td>
          </tr>
          <tr>
            <td class="text-left">Gingerbread</td>
            <td class="text-right">356</td>
            <td class="text-right">16</td>
            <td class="text-right">49</td>
            <td class="text-right">49</td>
            <td class="text-right">3.9</td>
          </tr>
          <tr>
            <td class="text-left">Frozen Yogurt</td>
            <td class="text-right">159</td>
            <td class="text-right">6</td>
            <td class="text-right">24</td>
            <td class="text-right">24</td>
            <td class="text-right">4</td>
          </tr>
          <tr>
            <td class="text-left">Ice cream sandwich</td>
            <td class="text-right">237</td>
            <td class="text-right">9</td>
            <td class="text-right">37</td>
            <td class="text-right">37</td>
            <td class="text-right">4.3</td>
          </tr>
          <tr>
            <td class="text-left">Eclair</td>
            <td class="text-right">262</td>
            <td class="text-right">16</td>
            <td class="text-right">23</td>
            <td class="text-right">23</td>
            <td class="text-right">6</td>
          </tr>
          <tr>
            <td class="text-left">Cupcake</td>
            <td class="text-right">305</td>
            <td class="text-right">3.7</td>
            <td class="text-right">67</td>
            <td class="text-right">67</td>
            <td class="text-right">4.3</td>
          </tr>
          <tr>
            <td class="text-left">Gingerbread</td>
            <td class="text-right">356</td>
            <td class="text-right">16</td>
            <td class="text-right">49</td>
            <td class="text-right">49</td>
            <td class="text-right">3.9</td>
          </tr>
          <tr>
            <td class="text-left">Frozen Yogurt</td>
            <td class="text-right">159</td>
            <td class="text-right">6</td>
            <td class="text-right">24</td>
            <td class="text-right">24</td>
            <td class="text-right">4</td>
          </tr>
          <tr>
            <td class="text-left">Ice cream sandwich</td>
            <td class="text-right">237</td>
            <td class="text-right">9</td>
            <td class="text-right">37</td>
            <td class="text-right">37</td>
            <td class="text-right">4.3</td>
          </tr>
          <tr>
            <td class="text-left">Eclair</td>
            <td class="text-right">262</td>
            <td class="text-right">16</td>
            <td class="text-right">23</td>
            <td class="text-right">23</td>
            <td class="text-right">6</td>
          </tr>
          <tr>
            <td class="text-left">Cupcake</td>
            <td class="text-right">305</td>
            <td class="text-right">3.7</td>
            <td class="text-right">67</td>
            <td class="text-right">67</td>
            <td class="text-right">4.3</td>
          </tr>
          <tr>
            <td class="text-left">Gingerbread</td>
            <td class="text-right">356</td>
            <td class="text-right">16</td>
            <td class="text-right">49</td>
            <td class="text-right">49</td>
            <td class="text-right">3.9</td>
          </tr>
          <tr>
            <td class="text-left">Frozen Yogurt</td>
            <td class="text-right">159</td>
            <td class="text-right">6</td>
            <td class="text-right">24</td>
            <td class="text-right">24</td>
            <td class="text-right">4</td>
          </tr>
          <tr>
            <td class="text-left">Ice cream sandwich</td>
            <td class="text-right">237</td>
            <td class="text-right">9</td>
            <td class="text-right">37</td>
            <td class="text-right">37</td>
            <td class="text-right">4.3</td>
          </tr>
          <tr>
            <td class="text-left">Eclair</td>
            <td class="text-right">262</td>
            <td class="text-right">16</td>
            <td class="text-right">23</td>
            <td class="text-right">23</td>
            <td class="text-right">6</td>
          </tr>
          <tr>
            <td class="text-left">Cupcake</td>
            <td class="text-right">305</td>
            <td class="text-right">3.7</td>
            <td class="text-right">67</td>
            <td class="text-right">67</td>
            <td class="text-right">4.3</td>
          </tr>
          <tr>
            <td class="text-left">Gingerbread</td>
            <td class="text-right">356</td>
            <td class="text-right">16</td>
            <td class="text-right">49</td>
            <td class="text-right">49</td>
            <td class="text-right">3.9</td>
          </tr>
        </tbody>
      </q-markup-table>
    </div>

  </q-page>
</template>
