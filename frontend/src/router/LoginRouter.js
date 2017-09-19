export default {
  path: '/login',
  component: resolve => require(['@/components/layout/nolayout'], resolve),
  children: [
    {
      path: 'authlogin',
      component: resolve => require(['@/pages/Login/Login.vue'], resolve)
    },
    {
      path: 'authregister',
      component: resolve => require(['@/pages/Login/Register.vue'], resolve)
    }
  ]
}
