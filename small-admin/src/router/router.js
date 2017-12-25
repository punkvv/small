const _import = file => () => import('@/views/' + file + '.vue')

export const constantRouter = [
  {path: '/login', component: _import('login/Index'), hidden: true}
]

export const routers = [
  constantRouter
]
