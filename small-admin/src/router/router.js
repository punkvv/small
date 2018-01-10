import layout from '../views/home/layout'

const _import = file => () => import('@/views/' + file + '.vue')

export const constantRouter = [
  {path: '/login', component: _import('login/login'), hidden: true},
  {
    path: '',
    component: layout,
    redirect: 'home',
    children: [{
      path: 'home',
      component: _import('home/home'),
      name: 'home',
      meta: {title: 'home'}
    }]
  }
]

export const routers = [
  constantRouter
]
