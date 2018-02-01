<style lang="scss">
  @import "index";
</style>

<template>
  <el-upload
    class="avatar-uploader"
    :action="action"
    :show-file-list="false"
    :on-success="handleSuccess"
    :on-error="handleError"
    :before-upload="beforeUpload"
    accept="image/*">
    <img :src="value" class="avatar" v-if="value">
    <i class="el-icon-plus avatar-uploader-icon" v-else></i>
  </el-upload>
</template>

<script>
  import {image} from '@/api/upload'

  export default {
    name: 'imgUpload',
    components: {},
    props: {
      value: String
    },
    data() {
      return {
        action: image
      }
    },
    methods: {
      handleSuccess(res, file) {
        this.$emit('input', res.url)
      },
      handleError(res, file, fileList) {
        this.$message({
          type: 'error',
          message: JSON.parse(res.message).message
        })
      },
      beforeUpload(file) {
        return true
      }
    }
  }
</script>
