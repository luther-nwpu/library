export default {
    path: '/authmanager',
    component: resolve => require(['@/pages/authmanager/layout.vue'], resolve),
    children: [
      {
        path: 'borrowbook',
        component: resolve => require(['@/pages/authmanager/borrowbook.vue'], resolve)
      },
      {
        path: 'myborrowbook',
        component: resolve => require(['@/pages/authmanager/MyBorrowBook.vue'], resolve)
      },
      {
        path: 'MyHistory',
        component: resolve => require(['@/pages/authmanager/MyHistory.vue'], resolve)
      }
    ]
  }
  