<style lang="scss">
</style>

<template>
  <div class="role">

  </div>
</template>

<script>
  import {roleList} from '@/api/permission/role'

  export default {
    name: 'role',
    components: {},
    data() {
      return {
        loading: false,
        editorTitle: {
          1: '新增',
          2: '编辑'
        },
        list: []
      }
    },
    created() {
      this.getList()
    },
    methods: {
      async getList() {
        this.loading = true
        const data = await roleList()
        console.log(data)
        this.list = data
        this.loading = false
      }
    }
  }
</script>
