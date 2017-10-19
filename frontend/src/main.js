// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import App from './App'
import router from './router'
import 'font-awesome/css/font-awesome.min.css'
import 'admin-lte/bootstrap/css/bootstrap.min.css'
import 'admin-lte/dist/css/AdminLTE.min.css'
import 'bootstrap/dist/css/bootstrap.css'
// AdminLTE
import 'admin-lte/dist/css/skins/_all-skins.min.css'
import $ from 'jquery'
// 路由列表
import iView from 'iview';
import 'iview/dist/styles/iview.css';

Vue.config.productionTip = false
Vue.use(iView);

Vue.directive('focusNextOnEnter', {
  bind: function(el, {
    value
  }, vnode) {
    el.addEventListener('keyup', (ev) => {
      if (ev.keyCode === 13) {
        let nextInput = vnode.context.$refs[value]
        if (nextInput && typeof nextInput.focus === 'function') {
          nextInput.focus()
          nextInput.select()
        }
      }
    })
  }
})

/* eslint-disable no-new */
new Vue({
  el: '#app',
  router,
  template: '<App/>',
  components: { App }
})
