<style lang="scss">
  @import 'layout';
</style>

<template>
  <div class="app-wrapper" :class="{hideSidebar:!sidebar.opened}">
    <sidebar class="sidebar-container"></sidebar>
    <div class="main-container">
    </div>
  </div>
</template>

<script>
  import {Sidebar} from './components'

  export default {
    name: 'layout',
    components: {Sidebar},
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
