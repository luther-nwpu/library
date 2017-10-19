<template>
    <div>
        <br>
        <h3> Reset Password </h3>
        <br>
        <div class = "row">
            <span class = "col-md-3"><h4>Current Password:</h4></span>
            <span class = "col-md-4">
            <input type = "text" class = "form-control" v-model = "currentpassword"/>
            </span>
        </div>
        <br>
        <div class = "row">
            <span class = "col-md-3"><h4>Password: </h4></span>
            <span class = "col-md-4">
            <input type = "text" class = "form-control" v-model = "password"/>
            </span>
        </div>
        <br>
        <div class = "row">
            <span class = "col-md-3"><h4>Repeat Password:</h4> </span>
            <span class = "col-md-4">
            <input type = "text" class = "form-control" v-model = "repeatpassword"/>
            </span>
        </div>
        <button @click = "ResetPassword">Reset Password</button>
    </div>
</template>
<script>
import axios from 'axios';
export default {
    data () {
        return {
            currentpassword: '',
            password: '',
            repeatpassword: ''
        }
    },
    methods: {
        async ResetPassword() {
            if(this.currentpassword&&this.password&&this.repeatpassword) {
                if(this.password != this.repeatpassword) {
                    alert('The Password Not Same as The RepeatPassword')
                } else {
                    var res = await axios.post('/api/auth/resetMyPassword', {
                        currentpassword: this.currentpassword,
                        password: this.password,
                        repeatpassword: this.repeatpassword
                    });
                    if(res.data.reset) {
                        alert('Reset True')
                    } else {
                        alert('Reset False')
                    }
                    console.log(res)
                }
            } else {
                alert('No Input')
            }
        }
    }
}
</script>