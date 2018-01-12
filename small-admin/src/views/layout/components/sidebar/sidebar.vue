<template>
  <scroll-bar>
    <el-menu mode="vertical" :default-active="$route.path" :collapse="isCollapse" background-color="#304156"
             text-color="#bfcbd9" active-text-color="#409EFF">
      <sidebar-item :routes="routers"></sidebar-item>
    </el-menu>
  </scroll-bar>
</template>

<script>
  import {mapGetters} from 'vuex'
  import SidebarItem from './sidebar-item'
  import {ScrollBar} from '@/components'

  export default {
    name: 'sidebar',
    components: {SidebarItem, ScrollBar},
    computed: {
      ...mapGetters([
        'routers',
        'sidebar'
      ]),
      isCollapse() {
        return !this.sidebar.opened
      }
    }
  }
</script>
