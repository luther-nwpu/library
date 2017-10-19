<template>
    <div>
        usernumber: <input v-model = "usernumber"/>
        username: <input class= "form-control" v-model = "username"/>
        userinfo: <input class= "form-control" v-model = "userinfo"/>
        useruniveristy: <input class= "form-control" v-model = "useruniversity"/>
        usercollege: <input class= "form-control" v-model = "usercollege"/>
        <button @click="commitdata()">tioajiao</button>
        {{usernumber}}
    </div>
</template>
<script>
import axios from 'axios'
export default {
    async created() {
        var res = await axios.get('/api/auth/myuserinfo')
        var self = this
        console.log(res)
        if(!res.data.get) {
            alert("Not Get This User ");
        } else {
            self.username = res.data.user.username
            self.usernumber = res.data.user.usernumber
            this.userinfo = res.data.user.userinfo
            this.useruniversity = res.data.user.useruniversity
            this.usercollege = res.data.user.usercollege
        }
    },
    data () {
        return {
            username: '',
            usernumber: '',
            userinfo: '',
            useruniversity: '',
            usercollege: ''
        }
    },
    methods: {
        async commitdata(){
            var res = await axios.post('/api/auth/updateuserinfo',{
                usernumber: this.usernumber,
                username: this.username,
                usercollege: this.usercollege,
                userinfo: this.userinfo,
                useruniversity: this.useruniversity
            });
            console.log(res)
        }
    }
}

</script>
