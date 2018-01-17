import request from '@/libs/request'

/**
 * 菜单列表
 * @param params
 */
export const menuList = (params) => request({
  url: 'admin/menus',
  method: 'get',
  params: params
})
