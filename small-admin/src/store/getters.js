const getters = {
  sidebar: state => state.app.sidebar,
  token: state => state.user.token,
  router: state => state.user.router,
  routers: state => state.permission.routers,
  addRouters: state => state.permission.addRouters
}
export default getters
