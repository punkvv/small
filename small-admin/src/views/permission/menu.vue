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
          :default-expand-all="true"
          border
          style="width: 100%">
          <el-table-column
            type="expand">
            <template slot-scope="props" v-if="props.row.child.length>0">
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
                    <el-button type="primary" size="mini" @click="handleUpdate(scope.row)">编辑</el-button>
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
        <el-form :model="editor" :rules="editorRules" ref="editor" label-width="120px">
          <el-form-item label="上级菜单" prop="parent_id">
            <el-select v-model="editor.parent_id" clearable placeholder="请选择">
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
          <el-button @click="editorVisible = false">取 消</el-button>
          <el-button type="primary" :loading="editorLoading" @click="createData" v-if="editorStatus==1">提 交</el-button>
          <el-button type="primary" :loading="editorLoading" @click="updateData" v-else>提 交</el-button>
       </span>
      </el-dialog>
    </div>
  </div>
</template>

<script>
  import {menuList, createMenu, countFiled} from '@/api/menu'
  import Util from '@/libs/util'

  export default {
    name: 'menus',
    components: {},
    data() {
      const checkMenuName = (rule, value, callback) => {
        if (!value) {
          return callback(new Error('不能为空'))
        }
        if (value.length > 10) {
          return callback(new Error('长度不能超过10个字符'))
        }

        countFiled('menu_name', value).then((data) => {
          if (data.count >= 1) {
            callback(new Error('不能重复'))
          }
          callback()
        })
      }
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
            {validator: checkMenuName, required: true, trigger: 'blur'}
          ],
          name: [
            {required: true, message: '不能为空', trigger: 'blur'},
            {max: 10, message: '长度不能超过10个字符', trigger: 'blur'}
          ]
        },
        editorLoading: false,
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
        this.editor = Util.copyAttr(this.editor, item)
      },
      createData() {
        this.$refs['editor'].validate((valid) => {
          if (valid) {
            this.editorLoading = true
            createMenu(this.editor).then((data) => {
              this.editorLoading = false
              this.editorVisible = false
              this.$notify({
                title: '成功',
                message: '创建成功',
                type: 'success'
              })
              this.joinList(data)
            })
          }
        })
      },
      updateData() {
      },
      joinList(data) {
        const parentId = data.parent_id
        if (parentId === null) { // 如果为顶级菜单
          data = Object.assign(data, {child: []})
          this.list.push(data)
        } else { // 如果为二级菜单
          for (let i = 0, len = this.list.length; i < len; i++) {
            if (this.list[i].id === parentId) {
              this.list[i].child.push(data)
              break
            }
          }
        }
      }
    }
  }
</script>
