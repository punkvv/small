import {constantRouter, asyncRouter} from '@/router/router'

const permission = {
  state: {
    routers: constantRouter,
    addRouters: []
  },
  mutations: {
    SET_ROUTERS: (state, routers) => {
      state.addRouters = routers
      state.routers = constantRouter.concat(routers)
    }
  },
  actions: {
    generateRoutes({commit}, data) {
      return new Promise(resolve => {
        // const router = data.router
        let accessedRouters
        const userId = data.user_info.id
        if (userId === 1) {
          accessedRouters = asyncRouter
        } else {
          accessedRouters = []
        }
        commit('SET_ROUTERS', accessedRouters)
        resolve()
      })
    }
  }
}

export default permission
