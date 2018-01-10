import Cookies from 'js-cookie'

const TokenKey = 'SID'
const UserIdKey = 'USERID'

export const getToken = () => {
  return Cookies.get(TokenKey)
}

export const setToken = (token) => {
  return Cookies.set(TokenKey, token)
}

export const removeToken = () => {
  return Cookies.remove(TokenKey)
}

export const setUserId = (userId) => {
  return Cookies.set(UserIdKey, userId)
}

export const getUserId = () => {
  return Cookies.get(UserIdKey)
}
