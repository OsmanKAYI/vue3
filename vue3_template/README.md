# Form Project

This template should help get you started developing with Vue 3 in Vite.

## Database Definition

```SQL
-- Adminer 4.8.1 MySQL 5.5.5-10.6.12-MariaDB-0ubuntu0.22.04.1 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `dersler`;
CREATE TABLE `dersler` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `adi` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_turkish_ci;

INSERT INTO `dersler` (`id`, `adi`) VALUES
(1,	'PHP'),
(2,	'VUE'),
(3,	'MySQL'),
(4,	'HTML'),
(5,	'CSS'),
(6,	'JavaScript'),
(7,	'Redis'),
(8,	'Python');

DROP TABLE IF EXISTS `formlar`;
CREATE TABLE `formlar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `adsoyad` varchar(50) NOT NULL,
  `tc` varchar(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `sehir_id` int(11) NOT NULL,
  `dersler` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_turkish_ci;


DROP TABLE IF EXISTS `iller`;
CREATE TABLE `iller` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `il_adi` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

INSERT INTO `iller` (`id`, `il_adi`) VALUES
(1,	'Adana'),
(2,	'Adıyaman'),
(3,	'Afyonkarahisar'),
(4,	'Ağrı'),
(5,	'Aksaray'),
(6,	'Amasya'),
(7,	'Ankara'),
(8,	'Antalya'),
(9,	'Ardahan'),
(10,	'Artvin'),
(11,	'Aydın'),
(12,	'Balıkesir'),
(13,	'Bartın'),
(14,	'Batman'),
(15,	'Bayburt'),
(16,	'Bilecik'),
(17,	'Bingöl'),
(18,	'Bitlis'),
(19,	'Bolu'),
(20,	'Burdur'),
(21,	'Bursa'),
(22,	'Çanakkale'),
(23,	'Çankırı'),
(24,	'Çorum'),
(25,	'Denizli'),
(26,	'Diyarbakır'),
(27,	'Düzce'),
(28,	'Edirne'),
(29,	'Elazığ'),
(30,	'Erzincan'),
(31,	'Erzurum'),
(32,	'Eskişehir'),
(33,	'Gaziantep'),
(34,	'Giresun'),
(35,	'Gümüşhane'),
(36,	'Hakkari'),
(37,	'Hatay'),
(38,	'Iğdır'),
(39,	'Isparta'),
(40,	'İstanbul'),
(41,	'İzmir'),
(42,	'Kahramanmaraş'),
(43,	'Karabük'),
(44,	'Karaman'),
(45,	'Kars'),
(46,	'Kastamonu'),
(47,	'Kayseri'),
(48,	'Kırıkkale'),
(49,	'Kırklareli'),
(50,	'Kırşehir'),
(51,	'Kilis'),
(52,	'Kocaeli'),
(53,	'Konya'),
(54,	'Kütahya'),
(55,	'Malatya'),
(56,	'Manisa'),
(57,	'Mardin'),
(58,	'Mersin'),
(59,	'Muğla'),
(60,	'Muş'),
(61,	'Nevşehir'),
(62,	'Niğde'),
(63,	'Ordu'),
(64,	'Osmaniye'),
(65,	'Rize'),
(66,	'Sakarya'),
(67,	'Samsun'),
(68,	'Siirt'),
(69,	'Sinop'),
(70,	'Sivas'),
(71,	'Şanlıurfa'),
(72,	'Şırnak'),
(73,	'Tekirdağ'),
(74,	'Tokat'),
(75,	'Trabzon'),
(76,	'Tunceli'),
(77,	'Uşak'),
(78,	'Van'),
(79,	'Yalova'),
(80,	'Yozgat'),
(81,	'Zonguldak');

-- 2024-01-09 08:13:49
```

## How to Start

```BASH
npm create vue@latest

# Vue.js - The Progressive JavaScript Framework

# ✔ Project name: … form
# ✔ Add TypeScript? … [No] / Yes
# ✔ Add JSX Support? … [No] / Yes
# ✔ Add Vue Router for Single Page Application development? … No / [Yes]
# ✔ Add Pinia for state management? … No / [Yes]
# ✔ Add Vitest for Unit Testing? … [No] / Yes
# ✔ Add an End-to-End Testing Solution? › [No]
# ✔ Add ESLint for code quality? … No / [Yes]
# ✔ Add Prettier for code formatting? … No / [Yes]

# Scaffolding project in /var/www/html/vue3/form...

# Done. Now run:

# dive into project folder
cd form
# install dependencies
npm install
# format code
npm run format
# add vuetify to project
npm install vuetify
# start developing
npm run dev
```

## Prepare the Project

### Delete All the Files Under src/components

```BASH
cd src/components/
rm -rf *
touch aboutComponent.vue
vi aboutComponent.vue
```

```vue
<template>
  <div>
    <p>Hello from About Component</p>
  </div>
</template>
```

### Delete All the Files Under src/assets

```BASH
cd ../assets/
rm -rf *
touch base.css
```

### Delete Unnecessary Parts of src/router/index.js

```BASH
cd ../router/
rm -f index.js
touch index.js
vi index.js
```

- Paste the following code in index.js

```JS
import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import AboutView from '../views/AboutView.vue'
import PiniaView from '../views/PiniaView.vue'
import VuetifyView from '../views/VuetifyView.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeView
    },
    {
      path: '/about',
      name: 'about',
      component: AboutView
    },
    {
      path: '/pinia',
      name: 'pinia',
      component: PiniaView
    },
    {
      path: '/vuetify',
      name: 'vuetify',
      component: VuetifyView
    }
  ]
})

export default router
```

- :wq to save and exit

### Delete All the Files Under src/stores

```BASH
cd ../stores/
rm -rf *
touch global.js
vi global.js
```

```JS
import { ref } from 'vue'
import { defineStore } from 'pinia'

export const useGlobalStore = defineStore('counter', () => {
  const userName = ref('Osman Kayı')
  const count = ref(0)

  return { userName, count }
})

```

### Delete All the Files Under src/views

```BASH
cd ../views/
rm -rf *
touch HomeView.vue
vi HomeView.vue
```

```vue
<script setup>
import { useGlobalStore } from '@/stores/global'
const global = useGlobalStore()
</script>

<template>
  <main>
    <h1>Welcome to HelloView</h1>
    <p>Username: {{ global.userName }}</p>
    <p>Counter: {{ global.count }}</p>
  </main>
</template>
```

```BASH
touch AboutView.vue
vi AboutView.vue
```

```vue
<script setup>
import About from '@/components/aboutComponent.vue'
</script>

<template>
  <main>
    <h1>Welcome to AboutView</h1>
    <About />
  </main>
</template>
```

```BASH
touch PiniaView.vue
vi PiniaView.vue
```

```vue
<script setup>
import { useGlobalStore } from '@/stores/global'
const global = useGlobalStore()
</script>

<template>
  <main>
    <h1>Welcome to PiniaView</h1>
    <button @click="global.count++">Artır</button>
    <h3>global.counter adedi:</h3>
    {{ global.count }}
  </main>
</template>
```

```BASH
touch VuetifyView.vue
vi VuetifyView.vue
```

```vue
<template>
  <h1>Welcome to VuetifyView</h1>
  <v-btn prepend-icon="$vuetify" variant="outlined">Test</v-btn>
</template>
```

### Edit App.vue

```BASH
cd ../
rm -f App.vue
touch App.vue
vi App.vue
```

- Paste the following code in App.vue

```vue
<script setup>
import { RouterLink, RouterView } from 'vue-router'
</script>

<template>
  <header>
    <nav>
      <RouterLink to="/" style="margin-right: 15px">Home</RouterLink>
      <RouterLink to="/about" style="margin-right: 15px">About</RouterLink>
      <RouterLink to="/pinia" style="margin-right: 15px">Pinia</RouterLink>
      <RouterLink to="/vuetify" style="margin-right: 15px">Vuetify</RouterLink>
    </nav>
  </header>

  <RouterView />
</template>

<style scoped></style>
```

- :wq to save and exit

### Edit main.js

```BASH
rm -f main.js
touch main.js
vi main.js
```

- Paste the following code in main.js

```JS
import { createApp } from 'vue'
import { createPinia } from 'pinia'

// Vuetify
import 'vuetify/styles'
import { createVuetify } from 'vuetify'
import * as components from 'vuetify/components'
import * as directives from 'vuetify/directives'

const vuetify = createVuetify({
  components,
  directives
})

import App from './App.vue'
import router from './router'

const app = createApp(App)

app.use(createPinia())
app.use(vuetify)
app.use(router)

app.mount('#app')

```

### Edit vite.config.js

```BASH
cd ../
rm -f vite.config.js
touch vite.config.js
vi vite.config.js
```

- Paste the following code in vite.config.js to dictate that your project works on current directory.

```JS
import { fileURLToPath, URL } from 'node:url'

import { defineConfig } from 'vite'
import vue from '@vitejs/plugin-vue'

// https://vitejs.dev/config/
export default defineConfig({
  plugins: [vue()],
  resolve: {
    alias: {
      '@': fileURLToPath(new URL('./src', import.meta.url))
    }
  },

  // my configurations
  base: './'
})
```

## Build the Project

```BASH
npm run build
```
