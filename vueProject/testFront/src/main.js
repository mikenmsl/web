import Vue from 'vue'
import App from './App.vue'

import AppProductItem from "./components/ProductItem.vue";


Vue.component('AppProductItem', AppProductItem);

new Vue({
  el: '#app',
  render: h => h(App)
})
