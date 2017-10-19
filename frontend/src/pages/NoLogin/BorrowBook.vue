<template>
<div>
    <div class="row">
    <div class="col-md-6 border">
        Email: <input type = "text" v-model = "email"/>
        <button @click = "GetUserInfo()">Search</button>
    </div>
    <div v-for="mybook in mybooks">
    </div>
    <div class="col-md-6">
        书籍id: <input type = "text" v-model = "book_id"/>
        <button @click = "GetBookInfo()">Search</button>
    </div>
    </div>
</div>
</template>
<script>
import axios from 'axios'
export default {
    data() {
        return {
            usercode: '',
            mybooks: [],
            book_id: ''
        }
    },
    methods: {
        async borrowBook() {
            var res = await axios.post('/api/order/borrowbook', {
                email: this.email,
                book_id: this.book_id
            })
            console.log(res)
        },
        async GetUserInfo() {
            var res = await axios.post('/api/order/getuser', {
                email: this.email
            });
            console.log(res)
        },
        async GetBookInfo() {
            var res = await axios.post('/api/order/findbook', {
                id: this.book_id
            })
            console.log(res)
        }
    }

}
</script>