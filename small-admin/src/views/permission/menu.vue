<style lang="scss">
  .menus {

  }
</style>

<template>
  <div class="menus">
    <div class="operate-container">
      <el-button @click="handleCreate" class="operate-item" type="primary" icon="el-icon-edit">新增</el-button>
    </div>

    <MenuTable ref="table"></MenuTable>

  </div>
</template>

<script>
  import {MenuTable} from './components'

  export default {
    name: 'menus',
    components: {MenuTable},
    data() {
      return {
        dataList: []
      }
    },
    methods: {
      handleFilter() {
        this.$refs.table.getList()
      },
      handleCreate() {
      }
    }
  }
</script>
