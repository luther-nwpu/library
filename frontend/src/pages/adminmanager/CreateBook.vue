<template>
<div>
    <div> 导入excel </div>
    书名:<input type = "text" class = "form-control" v-model = "bookname"/>
    书的标识:<input type = "text" class = "form-control" v-model = "bookcode"/>
    书的描述:<input type = "text" class = "form-control" v-model = "description"/>
    书的作者:<input type = "text" class = "form-control" v-model = "bookauthor"/>
    书的ISBN:<input type = "text" class = "form-control" v-model = "ISBN"/>
    书的位置:<input type = "text" class = "form-control" v-model = "booklocation"/>
    书的目录:<input type = "text" class = "form-control" v-model = "category_id"/>
    书的创建时间:<input type = "text" class = "form-control" v-model = "bookpublishtime"/>
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
    data() {
        return {
            bookcode: '',
            bookname: '',
            description: '',
            category_id:'',
            booklocation: '',
            ISBN: '',
            bookauthor: '',
            bookpublishtime: '',
            books: '',
        }
    },
    methods: {
        async createBook() {
            var res = await axios.post('/api/book/create', {
                bookcode: this.bookcode,
                bookname: this.bookname,
                description: this.description,
                category_id: this.category_id,
                ISBN: this.ISBN,
                bookauthor: this.bookauthor,
                booklocation: this.booklocation,
                bookpublishtime: this.bookpublishtime
            });
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