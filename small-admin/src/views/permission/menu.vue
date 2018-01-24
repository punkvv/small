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
      <el-button @click="handleCreate" class="operate-item" type="primary" icon="el-icon-edit">新增
      </el-button>
    </div>

    <div class="table-container">
      <el-card class="box-card">
        <tree-table :data="list" :columns="columns" :expandAll="true" v-loading="loading" border>
          <el-table-column label="操作" width="154">
            <template slot-scope="scope">
              <el-button type="primary" size="mini" @click="handleUpdate(scope.row)">编辑</el-button>
              <el-button type="danger" size="mini" @click="handleDelete(scope.row.id)">删除</el-button>
            </template>
          </el-table-column>
        </tree-table>
      </el-card>
    </div>

    <div class="editor-container">
      <el-dialog
        :title="editorTitle[editorStatus]"
        :visible.sync="editorVisible">
        <el-form :model="editor" :rules="editorRules" ref="editor" label-width="120px">
          <el-form-item label="上级菜单" prop="parent_id">
            <el-select v-model="editor.parent_id" clearable placeholder="不选则为顶级菜单">
              <el-option
                v-for="item in list"
                :key="item.id"
                :label="item.menu_name"
                :value="item.id">
              </el-option>
            </el-select>
          </el-form-item>
          <el-form-item label="菜单名称" prop="menu_name">
            <el-input placeholder="请输入内容" v-model.tirm="editor.menu_name" clearable></el-input>
          </el-form-item>
          <el-form-item label="路由名称" prop="name">
            <el-input placeholder="请输入内容" v-model.tirm="editor.name" clearable></el-input>
          </el-form-item>
          <el-form-item label="其他可访问路由" prop="router">
            <el-input type="textarea" placeholder="请输入内容(英文逗号隔开)" v-model.tirm="editor.router"></el-input>
          </el-form-item>
        </el-form>
        <span slot="footer" class="dialog-footer">
          <el-button @click="editorVisible = false">取消</el-button>
          <el-button type="primary" :loading="editorLoading" @click="createData" v-if="editorStatus==1">提交</el-button>
          <el-button type="primary" :loading="editorLoading" @click="updateData" v-else>提交</el-button>
       </span>
      </el-dialog>
    </div>
  </div>
</template>

<script>
  import {TreeTable} from '@/components'
  import {menuList, createMenu, updateMenu, deleteMenu} from '@/api/permission/menu'

  export default {
    name: 'menus',
    components: {TreeTable},
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
          id: null,
          parent_id: null,
          menu_name: '',
          name: '',
          router: ''
        },
        editorRules: {
          menu_name: [
            {required: true, message: '不能为空', trigger: 'blur'},
            {max: 20, message: '长度不能超过 20 个字符', trigger: 'blur'}
          ],
          name: [
            {required: true, message: '不能为空', trigger: 'blur'},
            {max: 20, message: '长度不能超过 20 个字符', trigger: 'blur'}
          ]
        },
        editorLoading: false,
        columns: [
          {
            text: '菜单名称',
            value: 'menu_name',
            width: 180
          },
          {
            text: '路由名称',
            value: 'name',
            width: 180
          },
          {
            text: '可访问路由',
            value: 'router'
          }
        ],
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
      resetEditor() {
        this.editor = {
          id: null,
          parent_id: null,
          menu_name: '',
          name: '',
          router: ''
        }
      },
      handleCreate() {
        this.resetEditor()
        this.editorVisible = true
        this.editorStatus = 1
        this.$nextTick(() => {
          this.$refs['editor'].clearValidate()
        })
      },
      handleUpdate(item) {
        this.editorVisible = true
        this.editorStatus = 2
        this.editor = Object.assign({}, item)
        this.$nextTick(() => {
          this.$refs['editor'].clearValidate()
        })
      },
      handleDelete(id) {
        this.$confirm('是否确定删除?', '提示', {
          confirmButtonText: '确定',
          cancelButtonText: '取消',
          type: 'warning'
        }).then(() => {
          deleteMenu(id).then(() => {
            this.$message({
              type: 'success',
              message: '删除成功!'
            })
            this.getList()
          })
        }).catch(() => {
        })
      },
      createData() {
        this.$refs['editor'].validate((valid) => {
          if (valid) {
            this.editorLoading = true
            createMenu(this.editor).then((data) => {
              this.editorLoading = false
              this.editorVisible = false
              this.$message({type: 'success', message: '保存成功!'})
              this.getList()
            }).catch(() => {
              this.editorLoading = false
            })
          }
        })
      },
      updateData() {
        this.$refs['editor'].validate((valid) => {
          if (valid) {
            this.editorLoading = true
            updateMenu(this.editor).then((data) => {
              this.editorLoading = false
              this.editorVisible = false
              this.$message({type: 'success', message: '保存成功!'})
              this.getList()
            }).catch(() => {
              this.editorLoading = false
            })
          }
        })
      }
    }
  }
</script>
