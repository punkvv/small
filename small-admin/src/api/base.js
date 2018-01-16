import request from '@/libs/request'

// 记录错误日志
export const addErrorLog = (router, message) => request({
  url: 'index/error_logs',
  method: 'post',
  data: {router: router, message: message}
})
