import {loginByPassword, getUserInfo} from '@/api/login'
import {getToken, setToken, setUserId, getUserId} from '@/libs/cookie'

const user = {
  state: {
    token: getToken(),
    id: getUserId(),
    name: '',
    avatar: '',
    router: []
  },
  mutations: {
    SET_ID: (state, id) => {
      state.id = id
    },
    SET_TOKEN: (state, token) => {
      state.token = token
    },
    SET_NAME: (state, name) => {
      state.name = name
    },
    SET_ROUTER: (state, router) => {
      state.router = router
    }
  },
  actions: {
    // 登录
    loginByPassword({commit}, userInfo) {
      return new Promise((resolve, reject) => {
        loginByPassword(userInfo.username, userInfo.password).then(data => {
          const token = data.token
          const userId = data.id
          commit('SET_ID', userId)
          commit('SET_TOKEN', token)
          setToken(token)
          setUserId(userId)
          resolve()
        }).catch(error => {
          reject(error)
        })
      })
    },
    getUserInfo({commit, state}) {
      return new Promise((resolve, reject) => {
        getUserInfo(state.id).then(data => {
          commit('SET_NAME', data.name)
          commit('SET_ROUTER', data.router)
          resolve(data)
        }).catch(error => {
          reject(error)
        })
      })
    }
  }
}

export default user
