<template>
    <div>
        <h3> My Information</h3>
        </br>
        <div class = "row">
        <span class = "col-md-3"><h4>usernumber:</h4></span>
        <span class = "col-md-4">
            <input type = "text" class = "form-control" v-model = "usernumber"/>
        </span>
    </div>
    <br>
    <div class = "row">
        <span class = "col-md-3"><h4>username:</h4></span>
        <span class = "col-md-4">
        <input type = "text" class = "form-control" v-model = "username"/>
        </span>
    </div>
    <br>
    <div class = "row">
        <span class = "col-md-3"><h4>userinfo: </h4></span>
        <span class = "col-md-4">
        <input type = "text" class = "form-control" v-model = "userinfo"/>
        </span>
    </div>
    <br>
    <div class = "row">
        <span class = "col-md-3"><h4>useruniversity:</h4> </span>
        <span class = "col-md-4">
        <input type = "text" class = "form-control" v-model = "useruniversity"/>
        </span>
    </div>
    <br>
    <div class = "row">
        <span class = "col-md-3"><h4> usercollege: </h4></span>
        <span class = "col-md-4">
        <input type = "text" class = "form-control" v-model = "usercollege"/>
        </span>
    </div>
    <br>
    <button class="btn btn-primary" @click="commitdata()">Commit Data</button>
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
            if(res.data.update){
                alert("Update True")
                this.$Message.info("Update True");
            } else {
                alert("Update False")
                this.$Message.info("Update False");
            }
        }
    }
}

</script>
