import request from '@/libs/request'

// 菜单列表
export const menuList = (query) => request({
  url: 'admin/menus',
  method: 'get',
  params: query
})
