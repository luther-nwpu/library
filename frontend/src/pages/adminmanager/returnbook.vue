<template>
    <div>
        <br>
        <div class = "row">
            <div class = "col-md-2"></div>
            <div class = "col-md-2">
                <h2> Bookid: </h2>
            </div>
            <div class = "col-md-2">
                <input type="text" class = "form-control" v-model = "book_id" @keyup.enter = "returnbook()"/> 
            </div>
            <div class = "col-md-2">
                <button  class = "btn btn-primary" @click = "returnbook()"> return Book </button>
            </div>
        </div>
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