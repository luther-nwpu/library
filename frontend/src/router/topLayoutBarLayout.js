
export default {
  path: '/',
  component: resolve => require(['@/components/layout/toplayout'], resolve),
  children: [
    {
      path: '/index',
      component: resolve => require(['@/pages/Index.vue'], resolve)
    }
  ]
}
