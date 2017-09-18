import Vue from 'vue'
import Router from 'vue-router'
import Hello from '@/components/Hello'
import test from '@/components/test'
import Register from '@/components/Register'
import Login from '@/components/Login'
import Category from '@/components/Category'
import BookStore from '@/components/BookStore'
import AdminLogin from '@/components/AdminLogin'
import LibraryManager from '@/components/LibraryManager'
import 'font-awesome/css/font-awesome.min.css'
import 'admin-lte/bootstrap/css/bootstrap.min.css'
import 'admin-lte/dist/css/AdminLTE.min.css'
import 'bootstrap/dist/css/bootstrap.css'
// AdminLTE
import 'admin-lte/dist/css/skins/_all-skins.min.css'
import 'font-awesome/css/font-awesome.min.css'


Vue.use(Router)

export default new Router({
  routes: [
    {
      path: '/',
      name: 'Hello',
      component: Hello
    },
    {
      path: '/test',
      name: 'test',
      component: test
    },
    {
      path: '/Register',
      name: 'Register',
      component: Register
    },
    {
      path: '/Login',
      name: 'Login',
      component: Login
    },
    {
      path: '/Category',
      name: 'Category',
      component: Category
    },
    {
      path:'/BookStore',
      name: 'BookStore',
      component: BookStore
    },
    {
      path: '/AdminLogin',
      name: 'AdminLogin',
      component: AdminLogin
    },
    {
      path: '/LibraryManager',
      name: 'LibraryManager',
      component: LibraryManager
    }
  ]
})
