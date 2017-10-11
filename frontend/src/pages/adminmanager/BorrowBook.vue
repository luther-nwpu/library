<template>
<div>
    <div class="row">
    <div class="col-md-6 border">
        Email: <input type = "text" v-model = "user_id"/>
        <button @click = "GetUserInfo()">Search</button>
    </div>

    <div class="col-md-6">
        书籍id: <input type = "text" v-model = "book_id"/>
        <button @click = "borrowBook()">Search</button>
    </div>
    </div>
</div>
</template>
<script>
import axios from 'axios'
export default {
    data() {
        return {
            user_id: '',
            book_id: ''
        }
    },
    methods: {
        async borrowBook() {
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
                    alert(res.data.err)
                    this.$Message.error(res.data.err)
                }
            }
        },
        async GetUserInfo() {
            var res = await axios.post('/api/order/getuser', {
                email: this.user_id
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