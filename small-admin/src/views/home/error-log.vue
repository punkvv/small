<style lang="scss">
  .error-log-page {

  }
</style>

<template>
  <div class="error-log-page">
    <div class="operate-container">
      <el-button @click="changeStatusAll" class="operate-item" type="primary" icon="el-icon-circle-check">
        全部处理完成
      </el-button>
      <el-button @click="deleteAll" class="operate-item" type="danger" icon="el-icon-delete">全部删除
      </el-button>
    </div>

    <div class="search-container">
      <el-collapse value="search">
        <el-collapse-item name="search">
          <el-form ref="filters" :model="filters" label-width="100px">
            <el-row>
              <el-col :span="4">
                <el-form-item label="类型" prop="type">
                  <el-select v-model="filters.type" clearable placeholder="请选择">
                    <el-option
                      v-for="item in options"
                      :key="item.value"
                      :label="item.label"
                      :value="item.value">
                    </el-option>
                  </el-select>
                </el-form-item>
              </el-col>
              <el-col :span="4">
                <el-form-item label="状态" prop="status">
                  <el-select v-model="filters.status" clearable placeholder="请选择">
                    <el-option
                      v-for="item in optionsStatus"
                      :key="item.value"
                      :label="item.label"
                      :value="item.value">
                    </el-option>
                  </el-select>
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
            label="状态"
            width="100">
            <template slot-scope="scope">
              <el-tag :type="scope.row.status === 1 ? 'primary' : 'danger'">{{scope.row.status | status}}
              </el-tag>
            </template>
          </el-table-column>
          <el-table-column
            label="类型"
            width="100">
            <template slot-scope="scope">
              <el-tag :type="scope.row.type === 1 ? 'primary' : 'success'">{{scope.row.type | type}}
              </el-tag>
            </template>
          </el-table-column>
          <el-table-column
            prop="router"
            label="路由"
            width="300">
          </el-table-column>
          <el-table-column
            prop="message"
            label="信息">
          </el-table-column>
          <el-table-column label="操作" width="80">
            <template slot-scope="scope">
              <el-button @click="changeStatus(scope.row, 2)" type="success" size="mini" v-if="scope.row.status===1">
                打开
              </el-button>
              <el-button @click="changeStatus(scope.row, 1)" type="primary" size="mini" v-else>处理</el-button>
            </template>
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
  import {errorLogList, changeStatus, changeStatusAll, deleteAll} from '@/api/errorLog'

  export default {
    name: 'errorLogPage',
    data() {
      return {
        options: [{
          value: 1,
          label: '服务端'
        }, {
          value: 2,
          label: '前端'
        }],
        optionsStatus: [{
          value: 1,
          label: '已处理'
        }, {
          value: 2,
          label: '未处理'
        }],
        total: 0,
        filters: {
          type: null,
          status: null,
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
    filters: {
      type(type) {
        return type === 1 ? '服务端' : '前端'
      },
      status(status) {
        return status === 1 ? '已处理' : '未处理'
      }
    },
    methods: {
      async getList() {
        this.loading = true
        const data = await errorLogList(this.filters)
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
      },
      changeStatus(item, type) {
        changeStatus(item.id, type)
        item.status = Math.abs(item.status - 1)
      },
      async changeStatusAll() {
        await changeStatusAll()
        this.getList()
      },
      async deleteAll() {
        this.$confirm('是否确定删除?', '提示', {
          confirmButtonText: '确定',
          cancelButtonText: '取消',
          type: 'warning'
        }).then(() => {
          deleteAll().then(() => {
            this.$message({
              type: 'success',
              message: '删除成功!'
            })
            this.getList()
          })
        }).catch(() => {
        })
      }
    }
  }
</script>
