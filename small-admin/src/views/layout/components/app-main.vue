<template>
  <section class="app-main" style="min-height: 100%">
    <transition name="fade" mode="out-in">
      <keep-alive :include="cachedViews">
        <router-view></router-view>
      </keep-alive>
    </transition>

    <back-to-top></back-to-top>
  </section>
</template>

<script>
  import {BackToTop} from '@/components'

  export default {
    name: 'appMain',
    components: {BackToTop},
    computed: {
      cachedViews() {
        return this.$store.getters.cachedViews
      }
    }
  }
</script>
