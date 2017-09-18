<template>
    <div>
        姓名<input type="text" v-model="name"/>
        邮箱<input type="text" v-model="email"/>
        密码<input type="text" v-model="password"/>
        <button @click = "register()">注册</button>
    </div>
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
           var res = await axios.post('/api/auth/register', {
               name: this.name,
               email: this.email,
               password: this.password
           })
           console.log(res)
        }
    }
}
</script>
<style>
</style>