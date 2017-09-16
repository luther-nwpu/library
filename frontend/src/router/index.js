import Vue from 'vue'
import iview from 'iview'
import Router from 'vue-router'
import Hello from '@/components/Hello'
import Test from '@/components/test'
import 'iview/dist/styles/iview.css'

Vue.use(Router)
Vue.use(iview)

export default new Router({
  routes: [
    {
      path: '/',
      name: 'Hello',
      component: Hello
    },
    {
      path: '/test',
      name: 'test',
      component: Test
    }
  ]
})
