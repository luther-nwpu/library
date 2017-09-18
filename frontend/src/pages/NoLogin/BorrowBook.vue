<template>
<div>
  用户id: <input type = "text" v-model = "user_id"/>
  书籍id: <input type = "text" v-model = "book_id"/>
  <button @click ="borrowBook()">借书</button>
</div>
</template>
<script>
import axios from 'axios'
export default {
    data() {
        return {
            
        }
    },
    methods: {
        async borrowBook() {
            var res = await axios.post('/api/order/borrowbook', {
                user_id: this.user_id,
                book_id: this.book_id
            })
        }
    }

}
</script>