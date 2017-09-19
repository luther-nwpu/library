export default {
    path: '/common',
    component: resolve => require(['@/pages/common/layout.vue'], resolve),
    children: [
      {
        path: 'allbook',
        component: resolve => require(['@/pages/common/AllBook.vue'], resolve)
      }
    ]
  }
  