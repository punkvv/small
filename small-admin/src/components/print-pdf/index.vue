<style lang="scss">
</style>

<template>
  <el-button :style="{background:color,borderColor:color}" :loading="loading" @click="printPdf" type="primary"
             icon="el-icon-printer">打印PDF
  </el-button>
</template>

<script>
  export default {
    name: 'printPDF',
    props: {
      selectorId: {
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
      printPdf() {
        this.loading = true
        import('@/vendor/printPDF').then(pdf => {
          pdf.printPdf(this.selectorId)
          this.loading = false
        })
      }
    }
  }
</script>
