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

export const countFiled = (filed, value) => request({
  url: 'admin/menus/count_filed',
  method: 'post',
  data: {filed: filed, value: value}
})
