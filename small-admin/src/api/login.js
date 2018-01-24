import request from '@/libs/request'

/**
 * 用户名密码登录
 * @param username
 * @param password
 */
export const loginByPassword = (username, password) => request({
  url: 'admin/login/login_by_password',
  method: 'post',
  data: {username: username, password: password}
})

/**
 * 获取登录用户信息
 */
export const getUserInfo = () => request({
  url: 'admin/users/info',
  method: 'get'
})
