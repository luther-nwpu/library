<template>
    <div>
        Bookid: <input type="text" v-model = "book_id"/> <button @click = "returnbook"> return Book </button>
    </div>
</template>
<script>
import axios from 'axios'
export default {
    data() {
        return {
            email: '',
            book_id: '',
            user_id: ''
        }
    },
    methods: {
        async returnbook() {
            if (this.book_id) {
                var res = await axios.post('/api/order/returnbook', {
                    book_id: this.book_id
                });
                console.log(res)
                if(res.data.delete){
                    alert("Return Success");
                    this.$Message.info("Return Success");
                } else {
                    alert(res.data.err)
                    this.$Message.error(res.data.err)
                }
            }
        }
    }
}
</script>