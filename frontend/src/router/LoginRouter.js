import AdminRouter from './AdminRouter.js'
import AdminManagerRouter from './AdminManagerRouter.js'

export default {
  path: '/',
  component: resolve => require(['@/components/layout/fulllayout'], resolve),
  children: [
      AdminRouter,
      AdminManagerRouter
  ]
}
