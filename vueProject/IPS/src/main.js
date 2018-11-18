import Vue from 'vue'
import App from './App.vue'



import AppMainTableScreen from "./components/MainTableScreen.vue";
import AppSourceTableScreen from "./components/SourceTableScreen.vue";
import AppStartScreen from "./components/StartScreen.vue";
import AppViewDate from "./components/ViewDate.vue";


Vue.component('AppMainTableScreen', AppMainTableScreen);
Vue.component('AppSourceTableScreen', AppSourceTableScreen);
Vue.component('AppStartScreen', AppStartScreen);
Vue.component('AppViewDate', AppViewDate);



new Vue({
  el: '#app',
  render: h => h(App)
})
