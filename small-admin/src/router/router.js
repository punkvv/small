import Layout from '../views/layout/layout'

const _import = file => () => import('@/views/' + file + '.vue')

/**
 * 配置项详情
 * children: []            大于1时才会出现子菜单
 * hidden: true            是否在菜单栏中显示（默认为false）
 * redirect: 'noredirect'  如果 redirect: 'noredirect' 则不会出现在面包屑
 * name: 'router-name'     必须设置值
 * meta: {
 *    title: 'title'       菜单和面包屑的名称
 *    icon: 'svg-name'     图标
 *    noCache: true        页面是否缓存（默认为false）
 * }
 */
export const constantRouter = [
  {path: '/login', name: 'login', component: _import('home/login'), hidden: true, meta: {title: '登录'}},
  {path: '/404', name: '404', component: _import('home/404'), hidden: true, meta: {title: '404-页面不存在'}},
  {
    path: '/error-log',
    redirect: 'errorLog',
    hidden: true,
    component: Layout,
    children: [
      {path: '/error-log', name: 'errorLog', component: _import('home/error-log'), meta: {title: '错误日志'}}
    ]
  },
  {
    path: '',
    component: Layout,
    redirect: 'home',
    hidden: false,
    children: [
      {path: 'home', name: 'home', component: _import('home/home'), meta: {title: '首页', icon: 'home'}}
    ]
  }
]

export const asyncRouter = [
  {
    path: '/permission',
    name: 'permission',
    component: Layout,
    redirect: 'noredirect',
    meta: {title: '权限', icon: 'permission'},
    children: [
      {path: 'menu', name: 'menu', component: _import('permission/menu'), meta: {title: '菜单', icon: 'menu'}},
      {path: 'role', name: 'role', component: _import('permission/role'), meta: {title: '角色', icon: 'role'}},
      {path: 'user', name: 'user', component: _import('permission/user'), meta: {title: '用户', icon: 'user'}}
    ]
  },
  {path: '*', redirect: '/404', hidden: true}
]
