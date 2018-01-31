import Vue from 'vue'
import {createErrorLog} from '@/api/system/errorLog'

// you can set only in production env show the error-log
if (process.env.NODE_ENV === 'production') {
  Vue.config.errorHandler = (err, vm, info, a) => {
    // Don't ask me why I use Vue.nextTick, it just a hack.
    // detail see https://forum.vuejs.org/t/dispatch-in-vue-config-errorhandler-has-some-problem/23500
    const url = window.location.href
    Vue.nextTick(() => {
      createErrorLog(url, err.message + ':' + vm.$vnode.tag)
      console.error(err, info)
    })
  }
}
