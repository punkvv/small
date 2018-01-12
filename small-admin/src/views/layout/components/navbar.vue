<style lang="scss">
  @import "navbar";
</style>

<template>
  <el-menu class="navbar" mode="horizontal">
    <hamburger class="hamburger-container" :toggleClick="toggleSideBar" :isActive="sidebar.opened"></hamburger>

    <breadcrumb class="breadcrumb-container"></breadcrumb>

    <div class="right-menu">
      <error-log class="errLog-container right-menu-item"></error-log>

      <el-tooltip effect="dark" content="全屏" placement="bottom">
        <screen-full class="screenfull right-menu-item"></screen-full>
      </el-tooltip>

      <el-dropdown class="avatar-container right-menu-item" trigger="click">
        <div class="avatar-wrapper">
          <span class="main-user-name">{{username}}</span>
          <i class="el-icon-caret-bottom"></i>
        </div>
        <div class="avatar-wrapper">
          <img class="user-avatar" :src="userAvatar">
        </div>
        <el-dropdown-menu slot="dropdown">
          <a target='_blank' href="https://github.com/punkvv/small">
            <el-dropdown-item>
              项目地址
            </el-dropdown-item>
          </a>
          <el-dropdown-item divided>
            <span @click="logout" style="display:block;">退出登录</span>
          </el-dropdown-item>
        </el-dropdown-menu>
      </el-dropdown>
    </div>
  </el-menu>
</template>

<script>
  import defaultAvatar from '@/assets/default-avatar.gif'
  import {mapGetters} from 'vuex'
  import {Breadcrumb, Hamburger, ErrorLog, ScreenFull, ThemePicker} from '@/components'

  export default {
    components: {Breadcrumb, Hamburger, ErrorLog, ScreenFull, ThemePicker},
    data() {
      return {
        userAvatar: ''
      }
    },
    computed: {
      ...mapGetters([
        'sidebar',
        'username',
        'avatar'
      ])
    },
    created() {
      this.userAvatar = this.avatar === '' ? defaultAvatar : this.avatar
    },
    methods: {
      toggleSideBar() {
        this.$store.dispatch('toggleSideBar')
      },
      logout() {
        this.$store.dispatch('logOut').then(() => {
          location.reload()
        })
      }
    }
  }
</script>
