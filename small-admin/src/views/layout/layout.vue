<style lang="scss">
  @import 'layout';
</style>

<template>
  <div class="app-wrapper" :class="{hideSidebar:!sidebar.opened}">
    <sidebar class="sidebar-container"></sidebar>
    <div class="main-container">
      <navbar></navbar>
    </div>
  </div>
</template>

<script>
  import {Sidebar, Navbar} from './components'

  export default {
    name: 'layout',
    components: {Sidebar, Navbar},
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
