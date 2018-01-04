<style lang="scss">
  @import './login.scss';
</style>

<template>
  <div class="login">
    <el-card class="login-box">
      <div slot="header" class="clearfix">
        <span>登录系统</span>
      </div>
      <el-form :model="form" :rules="rules" ref="form">
        <el-form-item prop="username">
          <el-input v-model="form.username" placeholder="请输入用户名" auto-complete="off">
            <svg-icon slot="prefix" icon-class="user"></svg-icon>
          </el-input>
        </el-form-item>
        <el-form-item prop="password">
          <el-input v-model="form.password" type="password" placeholder="请输入密码" auto-complete="off">
            <svg-icon slot="prefix" icon-class="wodemima"></svg-icon>
          </el-input>
        </el-form-item>
        <el-form-item>
          <el-button @click="handleSubmit" type="primary" size="medium" class="v-w-100">登录</el-button>
        </el-form-item>
      </el-form>
    </el-card>
  </div>
</template>

<script>
  export default {
    components: {},
    data() {
      return {
        form: {
          username: '',
          password: ''
        },
        rules: {
          username: [{required: true, message: '不能为空', trigger: 'blur'}],
          password: [{required: true, message: '不能为空', trigger: 'blur'}]
        }
      }
    },
    methods: {
      handleSubmit() {
        this.$refs.form.validate((valid) => {
          if (valid) {
          }
        })
      }
    }
  }
</script>

