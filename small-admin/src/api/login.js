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
