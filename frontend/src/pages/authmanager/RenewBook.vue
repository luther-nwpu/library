<template>
    <div>
    用户id: <input type = "text" v-model = "user_id"/>
    书籍id: <input type = "text" v-model = "book_id"/>
    <button @click ="renewBook()">续借书籍</button>
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
        async renewBook() {
            var res = await axios.post('/api/order/renewbook', {
                user_id: this.user_id,
                book_id: this.book_id
            });
        }
    }
}
</script>