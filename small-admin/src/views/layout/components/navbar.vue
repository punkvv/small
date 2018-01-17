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

      <el-tooltip effect="dark" content="退出登录" placement="bottom">
        <div class="logout" @click="logout">
          <svg-icon icon-class="logout"></svg-icon>
        </div>
      </el-tooltip>

      <el-dropdown class="avatar-container right-menu-item">
        <div class="avatar-wrapper">
          <img class="user-avatar" :src="userAvatar">
        </div>
        <el-dropdown-menu slot="dropdown">
          <el-dropdown-item>
            <span>欢迎：{{username}}</span>
          </el-dropdown-item>
        </el-dropdown-menu>
      </el-dropdown>
    </div>
  </el-menu>
</template>

<script>
  import defaultAvatar from '@/assets/default-avatar.gif'
  import {mapGetters} from 'vuex'
  import {Breadcrumb, Hamburger, ErrorLog, ScreenFull} from '@/components'

  export default {
    components: {Breadcrumb, Hamburger, ErrorLog, ScreenFull},
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
