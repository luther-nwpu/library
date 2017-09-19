<template>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="../../index2.html"><b>Admin</b>LTE</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>
    <form>
      <div class="form-group has-feedback">
        <input type="email" class="form-control" placeholder="Email" v-model = "email">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Password" v-model = "password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox"> Remember Me
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="button" class="btn btn-primary btn-block btn-flat" @click = "login()">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
    <!-- /.social-auth-links -->
    <a href="#">I forgot my password</a><br>
    <a href="#/login/authregister" class="btn btn-danger btn-block btn-flat">Register a new membership</a>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

    <!--<div>
        登录
        用户名: <input type = "text" v-model = "email" />
        密码: <input type = "text" v-model = "password"/>
        <button @click = "login()">登录</button>
    </div>
    !-->
    </body>
</template>
<script>
import axios from 'axios'
export default {
    name: 'Login',
    data () {
        return {
            email: '',
            password: ''
        }
    },
    methods: {
        login: async function(){
          if(this.email&&this.password)
            {
              var res = await axios.post('api/auth/login', {
                  email: this.email,
                  password: this.password
              });
              console.log(res)
              if (res.data.logined == false){
                this.$Message.error("password error")
              } else {
                this.$router.push({//你需要接受路由的参数再跳转
                              path: '/index'
                            });
              }
            } else {
              this.$Message.error('Please Write All Information');
            }
        }
    }
}
</script>