const getters = {
  sidebar: state => state.app.sidebar,
  visitedViews: state => state.tagsView.visitedViews,
  cachedViews: state => state.tagsView.cachedViews,
  token: state => state.user.token,
  avatar: state => state.user.avatar,
  userId: state => state.user.id,
  username: state => state.user.name,
  router: state => state.user.router,
  routers: state => state.permission.routers,
  addRouters: state => state.permission.addRouters
}
export default getters
