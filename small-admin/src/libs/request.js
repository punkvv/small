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
  // Do something with request error
  console.log(error) // for debug
  Promise.reject(error)
})
