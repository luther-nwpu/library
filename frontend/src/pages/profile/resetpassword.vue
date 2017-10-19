<template>
    <div>
        Current Password: <input class="form-controller" v-model = "currentpassword"/>
        Password: <input class="form-controller" v-model = "password"/>
        Repeat Password: <input class="form-controller" v-model = "repeatpassword"/>
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
                    
                } else {
                    var res = await axios.post('/api/auth/resetMyPassword', {
                        currentpassword: this.currentpassword,
                        password: this.password,
                        repeatpassword: this.repeatpassword
                    });
                    console.log(res)
                }
            }
        }
    }
}
</script>