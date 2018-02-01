import request from '@/libs/request'

/**
 * 获取登录用户信息
 */
export const getUserInfo = (id) => request({
  url: 'admin/users/' + id,
  method: 'get'
})

/**
 * 更新个人信息
 */
export const updateUser = (data) => request({
  url: 'admin/users/' + data.id,
  method: 'put',
  data: data
})

/**
 * 更新个人密码
 */
export const updatePass = (id, data) => request({
  url: 'admin/users/' + id + '/update_password',
  method: 'post',
  data: data
})
