<style lang="scss">
  @import 'layout';
</style>

<template>
  <div class="app-wrapper" :class="{hideSidebar:!sidebar.opened}">
    <sidebar class="sidebar-container"></sidebar>
    <div class="main-container">
      <navbar></navbar>
      <tags-view></tags-view>
      <app-main></app-main>
    </div>

  </div>
</template>

<script>
  import {Sidebar, Navbar, TagsView, AppMain} from './components'

  export default {
    name: 'layout',
    components: {Sidebar, Navbar, TagsView, AppMain},
    computed: {
      sidebar() {
        return this.$store.getters.sidebar
      }
    },
    mounted() {
    },
    methods: {}
  }
</script>
