import axios from 'axios'
import {getToken} from '@/libs/token'
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
  console.log('request:' + error)
  Promise.reject(error)
})

// respone interceptor
service.interceptors.response.use(
  response => {
    const data = response.data
    return data
  },
  error => {
    console.log('response:' + error)
    return Promise.reject(error)
  }
)

export default service
