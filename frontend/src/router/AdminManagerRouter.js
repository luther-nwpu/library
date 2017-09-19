export default {
    path: '/admin',
    component: resolve => require(['@/pages/adminmanager/layout.vue'], resolve),
    children: [
      {
        path: 'bookstore',
        component: resolve => require(['@/pages/adminmanager/BookStore.vue'], resolve)
      },
      {
        path: 'category',
        component: resolve => require(['@/pages/adminmanager/Category.vue'], resolve)
      },
      {
        path: 'createBook',
        component: resolve => require(['@/pages/adminmanager/CreateBook.vue'], resolve)
      }
    ]
  }
  