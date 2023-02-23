# pdo.router

This template should help get you started developing with Vue 3 in Vite.

## Recommended IDE Setup

[VSCode](https://code.visualstudio.com/) + [Volar](https://marketplace.visualstudio.com/items?itemName=Vue.volar) (and disable Vetur) + [TypeScript Vue Plugin (Volar)](https://marketplace.visualstudio.com/items?itemName=Vue.vscode-typescript-vue-plugin).

## Customize configuration

See [Vite Configuration Reference](https://vitejs.dev/config/).

## Project Setup

```sh
npm install
```

### Compile and Hot-Reload for Development

```sh
npm run dev
```

### Compile and Minify for Production

```sh
npm run build
```

### Lint with [ESLint](https://eslint.org/)

```sh
npm run lint
```

## Eğitim

- VUE: [koderhq.com](https://www.koderhq.com/tutorial/vue/)
- VUE ROUTER: [vueschool.io](https://vueschool.io/courses/vue-router-4-for-everyone?friend=vuerouter)

## route-guard Fire Sequence

[Kaynak: koderhq.com](https://www.koderhq.com/tutorial/vue/route-guard/)

- Lesson Video
- Lesson Project
- What is a Route Guard?
- Global route guards
  - The beforeEach route guard
  - The beforeResolve route guard
  - The afterEach route guard
- Local beforeEnter route definition guard
- Local component guards
  - The beforeRouteEnter in-component guard
  - The beforeRouteUpdate in-component guard
  - The beforeRouteLeave in-component guard
- The next guard method argument
- Further Reading

## Router URL'e Parametre ekleme

[Kaynak: stackoverflow.com](https://stackoverflow.com/a/62631184/134739)

**router/index.js:**

```JS
import VueRouter from 'vue-router'
import List from '../views/List.vue'
import Item from '../views/Item.vue'

Vue.use(VueRouter)

  const routes = [
  {
    path: '/',
    name: 'List',
    component: List
  },
  {
    path: '/item/:id',
    name: 'Item',
    component: Item
  }
]
```

**List.vue:**

```JS
// Yöntem 1:
<router-link :to="{ name: 'Item', params: { id: data.item.id }}">{{ data.item.id }}</router-link>

// Yöntem 2:
<router-link :to="`Item/$(data.item.id)`">{{ data.item.id }}</router-link>
```

**Item.vue:**

```JS
<template>
    id: {{ $route.params.id }}
</template>

<script>
    return this.$route.params.id
</script>
```
