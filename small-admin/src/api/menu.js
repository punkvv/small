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

/**
 * 创建菜单
 * @param data
 */
export const createMenu = (data) => request({
  url: 'admin/menus',
  method: 'post',
  data: data
})

/**
 * 更新菜单
 * @param data
 */
export const updateMenu = (data) => request({
  url: 'admin/menus/' + data.id,
  method: 'put',
  data: data
})

/**
 * 删除菜单
 * @param id
 */
export const deleteMenu = (id) => request({
  url: 'admin/menus/' + id,
  method: 'delete'
})
