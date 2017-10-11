import LoginRouter from './LoginRouter'
export default {
  path: '/',
  component: resolve => require(['@/components/layout/nolayout'], resolve),
  children: [
    LoginRouter,
  ]
}
