import {loginByPassword, getUserInfo} from '@/api/login'
import {getToken, setToken, removeToken, getUserId, setUserId} from '@/libs/cookie'

const user = {
  state: {
    token: getToken(),
    id: getUserId(),
    name: '',
    avatar: '',
    router: []
  },
  mutations: {
    SET_TOKEN: (state, token) => {
      state.token = token
    },
    SET_ID: (state, id) => {
      state.id = id
    },
    SET_NAME: (state, name) => {
      state.name = name
    },
    SET_AVATAR: (state, avatar) => {
      state.avatar = avatar
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
          const id = data.id
          commit('SET_TOKEN', token)
          commit('SET_ID', id)
          setToken(token)
          setUserId(id)
          resolve()
        }).catch(error => {
          reject(error)
        })
      })
    },
    getUserInfo({commit, state}) {
      return new Promise((resolve, reject) => {
        getUserInfo(state.id).then(data => {
          const userInfo = data.user_info
          commit('SET_ID', userInfo.id)
          commit('SET_NAME', userInfo.username)
          commit('SET_AVATAR', userInfo.avatar)
          commit('SET_ROUTER', data.router)
          resolve(data)
        }).catch(error => {
          reject(error)
        })
      })
    },
    // 登出
    logOut({commit}) {
      return new Promise(resolve => {
        commit('SET_TOKEN', '')
        removeToken()
        resolve()
      })
    }
  }
}

export default user
