import {loginByPassword, getUserInfo} from '@/api/login'
import {getToken, setToken} from '@/libs/token'

const user = {
  state: {
    token: getToken(),
    name: '',
    avatar: '',
    roles: []
  },
  mutations: {
    SET_TOKEN: (state, token) => {
      state.token = token
    }
  },
  actions: {
    // 登录
    loginByPassword({commit}, userInfo) {
      return new Promise((resolve, reject) => {
        loginByPassword(userInfo.username, userInfo.password).then(data => {
          const token = data.token
          commit('SET_TOKEN', token)
          setToken(token)
          resolve()
        }).catch(error => {
          reject(error)
        })
      })
    },
    getUserInfo({commit, state}) {
      return new Promise((resolve, reject) => {
        getUserInfo(state.token).then(response => {
          console.log(response)
        }).catch(error => {
          reject(error)
        })
      })
    }
  }
}

export default user
