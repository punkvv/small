<template>

</template>

<script>
  import {menuList} from '@/api/menu'

  export default {
    name: 'menuTable',
    props: {
      filters: {
        type: Object,
        default: () => {
          return {}
        }
      }
    },
    data() {
      return {
        loading: false,
        dataList: []
      }
    },
    created() {
      this.getList()
    },
    methods: {
      async getList() {
        this.loading = true
        const data = await menuList(this.filters)
        this.loading = false
        console.log(data)
      }
    }
  }
</script>
