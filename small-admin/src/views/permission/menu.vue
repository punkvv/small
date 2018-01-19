<style lang="scss">
  .menus {
    .table-container {
      .el-table__expanded-cell {
        padding: 0px 0px 0px 47px
      }
    }
  }
</style>

<template>
  <div class="menus">
    <div class="operate-container">
      <el-button @click="handleCreate" class="operate-item" type="primary" icon="el-icon-edit">新增</el-button>
    </div>

    <div class="table-container">
      <el-card class="box-card">
        <el-table
          v-loading="loading"
          :data="list"
          border
          :default-expand-all="true"
          style="width: 100%">
          <el-table-column
            type="expand">
            <template slot-scope="props">
              <el-table
                :data="props.row.child"
                :show-header="false"
                border
                style="width: 100%">
                <el-table-column
                  prop="menu_name"
                  width="180">
                </el-table-column>
                <el-table-column
                  prop="name"
                  label="路由名称"
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
            </template>
          </el-table-column>
          <el-table-column
            prop="menu_name"
            label="菜单名称"
            width="180">
          </el-table-column>
          <el-table-column
            prop="name"
            label="路由名称"
            width="180">
          </el-table-column>
          <el-table-column
            prop="router"
            label="可访问路由">
          </el-table-column>
          <el-table-column align="center" label="操作" width="154">
            <template slot-scope="scope">
              <el-button type="primary" size="mini" @click="handleUpdate(scope.row)">编辑</el-button>
              <el-button type="danger" size="mini">删除</el-button>
            </template>
          </el-table-column>
        </el-table>

      </el-card>
    </div>

    <div class="editor-container">
      <el-dialog
        :title="editorTitle[editorStatus]"
        :visible.sync="editorVisible">
        <el-form label-position="left" :model="editor" label-width="100px">
          <el-form-item label="上级菜单" prop="menu_name">
            <el-input placeholder="请输入内容" v-model="editor.menu_name" clearable></el-input>
          </el-form-item>
          <el-form-item label="路由名称" prop="menu_name">
            <el-input placeholder="请输入内容" v-model="editor.menu_name" clearable></el-input>
          </el-form-item>
          <el-form-item label="可访问路由" prop="menu_name">
            <el-input type="textarea" placeholder="请输入内容(英文逗号隔开)" v-model="editor.menu_name"></el-input>
          </el-form-item>
        </el-form>
        <span slot="footer" class="dialog-footer">
          <el-button @click="editorVisible = false">取 消</el-button>
          <el-button type="primary" @click="createData" v-if="editorStatus==1">提 交</el-button>
          <el-button type="primary" @click="updateData" v-else>提 交</el-button>
       </span>
      </el-dialog>
    </div>
  </div>
</template>

<script>
  import {menuList} from '@/api/menu'

  export default {
    name: 'menus',
    components: {},
    data() {
      return {
        loading: false,
        editorTitle: {
          1: '新增',
          2: '编辑'
        },
        editorStatus: 1,
        editorVisible: false,
        editor: {
          id: 0,
          menu_name: ''
        },
        list: []
      }
    },
    created() {
      this.getList()
    },
    methods: {
      async getList() {
        this.loading = true
        const data = await menuList()
        this.list = data
        this.loading = false
      },
      handleCreate() {
        this.editorVisible = true
        this.editorStatus = 1
      },
      handleUpdate(item) {
        this.editorVisible = true
        this.editorStatus = 2
      },
      createData() {
      },
      updateData() {
      }
    }
  }
</script>
