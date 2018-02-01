import Layout from '../views/layout/layout'

const _import = file => () => import('@/views/' + file + '.vue')

/**
 * 配置项详情
 * children: []            大于1时才会出现子菜单
 * hidden: true            是否在菜单栏中显示（默认为 false）
 * redirect: 'noredirect'  如果 redirect: 'noredirect' 则不会出现在面包屑
 * name: 'router-name'     必须设置值
 * meta: {
 *    title: 'title'       菜单和面包屑的名称
 *    icon: 'svg-name'     图标
 *    cache: false         页面是否缓存（默认为 false）
 * }
 */
export const constantRouter = [
  {path: '/login', name: 'login', component: _import('home/login'), hidden: true, meta: {title: '登录'}},
  {path: '/404', name: '404', component: _import('home/404'), hidden: true, meta: {title: '404-页面不存在'}},
  {
    path: '',
    component: Layout,
    redirect: 'home',
    hidden: true,
    children: [
      {path: 'home', name: 'home', component: _import('home/home'), meta: {title: '首页'}},
      {path: 'personal', name: 'personal', component: _import('home/personal'), meta: {title: '个人中心'}}
    ]
  }
]

export const asyncRouter = [
  {
    path: '/system',
    name: 'system',
    component: Layout,
    redirect: 'noredirect',
    meta: {title: '系统', icon: 'system'},
    children: [
      {path: 'menu', name: 'menu', component: _import('system/menu'), meta: {title: '菜单', icon: 'menu'}},
      {path: 'role', name: 'role', component: _import('system/role'), meta: {title: '角色', icon: 'role'}},
      {path: 'user', name: 'user', component: _import('system/admin-user'), meta: {title: '用户', icon: 'user'}},
      {
        path: 'error-log',
        name: 'errorLog',
        component: _import('system/error-log'),
        meta: {title: '错误日志', icon: 'error'}
      },
      {path: 'api-log', name: 'apiLog', component: _import('system/api-log'), meta: {title: 'API日志', icon: 'apilog'}}
    ]
  },
  {path: '*', redirect: '/404', hidden: true}
]
