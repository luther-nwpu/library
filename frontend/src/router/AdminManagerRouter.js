export default {
    path: '/admin',
    component: resolve => require(['@/components/layout/fulllayout'], resolve),
    children: [
      {
        path: 'bookstore',
        component: resolve => require(['@/pages/adminmanager/BookStore.vue'], resolve)
      },
      {
        path: 'category',
        component: resolve => require(['@/pages/adminmanager/Category.vue'], resolve)
      }
    ]
  }
  