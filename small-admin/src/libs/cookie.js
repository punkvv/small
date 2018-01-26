import Cookies from 'js-cookie'

const UserId = 'UID'
const TokenKey = 'TOKEN'
const SidebarStatus = 'SIDEBAR_STATUS'

export const getToken = () => {
  return Cookies.get(TokenKey)
}

export const setToken = (token) => {
  return Cookies.set(TokenKey, token)
}

export const removeToken = () => {
  return Cookies.remove(TokenKey)
}

export const getUserId = () => {
  return Cookies.get(UserId)
}

export const setUserId = (userId) => {
  return Cookies.set(UserId, userId)
}

export const getSidebarStatus = () => {
  return Cookies.get(SidebarStatus)
}

export const setSidebarStatus = (status) => {
  return Cookies.set(SidebarStatus, status)
}
