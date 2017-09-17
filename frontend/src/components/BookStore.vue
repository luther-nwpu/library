<template>
    <div>
    书名:<input type = "text" v-model = "bookname"/>
    书的标识:<input type = "text" v-model = "bookcode"/>
    书的描述:<input type = "text" v-model = "description"/>
    书的目录:<input type = "text" v-model = "category_id"/>
    <button @click = "createBook()"> 添加 </button>
    </div>
</template>
<script>
import axios from 'axios'
export default {
    data () {
        return {
            bookcode: '',
            bookname: '',
            description: '',
            category_id:''
        }
    },
    methods: {
        async createBook() {
            var res = await axios.post('/api/book/create', {
                bookcode: this.bookcode,
                bookname: this.bookname,
                description: this.description,
                category_id: this.category_id
            })
            console.log(res)
        }
    }
}
</script>
<style>
</style>