<style lang="scss">
  @import "index";
</style>

<template>
  <transition :name="transitionName">
    <div class="page-component-up" @click="backToTop" v-show="visible"><i class="el-icon-caret-top"></i></div>
  </transition>
</template>

<script>
  export default {
    name: 'backToTop',
    props: {
      visibilityHeight: {
        type: Number,
        default: 400
      },
      backPosition: {
        type: Number,
        default: 0
      },
      customStyle: {
        type: Object,
        default: function() {
          return {
            right: '50px',
            bottom: '50px',
            width: '40px',
            height: '40px',
            'border-radius': '4px',
            'line-height': '45px',
            background: '#e7eaf1'
          }
        }
      },
      transitionName: {
        type: String,
        default: 'fade'
      }
    },
    data() {
      return {
        visible: false,
        interval: null
      }
    },
    mounted() {
      window.addEventListener('scroll', this.handleScroll)
    },
    beforeDestroy() {
      window.removeEventListener('scroll', this.handleScroll)
      if (this.interval) {
        clearInterval(this.interval)
      }
    },
    methods: {
      handleScroll() {
        this.visible = window.pageYOffset > this.visibilityHeight
      },
      backToTop() {
        window.scrollTo(0, 0)
        // const start = window.pageYOffset
        // let i = 0
        // this.interval = setInterval(() => {
        //   const next = Math.floor(this.easeInOutQuad(10 * i, start, -start, 500))
        //   if (next <= this.backPosition) {
        //     window.scrollTo(0, this.backPosition)
        //     clearInterval(this.interval)
        //   } else {
        //     window.scrollTo(0, next)
        //   }
        //   i++
        // }, 16.7)
      },
      easeInOutQuad(t, b, c, d) {
        if ((t /= d / 2) < 1) return c / 2 * t * t + b
        return -c / 2 * (--t * (t - 2) - 1) + b
      }
    }
  }
</script>
