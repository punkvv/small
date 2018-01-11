import axios from 'axios'
import {Message} from 'element-ui'
import {getToken} from '@/libs/cookie'
import store from '@/store'

const service = axios.create({
  baseURL: process.env.BASE_URL,
  timeout: 5000 // request timeout
})

// request interceptor
service.interceptors.request.use(config => {
  if (store.getters.token) {
    config.headers['Authorization'] = 'Bearer ' + getToken()
  }
  return config
}, error => {
  Promise.reject(error)
})

// respone interceptor
service.interceptors.response.use(
  response => {
    const data = response.data
    return data
  },
  error => {
    const data = error.response.data
    const name = data.name
    Message({
      message: data.message,
      type: 'error',
      showClose: true,
      duration: 5 * 1000
    })
    if (name === 'TOKEN_FAIL') {
      // token 无效或者过期
      store.dispatch('logOut').then(() => {
        location.reload() // 为了重新实例化vue-router对象 避免bug
      })
    }
    return Promise.reject(error)
  }
)

export default service
