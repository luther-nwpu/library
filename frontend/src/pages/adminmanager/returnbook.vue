<template>
    <div>
        人的id: <input type="text" v-model = "user_id"/> 
        书的id: <input type="text" v-model = "book_id"/> <button @click = "returnbook"> 还书 </button>
    </div>
</template>
<script>
import axios from 'axios'
export default {
    data() {
        return {
            book_id: '',
            user_id: ''
        }
    },
    methods: {
        async returnbook() {
            if (this.user_id && this.book_id) {
                var res = await axios.post('/api/order/returnbook', {
                    user_id: this.user_id,
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