<style lang="scss">
  .api-log-page {

  }
</style>

<template>
  <div class="api-log-page">
    <div class="search-container">
      <el-collapse value="search">
        <el-collapse-item name="search">
          <el-form ref="filters" :model="filters" label-width="100px">
            <el-row>
              <el-col :span="4">
                <el-form-item label="操作人" prop="username">
                  <el-input placeholder="请输入用户名" v-model.tirm="filters.username" clearable></el-input>
                </el-form-item>
              </el-col>
              <el-col :span="6">
                <el-form-item label="时间" prop="create_time">
                  <el-date-picker
                    v-model="filters.create_time"
                    type="daterange"
                    range-separator="至"
                    start-placeholder="开始日期"
                    end-placeholder="结束日期">
                  </el-date-picker>
                </el-form-item>
              </el-col>
            </el-row>
            <el-row>
              <el-col :span="24">
                <el-form-item>
                  <el-button size="small" type="primary" icon="el-icon-search" @click="getList">查询</el-button>
                  <el-button size="small" icon="el-icon-refresh" @click="resetFilters">重置</el-button>
                </el-form-item>
              </el-col>
            </el-row>
          </el-form>
        </el-collapse-item>
      </el-collapse>
    </div>

    <div class="table-container">
      <el-card class="box-card">
        <el-table
          v-loading="loading"
          :data="list"
          border
          style="width: 100%">
          <el-table-column
            label="时间"
            width="180">
            <template slot-scope="scope">
              <span>{{scope.row.create_time | date}}</span>
            </template>
          </el-table-column>
          <el-table-column
            prop="username"
            label="操作人"
            width="100">
          </el-table-column>
          <el-table-column
            prop="router"
            label="接口地址"
            width="150">
          </el-table-column>
          <el-table-column
            prop="router_name"
            label="接口名称"
            width="150">
          </el-table-column>
          <el-table-column
            prop="method"
            label="请求类型"
            width="100">
            <template slot-scope="scope">
              <el-tag type="primary" v-if="scope.row.method=='POST'">{{scope.row.method}}</el-tag>
              <el-tag type="success" v-else-if="scope.row.method=='PUT'">{{scope.row.method}}</el-tag>
              <el-tag type="danger" v-else-if="scope.row.method=='DELETE'">{{scope.row.method}}</el-tag>
              <el-tag type="warning" v-else-if="scope.row.method=='GET'">{{scope.row.method}}</el-tag>
              <el-tag type="info" v-else>{{scope.row.method}}</el-tag>
            </template>
          </el-table-column>
          <el-table-column
            prop="params"
            label="参数">
          </el-table-column>
        </el-table>

        <el-pagination
          @size-change="handleSizeChange"
          @current-change="handleCurrentChange"
          :current-page.sync="filters.page"
          :page-sizes="[20, 100, 500, 1000]"
          :page-size="filters.per_page"
          layout="total, sizes, prev, pager, next, jumper"
          :total="total">
        </el-pagination>
      </el-card>
    </div>
  </div>
</template>

<script>
  import {apiLogList} from '@/api/apiLog'

  export default {
    name: 'apiLog',
    data() {
      return {
        total: 0,
        filters: {
          username: null,
          create_time: null,
          page: 1,
          per_page: 20
        },
        loading: false,
        list: []
      }
    },
    created() {
      this.getList()
    },
    methods: {
      async getList() {
        this.loading = true
        const data = await apiLogList(this.filters)
        this.list = data.items
        this.total = data.total
        this.loading = false
      },
      resetFilters() {
        this.$refs['filters'].resetFields()
        this.getList()
      },
      handleSizeChange(val) {
        this.filters.per_page = val
        this.getList()
      },
      handleCurrentChange(val) {
        this.filters.page = val
        this.getList()
      }
    }
  }
</script>
