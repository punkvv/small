<style lang="scss">
  .preview {
    margin-left: 10px;
    display: inline-block;
    .phone_preview {
      top: 50%;
      left: 50%;
      margin: auto;
      z-index: 9997;
      width: 360px;
      height: 680px;
      background: url(phone.png) 0 0 no-repeat;
    }

    .phone {
      padding: 84px 56px 0 17px;
    }

    .phone_hd {
      text-align: center;
      color: #fff;
      line-height: 38px;
      height: 38px;
      width: auto;
      overflow: hidden;
      text-overflow: ellipsis;
      white-space: nowrap;
      word-wrap: normal;
      padding: 0 20px;
    }

    .phone_bd {
      position: relative;
      overflow: auto;
      background-color: #fff;
      height: 470px;
    }
  }
</style>

<template>
  <div class="preview">
    <el-button icon='el-icon-mobile-phone' :style="{background:color,borderColor:color}" @click="dialogVisible=true"
               type="primary">
      手机预览
    </el-button>
    <el-dialog
      width="360px"
      :visible.sync="dialogVisible">
      <div class="phone_preview_wrp">
        <div class="phone_preview">
          <div class="phone">
            <div class="phone_hd">
              {{title}}
            </div>
            <div class="phone_bd">
              <slot></slot>
            </div>
          </div>
        </div>
        <div class="mask"></div>
      </div>
    </el-dialog>
  </div>
</template>

<script>
  export default {
    name: 'mobilePhone',
    props: {
      title: {
        type: String,
        default: ''
      },
      color: {
        type: String,
        default: '#20a0ff'
      }
    },
    data() {
      return {
        dialogVisible: false
      }
    }
  }
</script>
