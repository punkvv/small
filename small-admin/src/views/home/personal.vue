<style lang="scss">
</style>

<template>
  <div class="personal">
    <el-card class="box-card">
      <div slot="header" class="clearfix">
        <span>个人信息</span>
      </div>
      <el-col :span="11">
        <el-form :model="editor" :rules="editorRules" ref="editor" label-width="120px">
          <el-form-item label="用户名" prop="username">
            <el-input placeholder="请输入内容" v-model.tirm="editor.username" clearable></el-input>
          </el-form-item>
          <el-form-item label="密码">
            <el-button size="mini" type="primary" @click="handlePass">修改</el-button>
          </el-form-item>
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
            <image-cropper @upload-success="cropSuccess"></image-cropper>
          </el-form-item>

          <el-form-item>
            <el-button type="primary" :loading="editorLoading" @click="onSubmit">保存</el-button>
          </el-form-item>
        </el-form>
      </el-col>
    </el-card>

    <el-dialog
      title="修改密码"
      :visible.sync="passVisible">
      <el-form :model="pass" :rules="passRules" ref="pass" label-width="120px">
        <el-form-item label="原密码" prop="old_pass">
          <el-input type="password" v-model.tirm="pass.old_pass" placeholder="请输入内容" auto-complete="off"
                    clearable></el-input>
        </el-form-item>
        <el-form-item label="密码" prop="pass">
          <el-input type="password" v-model.tirm="pass.pass" placeholder="请输入内容" auto-complete="off"
                    clearable></el-input>
        </el-form-item>
        <el-form-item label="确认密码" prop="check_pass">
          <el-input type="password" v-model.tirm="pass.check_pass" placeholder="请输入内容" auto-complete="off"
                    clearable></el-input>
        </el-form-item>
      </el-form>
      <span slot="footer" class="dialog-footer">
          <el-button @click="passVisible = false">取消</el-button>
          <el-button type="primary" :loading="passLoading" @click="changePass">提交</el-button>
      </span>
    </el-dialog>
  </div>
</template>

<script>
  import {getUserInfo, updateUser, updatePass} from '@/api/user'
  import {ImageCropper, Thumb} from '@/components'

  export default {
    name: 'personal',
    components: {ImageCropper, Thumb},
    data() {
      const validatePass = (rule, value, callback) => {
        if (value === '') {
          callback(new Error('请输入密码'))
        } else {
          if (this.pass.check_pass !== '') {
            this.$refs.pass.validateField('check_pass')
          }
          callback()
        }
      }
      const validatePass2 = (rule, value, callback) => {
        if (value === '') {
          callback(new Error('请再次输入密码'))
        } else if (value !== this.pass.pass) {
          callback(new Error('两次输入密码不一致!'))
        } else {
          callback()
        }
      }
      return {
        editor: {
          id: null,
          real_name: '',
          username: '',
          phone: '',
          email: '',
          avatar: ''
        },
        pass: {
          old_pass: '',
          pass: '',
          check_pass: ''
        },
        passVisible: false,
        passLoading: false,
        passRules: {
          old_pass: [
            {required: true, message: '不能为空', trigger: 'blur'}
          ],
          pass: [
            {required: true, validator: validatePass, trigger: 'blur'}
          ],
          check_pass: [
            {required: true, validator: validatePass2, trigger: 'blur'}
          ]
        },
        editorLoading: false,
        editorRules: {
          username: [
            {required: true, message: '不能为空', trigger: 'blur'},
            {max: 10, message: '长度不能超过 10 个字符', trigger: 'blur'}
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
        }
      }
    },
    created() {
      this.getData()
    },
    methods: {
      async getData() {
        const data = await getUserInfo(this.$store.getters.userId)
        this.editor = data.user_info
      },
      cropSuccess(res) {
        this.editor.avatar = res.url
      },
      onSubmit() {
        this.$refs['editor'].validate((valid) => {
          if (valid) {
            this.editorLoading = true
            updateUser(this.editor).then((data) => {
              this.editorLoading = false
              this.$message({type: 'success', message: '保存成功!'})
            }).catch(() => {
              this.editorLoading = false
            })
          }
        })
      },
      handlePass() {
        this.pass = {
          old_pass: '',
          pass: '',
          check_pass: ''
        }
        this.passVisible = true
        this.$nextTick(() => {
          this.$refs['pass'].clearValidate()
        })
      },
      changePass() {
        this.$refs['pass'].validate((valid) => {
          if (valid) {
            this.passLoading = true
            updatePass(this.editor.id, this.pass).then((data) => {
              this.passLoading = false
              this.passVisible = false
              this.$message({type: 'success', message: '保存成功!'})
            }).catch(() => {
              this.passLoading = false
            })
          }
        })
      }
    }
  }
</script>
