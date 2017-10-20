<template>
<div>
    <div class="row">
        <div class="col-md-6 border">
            UserCode:<input v-model = "usercode" v-on:blur="getUserInfo()"  v-focus-next-on-enter="'input2'"/>
        </div>
        <div class="col-md-6">
            Bookcode: <input type = "text"  v-model = "book_id" ref = "input2"/>
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
            bookinfo: ''
        }
    },
    methods: {
        async borrowBook() {
            if(this.email) {
                var res = await axios.post('/api/order/getuser', {
                    email: this.email
                });
                console.log(res)
                if(res.data.search == false) {
                    alert('No This User')
                } else {
                    console.log(res.data.user.id)
                    this.user_id = res.data.user.id
                    this.user = res.data.user
                }
            } else {
                alert('Please Input User')
            }
            if (this.book_id) {
                var res = await axios.post('/api/order/borrowbook', {
                    user_id: this.user_id,
                    book_id: this.book_id
                });
                console.log(res)
                if(res.data.create){
                    alert("Borrow Success");
                    this.$Message.info("Borrow Success");
                } else {
                    alert('Borrow Failed')
                }
            }
        },
        async getUserInfo() {
            var res = await axios.post('/api/order/getUserByUserCode', {
                usercode: this.usercode
            });
            console.log(res)
            if(res.data.search) {
            } else {
                alert('No This User')
            }
        }
    }

}
</script>