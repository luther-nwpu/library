<template>
<div>
    <div class="row">
        <div class="col-md-6 border">
            UserCode:<input v-model = "usercode" v-on:blur="getUserInfo()"  v-focus-next-on-enter="'input2'"/>
        </div>
        <div class="col-md-6">
            Bookcode: <input type = "text"  v-model = "book_id" ref = "input2" @keyup.enter = "borrowBook()"/>
        </div>
        {{user}}
        <button @click = "getUserInfo()"> dsadsa</button>
    </div>
</div>
</template>
<script>
import axios from 'axios'
export default {
    data() {
        return {
            usercode: '',
            book_id: '',
            user: '',
            bookinfo: '',
            books: []
        }
    },
    methods: {
        async borrowBook() {
            var res = await axios.post('/api/order/getUserByUserCode', {
                usercode: this.usercode
            });
            console.log(res)
            if(res.data.get) {
                this.user = res.data.user
                var res0 = await axios.post('/api/order/myborrowbookbyuser', {
                    user_id: this.user.id
                })
                console.log(res0)
                this.books = res0.data
            } else {
                alert('No This User')
            }
        },
        async getUserInfo() {
            var res = await axios.post('/api/order/getUserByUserCode', {
                usercode: this.usercode
            });
            console.log(res)
            if(res.data.get) {
                this.user = res.data.user
                var res0 = await axios.post('/api/order/myborrowbookbyuser', {
                    user_id: this.user.id
                })
                console.log(res0)
                this.books = res0.data
            } else {
                alert('No This User')
            }
        }
    }

}
</script>