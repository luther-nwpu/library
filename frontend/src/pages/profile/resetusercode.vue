<template>
    <div>
        <div>
            <br>
            <h3> Reset User Code </h3>
            <br>
            <div class = "row">
                <span class = "col-md-3"><h4>Current User Code:</h4></span>
                <span class = "col-md-4">
                <input type = "text" class = "form-control" v-model = "currentusercode"/>
                </span>
            </div>
            <br>
            <div class = "row">
                <span class = "col-md-3"><h4> Please Input User Code: </h4></span>
                <span class = "col-md-4">
                <input type = "text" class = "form-control" v-model = "usercode"/>
                </span>
            </div>
            <br>
            <div class = "row">
                <span class = "col-md-3"><h4> Please Input Repeat User Code:</h4> </span>
                <span class = "col-md-4">
                <input type = "text" class = "form-control" v-model = "repeatusercode"/>
                </span>
            </div>
            <br>
            <button class = "btn btn-primary" @click="ModifyUserCode()"> Modify User Code </button>
        </div>
    </div>
</template>
<script>
import axios from 'axios'
export default {
    data () {
        return {
            currentusercode: '',
            usercode:  '',
            repeatusercode: ''
        }
    },
    methods: {
        async ModifyUserCode() {
            if(this.currentusercode&&this.usercode&&this.repeatusercode) {
                if(this.usercode ==this.repeatusercode) {
                    var res = await axios.post('/api/auth/resetMyUserCode', {
                        currentusercode: this.currentusercode,
                        usercode: this.usercode,
                        repeatusercode: this.repeatusercode
                    })
                    console.log(res)
                    if(res.data.reset){
                        alert('Reset True')
                    } else {
                        alert('Reset False')
                    }
                } else {
                    alert('The repeat UserCode not same UserCode')
                }
            } else {
                alert('No Input')
            }
        }
    }
}    
</script>