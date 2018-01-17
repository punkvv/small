import request from '@/libs/request'

/**
 * 记录错误日志
 * @param router
 * @param message
 */
export const createErrorLog = (router, message) => request({
  url: 'index/error_logs',
  method: 'post',
  data: {router: router, message: message}
})

/**
 * 日志列表
 * @param params
 */
export const errorLogList = (params) => request({
  url: 'index/error_logs',
  method: 'get',
  params: params
})

/**
 * 获取未处理错误数
 */
export const errorLogDynamicCount = () => request({
  url: 'index/error_logs/dynamic_count',
  method: 'get'
})
