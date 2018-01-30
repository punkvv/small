import request from '@/libs/request'

/**
 * 用户列表
 * @param params
 */
export const adminUserList = (params) => request({
  url: 'admin/admin_users',
  method: 'get',
  params: params
})

/**
 * 创建用户
 * @param data
 */
export const createAdminUser = (data) => request({
  url: 'admin/admin_users',
  method: 'post',
  data: data
})

/**
 * 更新用户
 * @param data
 */
export const updateAdminUser = (data) => request({
  url: 'admin/admin_users/' + data.id,
  method: 'put',
  data: data
})

/**
 * 删除用户
 * @param id
 */
export const deleteAdminUser = (id) => request({
  url: 'admin/admin_users/' + id,
  method: 'delete'
})

/**
 * 禁用/启用
 * @param id
 * @param type
 */
export const changeStatus = (id, type) => request({
  url: 'admin/admin_users/' + id + '/change_status',
  method: 'post',
  data: {type: type}
})

/**
 * 修改用户密码
 * @param id
 * @param password
 */
export const changePassword = (id, data) => request({
  url: 'admin/admin_users/' + id + '/change_password',
  method: 'post',
  data: data
})

/**
 * 获取用户角色
 * @param id
 */
export const roleListByAdmin = (id) => request({
  url: 'admin/admin_users/' + id + '/roles',
  method: 'get'
})

/**
 * 设置用户角色
 * @param data
 */
export const createRoleByAdmin = (id, data) => request({
  url: 'admin/admin_users/' + id + '/roles',
  method: 'post',
  data: {items: data}
})
