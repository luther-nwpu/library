export default {
    path: '/authmanager',
    component: resolve => require(['@/components/layout/fulllayout'], resolve),
    children: [
      {
        path: 'borrowbook',
        component: resolve => require(['@/pages/authmanager/borrowbook.vue'], resolve)
      },
      {
        path: 'Mybook',
        component: resolve => require(['@/pages/authmanager/MyBook.vue'], resolve)
      },
      {
        path: 'MyBorrowBook',
        component: resolve => require(['@/pages/authmanager/MyBorrowBook.vue'], resolve)
      }
    ]
  }
  