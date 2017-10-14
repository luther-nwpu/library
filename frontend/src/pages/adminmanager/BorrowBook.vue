<template>
<div>
    <div class="row">
    <div class="col-md-6 border">
        Email: <input type = "text" v-model = "email"/>
        <button @click = "GetUserInfo()">Search</button>
        {{user.name}}
    </div>

    <div class="col-md-6">
        书籍id: <input type = "text" v-model = "book_id"/>
        <button @click = "GetBookInfo()">Search</button>
        {{bookinfo}}
        <button @click = "borrowBook()">Borrow Book</button>
    </div>
    </div>
</div>
</template>
<script>
import axios from 'axios'
export default {
    data() {
        return {
            email: '',
            user_id: '',
            book_id: '',
            user: '',
            bookinfo: ''
        }
    },
    methods: {
        async borrowBook() {
            console.log('55555')
            if (this.user_id && this.book_id) {
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
        async GetUserInfo() {
            var res = await axios.post('/api/order/getuser', {
                email: this.email
            });
            console.log(res)
            if(res.data.search == false) {
                alert('并无本用户')
            } else {
                console.log(res.data.user.id)
                this.user_id = res.data.user.id
                this.user = res.data.user
            }
        },
        async GetBookInfo() {
            var res = await axios.post('/api/order/findbook', {
                id: this.book_id
            })
            console.log(res)
            if(res.data == ""){
                alert("No book")
            }
            this.bookinfo = res.data
        }
    }

}
</script>