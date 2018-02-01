<style lang="scss">
</style>

<template>
  <div>
    <el-button type="primary" size="mini" @click="show=true">上传图片</el-button>
    <cropper
      v-model="show"
      :key="key"
      @crop-upload-success="cropSuccess">
    </cropper>
  </div>
</template>

<script>
  import Cropper from './upload'

  export default {
    name: 'imageCropper',
    components: {Cropper},
    data() {
      return {
        show: false,
        key: 0
      }
    },
    mounted() {
    },
    methods: {
      cropSuccess(res) {
        this.show = false
        this.key = this.key + 1
        this.$emit('upload-success', res)
      }
    }
  }
</script>
