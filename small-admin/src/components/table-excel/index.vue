<style lang="scss">
</style>

<template>
  <el-button :style="{background:color,borderColor:color}" :loading="loading" @click="exportExcel" type="primary" icon="el-icon-download">
    导出Excel
  </el-button>
</template>

<script>
  export default {
    name: 'tableExcel',
    props: {
      tableId: {
        type: String
      },
      color: {
        type: String,
        default: '#20a0ff'
      }
    },
    components: {},
    data() {
      return {
        loading: false
      }
    },
    created() {
    },
    methods: {
      exportExcel() {
        this.loading = true
        import('@/libs/export2Excel').then(excel => {
          excel.export_table_to_excel(this.tableId)
          this.loading = false
        })
      }
    }
  }
</script>
