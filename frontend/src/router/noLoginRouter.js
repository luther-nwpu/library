export default {
    path: '/library',
    component: resolve => require(['@/components/layout/nolayout'], resolve),
    children: [
      {
        path: 'index',
        component: resolve => require(['@/pages/NoLogin/index.vue'], resolve)
      },
      {
        path: 'mybook',
        component: resolve => require(['@/pages/NoLogin/MyAllBook.vue'], resolve)  
      },
      {
        path: 'borrowbook',
        component: resolve => require(['@/pages/NoLogin/BorrowBook.vue'], resolve)
      },
      {
        path: 'returnbook',
        component: resolve => require(['@/pages/NoLogin/ReturnBook.vue'], resolve)
      },
      {
        path: 'renewbook',
        component: resolve => require(['@/pages/NoLogin/RenewBook.vue'], resolve)
      }
    ]
  }
  