<template>

<body class="hold-transition register-page">
    <div class="register-box">
        <div class="register-logo">
            <a href="../../index2.html"><b>Admin</b>LTE</a>
        </div>

        <div class="register-box-body">
            <p class="login-box-msg">Register a new membership</p>

            <form>
            <div class="form-group has-feedback">
                <input type="text" class="form-control" placeholder="Full name" v-model = "name">
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="email" class="form-control" placeholder="Email" v-model = "email">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" class="form-control" placeholder="Password" v-model = "password">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" class="form-control" placeholder="Retype password">
                <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
            </div>
            <div class="row">
                <div class="col-xs-8">
                <div class="checkbox icheck">
                    <label>
                    <input type="checkbox"> I agree to the <a href="#">terms</a>
                    </label>
                </div>
                </div>
                <!-- /.col -->
                <div class="col-xs-4">
                <button type="button" class="btn btn-primary btn-block btn-flat" @click = "register()">Register</button>
                </div>
                <!-- /.col -->
            </div>
            </form>
            <a href="#/login/authlogin" class="text-center">I already have a membership</a>
        </div>
    <!-- /.form-box -->
    </div>

</body>



  <!--  <div>
        姓名<input type="text" v-model="name"/>
        邮箱<input type="text" v-model="email"/>
        密码<input type="text" v-model="password"/>
        <button @click = "register()">注册</button>
    </div>
    -->
</template>
<script>
import axios from 'axios'
export default {
    data(){
        return {
            name: '',
            email: '',
            password: ''
        }
    },
    methods: {
        async register(){
            if(this.name&&this.email&&this.password){
                var res = await axios.post('/api/auth/register', {
                    name: this.name,
                    email: this.email,
                    password: this.password
                })
                console.log(res)
                    if(res.data.registed == false){
                        this.$router.push({//你需要接受路由的参数再跳转
                                    path: '/login/authlogin'
                        });
                    } else {
                        this.$Message.error('Register Failed')
                    }
            } else {
                this.$Message.error('NotNull')
            }
        }
    }
}
</script>
<style>
</style>