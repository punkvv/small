import request from '@/libs/request'

/**
 * 日志列表
 * @param params
 */
export const apiLogList = (params) => request({
  url: 'admin/api_logs',
  method: 'get',
  params: params
})
