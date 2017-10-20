import LoginRouter from './LoginRouter'
import noLoginRouter from './noLoginRouter'
export default {
  path: '/',
  component: resolve => require(['@/components/layout/nolayout'], resolve),
  children: [
    LoginRouter,
    noLoginRouter
  ]
}
