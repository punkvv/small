<style lang="scss">
  .upload-container {
    .editor-slide-upload {
      margin-bottom: 20px;
    }
  }
</style>

<template>
  <div class="upload-container">
    <el-button size="mini" icon='el-icon-upload' :style="{background:color,borderColor:color}" @click="dialogVisible=true" type="primary">
      上传图片
    </el-button>
    <el-dialog :visible.sync="dialogVisible">
      <el-upload class="editor-slide-upload" :action="action" :multiple="true" :file-list="fileList"
                 :show-file-list="true"
                 list-type="picture-card" :on-remove="handleRemove" :on-success="handleSuccess"
                 :before-upload="beforeUpload">
        <i class="el-icon-plus"></i>
      </el-upload>
      <span slot="footer" class="dialog-footer">
        <el-button @click="dialogVisible = false">取 消</el-button>
        <el-button type="primary" @click="handleSubmit">确 定</el-button>
      </span>
    </el-dialog>
  </div>
</template>

<script>
  import {image} from '@/api/upload'

  export default {
    name: 'tinymceUpload',
    props: {
      color: {
        type: String,
        default: '#20a0ff'
      }
    },
    data() {
      return {
        action: image,
        dialogVisible: false,
        listObj: {},
        fileList: []
      }
    },
    methods: {
      checkAllSuccess() {
        return Object.keys(this.listObj).every(item => this.listObj[item].hasSuccess)
      },
      handleSubmit() {
        const arr = Object.keys(this.listObj).map(v => this.listObj[v])
        if (!this.checkAllSuccess()) {
          this.$message('请等待所有图片上传成功 或 出现了网络问题，请刷新页面重新上传！')
          return
        }
        this.$emit('success', arr)
        this.listObj = {}
        this.fileList = []
        this.dialogVisible = false
      },
      handleSuccess(response, file, fileList) {
        const uid = file.uid
        const objKeyArr = Object.keys(this.listObj)
        for (let i = 0, len = objKeyArr.length; i < len; i++) {
          if (this.listObj[objKeyArr[i]].uid === uid) {
            this.listObj[objKeyArr[i]].url = response.url
            this.listObj[objKeyArr[i]].hasSuccess = true
            return
          }
        }
      },
      handleRemove(file, fileList) {
        const uid = file.uid
        const objKeyArr = Object.keys(this.listObj)
        for (let i = 0, len = objKeyArr.length; i < len; i++) {
          if (this.listObj[objKeyArr[i]].uid === uid) {
            delete this.listObj[objKeyArr[i]]
            return
          }
        }
      },
      beforeUpload(file) {
        const _self = this
        const _URL = window.URL || window.webkitURL
        const fileName = file.uid
        this.listObj[fileName] = {}
        return new Promise((resolve, reject) => {
          const img = new Image()
          img.src = _URL.createObjectURL(file)
          img.onload = () => {
            _self.listObj[fileName] = {hasSuccess: false, uid: file.uid}
          }
          resolve(true)
        })
      }
    }
  }
</script>
