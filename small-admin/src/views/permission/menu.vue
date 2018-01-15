<style lang="scss">
  .menus {

  }
</style>

<template>
  <div class="menus">
    <div class="operate-container">
      <el-button @click="handleCreate" class="operate-item" type="primary" icon="el-icon-edit">新增</el-button>
    </div>

    <el-collapse class="search-container" value="1">
      <el-collapse-item name="1">
        <el-form ref="filters" :model="filters" label-width="120px">
          <el-row>
            <el-col :span="6">
              <el-form-item label="菜单名称" prop="name">
                <el-input v-model="filters.name" placeholder="菜单名称"></el-input>
              </el-form-item>
            </el-col>
          </el-row>

          <el-row>
            <el-col :span="24">
              <el-form-item>
                <el-button @click="handleFilter" type="primary" icon="el-icon-search">查询</el-button>
              </el-form-item>
            </el-col>
          </el-row>
        </el-form>
      </el-collapse-item>
    </el-collapse>

    <MenuTable :filters="filters" ref="table"></MenuTable>

  </div>
</template>

<script>
  import {MenuTable} from './components'

  export default {
    name: 'menus',
    components: {MenuTable},
    data() {
      return {
        filters: {
          name: ''
        },
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
