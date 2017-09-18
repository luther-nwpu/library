<template>
    <div>
    书名:<input type = "text" v-model = "bookname"/>
    书的标识:<input type = "text" v-model = "bookcode"/>
    书的描述:<input type = "text" v-model = "description"/>
    书的目录:<input type = "text" v-model = "category_id"/>
    <button @click = "createBook()"> 添加 </button>

    我的所有书籍
    <div v-for ="(item,index) in books" :key="index">
        {{item}}
        <button @click = "deleteBook(item.id,index)"> 删除 </button>
    </div>
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
            category_id:'',
            books: ''
        }
    },
    async created () {
        var res = await axios.get('/api/book/getall');
        console.log(res)
        this.books = res.data;
    },
    methods: {
        async createBook() {
            var res = await axios.post('/api/book/create', {
                bookcode: this.bookcode,
                bookname: this.bookname,
                description: this.description,
                category_id: this.category_id
            })
            this.books.push(res.data.book)
            console.log(res)
        },
        async deleteBook(id, index) {
            var res = await axios.post('/api/book/del', {
                id: id
            })
            this.books.splice(index, 1);
            console.log(res)
        }
    }
}
</script>
<style>
</style>