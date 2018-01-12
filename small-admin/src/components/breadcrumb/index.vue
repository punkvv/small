<style lang="scss">
  @import "index";
</style>

<template>
  <el-breadcrumb class="app-breadcrumb" separator="/">
    <transition-group name="breadcrumb">
      <el-breadcrumb-item v-for="(item,index)  in levelList" :key="index" v-if='item.meta.title'>
        <span v-if='item.redirect==="noredirect"||index==levelList.length-1'
              class="no-redirect">{{item.meta.title}}</span>
        <router-link v-else :to="item.redirect||item.path">{{item.meta.title}}</router-link>
      </el-breadcrumb-item>
    </transition-group>
  </el-breadcrumb>
</template>

<script>
  export default {
    name: 'breadcrumb',
    data() {
      return {
        levelList: null
      }
    },
    created() {
      this.getBreadcrumb()
    },
    watch: {
      $route() {
        this.getBreadcrumb()
      }
    },
    methods: {
      getBreadcrumb() {
        let matched = this.$route.matched.filter(item => item.name)
        const first = matched[0]
        if (first && first.name !== 'home') {
          matched = [{path: '/home', meta: {title: '首页'}}].concat(matched)
        }
        this.levelList = matched
      }
    }
  }
</script>
