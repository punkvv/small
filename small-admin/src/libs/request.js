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
    config.headers['V-Token'] = getToken()
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
    const response = error.response
    const data = response.data
    Message({
      message: data.message,
      type: 'error',
      showClose: true,
      duration: 5 * 1000
    })
    return Promise.reject(error)
  }
)

export default service
