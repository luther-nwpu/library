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
            book_id: ''
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
                } else {
                   alert('Please Input BookID')
                }
            } else {
                alert('Please Input BookID')
            }
        }
    }
}
</script>