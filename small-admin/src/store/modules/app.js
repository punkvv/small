import {getSidebarStatus, setSidebarStatus} from '@/libs/cookie'

const app = {
  state: {
    sidebar: {
      opened: !+getSidebarStatus()
    }
  },
  mutations: {
    TOGGLE_SIDEBAR: state => {
      if (state.sidebar.opened) {
        setSidebarStatus(1)
      } else {
        setSidebarStatus(0)
      }
      state.sidebar.opened = !state.sidebar.opened
    }
  },
  actions: {
    toggleSideBar({commit}) {
      commit('TOGGLE_SIDEBAR')
    }
  }
}

export default app
