export default {
    path: '/profile',
    component: resolve => require(['@/pages/profile/layout'], resolve),
    children: [
      {
        path: 'myinfo',
        component: resolve => require(['@/pages/profile/myinfo.vue'], resolve)
      },
      {
        path: 'resetpassword',
        component: resolve => require(['@/pages/profile/resetpassword.vue'], resolve)
      },
      {
        path: 'resetusercode',
        component: resolve => require(['@/pages/profile/resetusercode.vue'], resolve)
      },
      {
        path: 'resetuserImage',
        component: resolve => require(['@/pages/profile/resetuserImage.vue'], resolve)
      }
    ]
  }
  