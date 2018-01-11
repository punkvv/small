import Cookies from 'js-cookie'

const TokenKey = 'SID'
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

export const getSidebarStatus = () => {
  return Cookies.get(SidebarStatus)
}

export const setSidebarStatus = (status) => {
  return Cookies.set(SidebarStatus, status)
}
