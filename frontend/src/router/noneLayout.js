import LoginRouter from './LoginRouter'
export default {
  path: '/no',
  component: resolve => require(['@/components/layout/nolayout'], resolve),
  children: [
    LoginRouter,
  ]
}
