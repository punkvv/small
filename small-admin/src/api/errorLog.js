import request from '@/libs/request'

/**
 * 记录错误日志
 * @param router
 * @param message
 */
export const createErrorLog = (router, message) => request({
  url: 'admin/error_logs',
  method: 'post',
  data: {router: router, message: message}
})

/**
 * 日志列表
 * @param params
 */
export const errorLogList = (params) => request({
  url: 'admin/error_logs',
  method: 'get',
  params: params
})

/**
 * 获取未处理错误数
 */
export const errorLogDynamicCount = () => request({
  url: 'admin/error_logs/dynamic_count',
  method: 'get'
})

/**
 * 打开/处理
 * @param id
 * @param type
 */
export const changeStatus = (id, type) => request({
  url: 'admin/error_logs/' + id + '/change_status',
  method: 'post',
  data: {type: type}
})

/**
 * 处理全部
 */
export const changeStatusAll = () => request({
  url: 'admin/error_logs/change_status',
  method: 'post'
})

/**
 * 删除全部
 */
export const deleteAll = () => request({
  url: 'admin/error_logs/delete_all',
  method: 'post'
})
