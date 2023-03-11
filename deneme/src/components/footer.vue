<template>
  <v-footer class="bg-indigo-lighten-1 text-center d-flex flex-column">
    <v-item-group selected-class="bg-primary">
      <v-container>
        <v-row>
          <v-col cols="12" sm="3">
            <v-sheet class="ma-2 pa-2"> Çankırı Seferleri </v-sheet>
            <v-link>Çankırı-Ankara</v-link> <br />
            <v-link>Çankırı-İstanbul</v-link> <br />
            <v-link>Çankırı-Kastamonu</v-link> <br />
          </v-col>
          <v-col cols="12" sm="3">
            <v-sheet class="ma-2 pa-2"> İstanbul Seferleri </v-sheet>
            <v-link>İstanbul-Çankırı</v-link> <br />
            <v-link>İstanbul-Kastamonu</v-link> <br />
          </v-col>
          <v-col cols="12" sm="3">
            <v-sheet class="ma-2 pa-2"> Ankara Seferleri </v-sheet>
            <v-link>Ankara-Çankırı</v-link> <br />
            <v-link>Ankara-Kastamonu</v-link> <br />
          </v-col>
          <v-col cols="12" sm="3">
            <v-sheet class="ma-2 pa-2"> Kastamonu Seferleri </v-sheet>
            <v-link>Kastamonu-Çankırı</v-link> <br />
            <v-link>Kastamonu-İstanbul</v-link> <br />
            <v-link>Kastamonu-Ankara</v-link> <br />
          </v-col>
        </v-row>
      </v-container>
      <v-container></v-container>
    </v-item-group>

    <div>{{ new Date().getFullYear() }} — <strong>Osman KAYI</strong></div>
  </v-footer>
</template>

<script></script>
