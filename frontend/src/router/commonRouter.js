export default {
    path: '/common',
    component: resolve => require(['@/pages/common/layout.vue'], resolve),
    children: [
      {
        path: 'allbook',
        component: resolve => require(['@/pages/common/AllBook.vue'], resolve)
      },
      {
        path: 'book/:isbn',
        name: 'bookinfo',
        component: resolve => require(['@/pages/common/bookinfo.vue'], resolve)
      }
    ]
  }
  