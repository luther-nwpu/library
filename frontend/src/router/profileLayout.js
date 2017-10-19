import profileRouter from './profileRouter'
export default {
  path: '/',
  component: resolve => require(['@/components/layout/profilelayout'], resolve),
  children: [
    profileRouter,
  ]
}
