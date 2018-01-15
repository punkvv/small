<template>
  <el-card class="table-container box-card">
    <el-table
      v-loading="loading"
      :data="dataList"
      border
      style="width: 100%">
      <el-table-column
        prop="name"
        label="菜单名称"
        width="180">
      </el-table-column>
      <el-table-column
        prop="path"
        label="路由地址"
        width="180">
      </el-table-column>
      <el-table-column
        prop="router"
        label="可访问路由">
      </el-table-column>
      <el-table-column align="center" label="操作" width="154">
        <template slot-scope="scope">
          <el-button type="primary" size="mini">编辑</el-button>
          <el-button type="danger" size="mini">删除</el-button>
        </template>
      </el-table-column>
    </el-table>

  </el-card>
</template>

<script>
  import {menuList} from '@/api/menu'

  export default {
    name: 'menuTable',
    props: {
      filters: {
        type: Object,
        default: () => {
          return {
            name: ''
          }
        }
      }
    },
    data() {
      return {
        loading: false,
        dataList: []
      }
    },
    created() {
      this.getList()
    },
    methods: {
      async getList() {
        this.loading = true
        const data = await menuList(this.filters)
        this.loading = false
        console.log(data)
      }
    }
  }
</script>
