<template>
    <div>
       Current User Code <input class = "form-control" v-model = "currentusercode"/>
       Please Input User Code <input class = "form-control" v-model = "usercode"/>
       Please Input Repeat User Code <input class = "form-control" v-model = "repeatusercode"/>
        <button @click="ModifyUserCode()"> Modify User Code </button>
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
            var res = await axios.post('/api/auth/resetMyUserCode', {
                currentusercode: this.currentusercode,
                usercode: this.usercode,
                repeateusercode: this.repeatusercode
            })
            console.log(res)
        }
    }
}    
</script>