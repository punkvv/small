<style lang="scss">
</style>

<template>
  <div class="user">
    <div class="operate-container">
      <el-button @click="handleCreate" class="operate-item" type="primary" icon="el-icon-edit">新增</el-button>
    </div>

    <div class="search-container">
      <el-collapse value="search">
        <el-collapse-item name="search">
          <el-form ref="filters" :model="filters" label-width="150px">
            <el-row>
              <el-col :span="6">
                <el-form-item label="用户名/姓名/手机号" prop="name">
                  <el-input placeholder="请输入内容" v-model.tirm="filters.name" clearable></el-input>
                </el-form-item>
              </el-col>
              <el-col :span="6">
                <el-form-item label="状态" prop="status">
                  <el-select v-model="filters.status" clearable placeholder="请选择">
                    <el-option
                      v-for="item in options"
                      :key="item.value"
                      :label="item.label"
                      :value="item.value">
                    </el-option>
                  </el-select>
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
          :data="list"
          v-loading="loading"
          border
          style="width: 100%">
          <el-table-column
            prop="username"
            label="用户名">
          </el-table-column>
          <el-table-column
            prop="real_name"
            label="姓名">
          </el-table-column>
          <el-table-column
            prop="phone"
            label="手机号">
          </el-table-column>
          <el-table-column
            label="状态"
            width="100">
            <template slot-scope="scope">
              <el-tag :type="scope.row.status === 1 ? 'primary' : 'danger'">{{scope.row.status | status}}
              </el-tag>
            </template>
          </el-table-column>
          <el-table-column label="操作" width="360">
            <template slot-scope="scope">
              <el-button type="primary" size="mini" @click="handleUpdate(scope.row)">编辑</el-button>
              <el-button type="success" size="mini" @click="handleRole(scope.row.id)">角色</el-button>
              <el-button type="warning" size="mini" @click="handlePass(scope.row.id)">密码</el-button>
              <el-button type="danger" size="mini" @click="handleStatus(scope.row, 2)" v-if="scope.row.status==1">禁用
              </el-button>
              <el-button type="success" size="mini" @click="handleStatus(scope.row, 1)" v-else>启用</el-button>
              <el-button type="danger" size="mini" @click="handleDelete(scope.row.id)">删除</el-button>
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

    <div class="editor-container">
      <el-dialog
        :title="editorStatus == 1 ? '新增' : '编辑'"
        :visible.sync="editorVisible">
        <el-form :model="editor" :rules="editorRules" ref="editor" label-width="120px">
          <el-form-item label="用户名" prop="username">
            <el-input placeholder="请输入内容" v-model.tirm="editor.username" clearable></el-input>
          </el-form-item>

          <template v-if="editorStatus == 1">
            <el-form-item label="密码" prop="pass">
              <el-input type="password" v-model.tirm="editor.pass" placeholder="请输入内容" auto-complete="off"
                        clearable></el-input>
            </el-form-item>
            <el-form-item label="确认密码" prop="check_pass">
              <el-input type="password" v-model.tirm="editor.check_pass" placeholder="请输入内容" auto-complete="off"
                        clearable></el-input>
            </el-form-item>
          </template>

          <el-form-item label="姓名" prop="real_name">
            <el-input placeholder="请输入内容" v-model.tirm="editor.real_name" clearable></el-input>
          </el-form-item>
          <el-form-item label="手机号码" prop="phone">
            <el-input placeholder="请输入内容" v-model.tirm="editor.phone" clearable></el-input>
          </el-form-item>
          <el-form-item label="电子邮箱" prop="email">
            <el-input placeholder="请输入内容" v-model.tirm="editor.email" clearable></el-input>
          </el-form-item>

          <el-form-item label="头像">
            <thumb v-show="editor.avatar" :image="editor.avatar"></thumb>
            <el-button type="primary" size="mini" @click="show=true">点击上传</el-button>
            <image-cropper
              v-model="show"
              :key="key"
              @crop-upload-success="cropSuccess">
            </image-cropper>
          </el-form-item>
        </el-form>
        <span slot="footer" class="dialog-footer">
          <el-button @click="editorVisible = false">取消</el-button>
          <el-button type="primary" :loading="editorLoading" @click="createData" v-if="editorStatus==1">提交</el-button>
          <el-button type="primary" :loading="editorLoading" @click="updateData" v-else>提交</el-button>
       </span>
      </el-dialog>

      <el-dialog
        title="修改密码"
        :visible.sync="passVisible">
        <el-form :model="editor" :rules="editorRules" ref="pass" label-width="120px">
          <el-form-item label="密码" prop="pass">
            <el-input type="password" v-model.tirm="editor.pass" placeholder="请输入内容" auto-complete="off"
                      clearable></el-input>
          </el-form-item>
          <el-form-item label="确认密码" prop="check_pass">
            <el-input type="password" v-model.tirm="editor.check_pass" placeholder="请输入内容" auto-complete="off"
                      clearable></el-input>
          </el-form-item>
        </el-form>
        <span slot="footer" class="dialog-footer">
          <el-button @click="passVisible = false">取消</el-button>
          <el-button type="primary" :loading="passLoading" @click="changePass">提交</el-button>
       </span>
      </el-dialog>
    </div>
  </div>
</template>

<script>
  import {
    adminUserList,
    deleteAdminUser,
    createAdminUser,
    updateAdminUser,
    changePassword,
    changeStatus
  } from '@/api/system/adminUser'
  import {roleList} from '@/api/system/role'
  import {ImageCropper, Thumb} from '@/components'

  export default {
    name: 'user',
    components: {ImageCropper, Thumb},
    data() {
      const validatePass = (rule, value, callback) => {
        if (value === '') {
          callback(new Error('请输入密码'))
        } else {
          if (this.editor.check_pass !== '' && this.passVisible !== true) {
            this.$refs.editor.validateField('check_pass')
          } else {
            this.$refs.pass.validateField('check_pass')
          }
          callback()
        }
      }
      const validatePass2 = (rule, value, callback) => {
        if (value === '') {
          callback(new Error('请再次输入密码'))
        } else if (value !== this.editor.pass) {
          callback(new Error('两次输入密码不一致!'))
        } else {
          callback()
        }
      }
      return {
        show: false,
        key: 0,
        options: [{
          value: 1,
          label: '正常'
        }, {
          value: 2,
          label: '禁用'
        }],
        loading: false,
        total: 0,
        filters: {
          name: null,
          status: null,
          page: 1,
          per_page: 20
        },
        editorStatus: 1,
        editorVisible: false,
        editor: {
          id: null,
          real_name: '',
          username: '',
          pass: '',
          check_pass: '',
          phone: '',
          email: '',
          avatar: ''
        },
        editorRules: {
          username: [
            {required: true, message: '不能为空', trigger: 'blur'},
            {max: 10, message: '长度不能超过 10 个字符', trigger: 'blur'}
          ],
          pass: [
            {required: true, validator: validatePass, trigger: 'blur'}
          ],
          check_pass: [
            {required: true, validator: validatePass2, trigger: 'blur'}
          ],
          real_name: [
            {max: 20, message: '长度不能超过 20 个字符', trigger: 'blur'}
          ],
          phone: [
            {max: 20, message: '长度不能超过 20 个字符', trigger: 'blur'}
          ],
          email: [
            {max: 20, message: '长度不能超过 20 个字符', trigger: 'blur'}
          ]
        },
        editorLoading: false,
        passVisible: false,
        passLoading: false,
        roleList: [],
        list: []
      }
    },
    created() {
      this.getRoleList()
      this.getList()
    },
    filters: {
      status(status) {
        return status === 1 ? '正常' : '禁用'
      }
    },
    methods: {
      async getList() {
        this.loading = true
        const data = await adminUserList(this.filters)
        this.list = data.items
        this.total = data.total
        this.loading = false
      },
      async getRoleList() {
        const data = await roleList()
        this.roleList = data.items
      },
      handleSizeChange(val) {
        this.filters.per_page = val
        this.getList()
      },
      handleCurrentChange(val) {
        this.filters.page = val
        this.getList()
      },
      resetFilters() {
        this.$refs['filters'].resetFields()
        this.getList()
      },
      resetEditor() {
        this.editor = {
          id: null,
          real_name: '',
          username: '',
          pass: '',
          check_pass: '',
          phone: '',
          email: '',
          avatar: ''
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
      handleRole(id) {
      },
      handleDelete(id) {
        this.$confirm('是否确定删除?', '提示', {
          confirmButtonText: '确定',
          cancelButtonText: '取消',
          type: 'warning'
        }).then(() => {
          deleteAdminUser(id).then(() => {
            this.$message({
              type: 'success',
              message: '删除成功!'
            })
            this.getList()
          })
        }).catch(() => {
        })
      },
      handlePass(id) {
        this.resetEditor()
        this.editor.id = id
        this.passVisible = true
        this.$nextTick(() => {
          this.$refs['pass'].clearValidate()
        })
      },
      changePass() {
        this.$refs['pass'].validate((valid) => {
          if (valid) {
            this.passLoading = true
            const params = {
              pass: this.editor.pass,
              check_pass: this.editor.check_pass
            }
            changePassword(this.editor.id, params).then((data) => {
              this.passLoading = false
              this.passVisible = false
              this.$message({type: 'success', message: '修改成功!'})
            })
          }
        })
      },
      handleStatus(item, type) {
        changeStatus(item.id, type)
        item.status = Math.abs(item.status - 1)
      },
      cropSuccess(res) {
        this.show = false
        this.key = this.key + 1
        this.editor.avatar = res.url
      },
      createData() {
        this.$refs['editor'].validate((valid) => {
          if (valid) {
            this.editorLoading = true
            createAdminUser(this.editor).then((data) => {
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
            updateAdminUser(this.editor).then((data) => {
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
