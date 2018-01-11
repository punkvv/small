<style lang="scss">
  @import './login.scss';
</style>

<template>
  <div class="login" @keydown.enter="handleSubmit">
    <el-card class="login-box">
      <div slot="header" class="clearfix">
        <span>欢迎登录</span>
      </div>
      <el-form :model="form" :rules="rules" ref="form">
        <el-form-item prop="username">
          <el-input v-model.tirm="form.username" placeholder="请输入用户名" auto-complete="off" clearable>
            <svg-icon slot="prefix" icon-class="user"></svg-icon>
          </el-input>
        </el-form-item>
        <el-form-item prop="password">
          <el-input v-model.tirm="form.password" type="password" placeholder="请输入密码" auto-complete="off" clearable>
            <svg-icon slot="prefix" icon-class="password"></svg-icon>
          </el-input>
        </el-form-item>
        <el-form-item>
          <el-button @click="handleSubmit" :loading="loading" type="primary" size="medium" class="login-btn">登录
          </el-button>
        </el-form-item>
      </el-form>
    </el-card>
  </div>
</template>

<script>
  export default {
    name: 'login',
    data() {
      return {
        form: {
          username: '',
          password: ''
        },
        rules: {
          username: [{required: true, message: '请输入用户名', trigger: 'blur'}],
          password: [{required: true, message: '请输入密码', trigger: 'blur'}]
        },
        loading: false
      }
    },
    methods: {
      handleSubmit() {
        this.$refs.form.validate((valid) => {
          if (valid) {
            this.loading = true
            this.$store.dispatch('loginByPassword', this.form).then((data) => {
              this.loading = false
              this.$router.push({path: '/'})
            }).catch((data) => {
              this.loading = false
            })
          }
        })
      }
    }
  }
</script>

