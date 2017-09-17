<template>
    <div>
    用户名: <input type = "text" v-model="email"/>
    密码: <input type = "text" v-model="password"/>
    <button @click = "admin()"> 登录 </button>
    </div>
</template>
<script>
import axios from 'axios'
export default {
    data(){
        return {
            email: '',
            password: ''
        }
    },
    methods: {
        admin: async function(){
            var res = await axios.post('/api/admin/login', {
                email: this.email,
                password: this.password
            });
            console.log(res);
        }
    }
}    
</script>
