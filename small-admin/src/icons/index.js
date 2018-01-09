import Vue from 'vue'
import SvgIcon from '@/components/svg-icon' // svg 组件
Vue.component('svg-icon', SvgIcon)

const requireAll = requireContext => requireContext.keys().map(requireContext)
const req = require.context('./svg', false, /\.svg$/)
requireAll(req)
