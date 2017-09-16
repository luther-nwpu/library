<template>
    <div>
        登录
        用户名: <input type = "text" v-model = "email" />
        密码: <input type = "text" v-model = "password"/>
        <button @click = "login()">登录</button>
    </div>
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
            var res = await axios.post('api/auth/login', {
                email: this.email,
                password: this.password
            });
            console.log(res)
        }
    }
}
</script>