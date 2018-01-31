import {constantRouter, asyncRouter} from '@/router/router'

function hasPermission(router, route) {
  return router.indexOf(route.name) >= 0 || route.name === undefined
}

function filterAsyncRouter(asyncRouter, router) {
  const accessedRouters = asyncRouter.filter(route => {
    if (hasPermission(router, route)) {
      if (route.children && route.children.length) {
        route.children = filterAsyncRouter(route.children, router)
      }
      return true
    }
    return false
  })
  return accessedRouters
}

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
        const router = data.router
        let accessedRouters
        const userId = data.user_info.id
        if (userId === 1) {
          accessedRouters = asyncRouter
        } else {
          accessedRouters = filterAsyncRouter(asyncRouter, router.split(','))
        }
        commit('SET_ROUTERS', accessedRouters)
        resolve()
      })
    }
  }
}

export default permission
