<template>
    <div>
        <table>
        <tr v-for = "(user, index) in users" :key = "index">
            <td> {{user}}</td>
            <td> <button @click = "deleteUser(index, user.id)"> 删除用户 </button> <button @click = "resetUserPassword(user.id)"> 重置用户密码</button> </td>
        </tr>
        </table>
    </div>
</template>
<script>
import axios from 'axios'
    export default {
        async created() {
            var res = await axios.get('/api/auth/getAllUser')
            console.log(res)
            this.users = res.data
        },
        data () {
            return {
                users: []
            }
        },
        methods: {
            async deleteUser(index, userid) {
                var res = await axios.post('/api/auth/deleteUser',{
                    id: userid
                });
                console.log(res)
            },
            async resetUserPassword(userid) {
                var res = await axios.post('/api/auth/resetPassword', {
                    id: userid
                })
                console.log(res)
            }
        }
    }
</script>
