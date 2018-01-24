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
 * 删除角色
 * @param id
 */
export const deleteRole = (id) => request({
  url: 'admin/roles/' + id,
  method: 'delete'
})
