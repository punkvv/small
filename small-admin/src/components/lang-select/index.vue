<style lang="scss">
  @import "index";
</style>

<template>
  <el-dropdown trigger="click" class='international lang-select' @command="handleSetLanguage">
    <div>
      <svg-icon class-name='international-icon' icon-class="language"/>
    </div>
    <el-dropdown-menu slot="dropdown">
      <el-dropdown-item command="zh" :disabled="language==='zh'">中文</el-dropdown-item>
      <el-dropdown-item command="en" :disabled="language==='en'">English</el-dropdown-item>
    </el-dropdown-menu>
  </el-dropdown>
</template>

<script>
  export default {
    name: 'langSelect',
    computed: {
      language() {
        return this.$store.getters.language
      }
    },
    methods: {
      handleSetLanguage(lang) {
        this.$i18n.locale = lang
        this.$store.dispatch('setLanguage', lang)
        this.$message({
          message: 'switch language success',
          type: 'success'
        })
      }
    }
  }
</script>
