import request from '@/libs/request'

// 用户名密码登录
export const loginByPassword = (username, password) => request({
  url: 'admin/login/login',
  method: 'post',
  data: {username: username, password: password}
})

// 退出登录
export const logout = () => request({
  url: 'admin/login/logout',
  method: 'post'
})

// 获取登录用户信息
export const getUserInfo = (id) => request({
  url: 'admin/users/' + id,
  method: 'get'
})
