import request from '@/libs/request'

// 用户名密码登录
export const login = (username, password) => request({
  url: 'admin/user/login',
  method: 'post',
  data: {username: username, password: password}
})

// 退出登录
export const logout = () => request({
  url: 'admin/user/logout',
  method: 'post'
})

// 获取登录用户信息
export const getUserInfo = (token) => request({
  url: 'admin/user/info',
  method: 'get',
  params: {token}
})
