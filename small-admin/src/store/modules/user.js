import {login} from '@/api/login'
import {getToken, setToken} from '@/libs/token'

const user = {
  state: {
    token: getToken(),
    name: '',
    avatar: '',
    roles: []
  },
  mutations: {},
  actions: {
    // 登录
    login({commit}, userInfo) {
      return new Promise((resolve, reject) => {
        login(userInfo.username, userInfo.password).then(data => {
          if (data.status === 1) {
            const token = data.token
            commit('SET_TOKEN', token)
            setToken(token)
          }
          resolve(data)
        }).catch(error => {
          reject(error)
        })
      })
    }
  }
}

export default user
