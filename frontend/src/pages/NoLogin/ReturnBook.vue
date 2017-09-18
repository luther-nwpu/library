<template>
    书的id: <input type="text" v-model = "book_id"/> <button @click = "returnbook"> 还书 </button>
</template>
<script>
import axios from 'axios'
export default {
    data() {
        return {
            book_id: ''
        }
    },
    methods: {
        async returnbook() {
            var res = await axios.post('/api/order/returnbook', {
                book_id: this.book_id
            });
            console.log(res)
        }
    }
}
</script>