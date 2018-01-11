import Layout from '../views/layout/layout'

const _import = file => () => import('@/views/' + file + '.vue')

export const constantRouter = [
  {path: '/login', component: _import('login/login'), hidden: true},
  {
    path: '',
    component: Layout,
    redirect: 'home',
    children: [
      {path: 'home', component: _import('home/home'), name: 'home', meta: {title: '首页'}}
    ]
  }
]

export const asyncRouter = [
  {
    path: '/permission',
    component: Layout,
    children: [
      {path: 'menu', component: _import('menu/menu'), name: 'menu'},
      {path: 'menu', component: _import('menu/menu'), name: 'menu'}
    ]
  }
]
