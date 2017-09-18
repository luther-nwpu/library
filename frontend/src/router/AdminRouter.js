export default {
    path: '/admin',
    component: resolve => require(['@/components/layout/fulllayout'], resolve),
    children: [
      {
        path: 'manager',
        component: resolve => require(['@/pages/admin/LibraryManager.vue'], resolve)
      }
    ]
  }
  