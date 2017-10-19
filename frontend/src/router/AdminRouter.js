export default {
    path: '/admin',
    component: resolve => require(['@/pages/admin/layout'], resolve),
    children: [
      {
        path: 'manager',
        component: resolve => require(['@/pages/admin/LibraryManager.vue'], resolve)
      },
      {
        path: 'alluser',
        component: resolve => require(['@/pages/admin/AllUser.vue'], resolve)
      }
    ]
  }
  