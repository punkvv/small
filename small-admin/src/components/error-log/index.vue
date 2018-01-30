<style lang="scss">
  @import "index";
</style>

<template>
  <!--<div class="error-log" v-if="errorCount>0">-->
  <!--<el-tooltip effect="dark" :content="content" placement="bottom">-->
  <!--<el-badge :is-dot="true" style="line-height: 30px;" @click.native="toErrorPage">-->
  <!--<el-button size="small" type="danger" class="bug-btn">-->
  <!--<svg t="1492682037685" class="bug-svg" viewBox="0 0 1024 1024" version="1.1"-->
  <!--xmlns="http://www.w3.org/2000/svg"-->
  <!--p-id="1863"-->
  <!--xmlns:xlink="http://www.w3.org/1999/xlink" width="128" height="128">-->
  <!--<path-->
  <!--d="M969.142857 548.571429q0 14.848-10.861714 25.709714t-25.709714 10.861714l-128 0q0 97.718857-38.290286 165.705143l118.857143 119.442286q10.861714 10.861714 10.861714 25.709714t-10.861714 25.709714q-10.276571 10.861714-25.709714 10.861714t-25.709714-10.861714l-113.152-112.566857q-2.852571 2.852571-8.557714 7.424t-23.990857 16.274286-37.156571 20.845714-46.848 16.566857-55.442286 7.424l0-512-73.142857 0 0 512q-29.147429 0-58.002286-7.716571t-49.700571-18.870857-37.705143-22.272-24.868571-18.578286l-8.557714-8.009143-104.557714 118.272q-11.446857 11.995429-27.428571 11.995429-13.714286 0-24.576-9.142857-10.861714-10.276571-11.702857-25.417143t8.850286-26.587429l115.419429-129.718857q-33.133714-65.133714-33.133714-156.562286l-128 0q-14.848 0-25.709714-10.861714t-10.861714-25.709714 10.861714-25.709714 25.709714-10.861714l128 0 0-168.009143-98.852571-98.852571q-10.861714-10.861714-10.861714-25.709714t10.861714-25.709714 25.709714-10.861714 25.709714 10.861714l98.852571 98.852571 482.304 0 98.852571-98.852571q10.861714-10.861714 25.709714-10.861714t25.709714 10.861714 10.861714 25.709714-10.861714 25.709714l-98.852571 98.852571 0 168.009143 128 0q14.848 0 25.709714 10.861714t10.861714 25.709714zM694.857143 219.428571l-365.714286 0q0-75.995429 53.430857-129.426286t129.426286-53.430857 129.426286 53.430857 53.430857 129.426286z"-->
  <!--p-id="1864"></path>-->
  <!--</svg>-->
  <!--</el-button>-->
  <!--</el-badge>-->
  <!--</el-tooltip>-->
  <!--</div>-->
</template>

<script>
  import {errorLogDynamicCount} from '@/api/system/errorLog'

  export default {
    name: 'errorLog',
    data() {
      return {
        errorCount: 0,
        content: ''
      }
    },
    created() {
      if (this.userId === 1) {
        this.getData()
      }
    },
    methods: {
      async getData() {
        const data = await errorLogDynamicCount()
        this.errorCount = data.count
        if (this.errorCount > 0) {
          const notify = this.$notify({
            title: '错误消息',
            message: `有${this.errorCount}条未处理错误(点击查看)`,
            type: 'error',
            duration: 0,
            onClick: () => {
              this.toErrorPage()
              notify.close()
            }
          })
        }
      },
      toErrorPage() {
        this.$router.push({name: 'errorLog'})
      }
    },
    computed: {
      userId() {
        return this.$store.getters.userId
      }
    }
  }
</script>
