import request from '@/libs/request'

/**
 * 角色列表
 * @param params
 */
export const roleList = (params) => request({
  url: 'admin/roles',
  method: 'get',
  params: params
})

/**
 * 创建角色
 * @param data
 */
export const createRole = (data) => request({
  url: 'admin/roles',
  method: 'post',
  data: data
})

/**
 * 更新角色
 * @param data
 */
export const updateRole = (data) => request({
  url: 'admin/roles/' + data.id,
  method: 'put',
  data: data
})

/**
 * 删除菜单
 * @param id
 */
export const deleteRole = (id) => request({
  url: 'admin/roles/' + id,
  method: 'delete'
})

/**
 * 某个字段值相同数量
 * @param filed
 * @param value
 * @param id 排除的值
 */
export const countFiled = (filed, value, id = null) => request({
  url: 'admin/roles/count_filed',
  method: 'post',
  data: {filed: filed, value: value, id: id}
})
