import Vue from 'vue'
import Router from 'vue-router'
import {getToken} from '../libs/token'
import NProgress from 'nprogress'
import {constantRouter} from './router'

Vue.use(Router)

export const router = new Router({
  mode: 'history',
  scrollBehavior: () => ({y: 0}),
  routes: constantRouter
})

const whiteList = ['/login'] // 不重定向白名单

// 全局守卫 进行权限验证和登录验证等操作
router.beforeEach((to, from, next) => {
  NProgress.start() // 加载页面进度条
  if (getToken()) {
  } else {
    if (whiteList.indexOf(to.path) !== -1) { // 在免登录白名单，直接进入
      next()
    } else {
      next('/login')
    }
  }
})

// 全局后置钩子
router.afterEach(() => {
  NProgress.done()
})
