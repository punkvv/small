import Vue from 'vue'

import ElementUI from 'element-ui'
import 'element-ui/lib/theme-chalk/index.css'

import '@/styles/index.css'

import App from './app'
import {router} from './router/index'
import store from './store'

import SvgIcon from '@/components/svg-icon' // svg组件
Vue.component('svg-icon', SvgIcon)

Vue.config.productionTip = false

Vue.use(ElementUI)
/* eslint-disable no-new */
new Vue({
  el: '#app',
  router,
  store,
  template: '<App/>',
  components: {App}
})
