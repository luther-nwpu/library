import Vue from 'vue'
import Router from 'vue-router'
import 'font-awesome/css/font-awesome.min.css'
import 'admin-lte/bootstrap/css/bootstrap.min.css'
import 'admin-lte/dist/css/AdminLTE.min.css'
import 'bootstrap/dist/css/bootstrap.css'
// AdminLTE
import 'admin-lte/dist/css/skins/_all-skins.min.css'
import 'font-awesome/css/font-awesome.min.css'
import fullLayout from './fullLayout'
import noneLayout from './noneLayout'
import topLayoutBarLayout from './topLayoutBarLayout'
import profileLayout from './profileLayout'

Vue.use(Router)

export default new Router({
  routes: [
    {
      path: '/test',
      component: resolve => require(['@/pages/test.vue'], resolve)
    },
    topLayoutBarLayout,
    fullLayout,
    noneLayout,
    profileLayout,
    {
      path: '/*',
      component: resolve => require(['@/pages/404.vue'], resolve)
    }
  ]
})
