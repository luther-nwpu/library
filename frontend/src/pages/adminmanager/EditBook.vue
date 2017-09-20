<template>
<div>
    <br>
    <div> <h1>BOOKINFORMATION   EDIT</h1> </div>
    <br>
    <div class = "row">
        <span class = "col-md-3"><h1> BookName:</h1></span>
        <span class = "col-md-4">
        <input type = "text" class = "form-control" v-model = "bookname"/>
        </span>
    </div>
    <br>
    <div class = "row">
        <span class = "col-md-3"><h1> BookCode:</h1></span>
        <span class = "col-md-4">
        <input type = "text" class = "form-control" v-model = "bookcode"/>
        </span>
    </div>
    <br>
    <div class = "row">
        <span class = "col-md-3"><h1> description:</h1></span>
        <span class = "col-md-4">
        <input type = "text" class = "form-control" v-model = "description"/>
        </span>
    </div>
    <br>
    <div class = "row">
        <span class = "col-md-3"><h1> bookauthor:</h1></span>
        <span class = "col-md-4">
        <input type = "text" class = "form-control" v-model = "bookauthor"/>
        </span>
    </div>
    <br>
    <div class = "row">
        <span class = "col-md-3"><h1> ISBN:</h1></span>
        <span class = "col-md-4">
        <input type = "text" class = "form-control" v-model = "ISBN"/>
        </span>
    </div>
    <br>
    <div class = "row">
        <span class = "col-md-3"><h1> booklocation:</h1></span>
        <span class = "col-md-4">
        <input type = "text" class = "form-control" v-model = "booklocation"/>
        </span>
    </div>
    <br>
    <div class = "row">
        <span class = "col-md-3"><h1> bookpublishtime:</h1></span>
        <span class = "col-md-4">
        <input type = "text" class = "form-control" v-model = "bookpublishtime"/>
        </span>
    </div>
    <br>
    <div class = "row">
        <span class = "col-md-3"><h1> category_id:</h1></span>
        <span class = "col-md-4">
        <select class="form-control" v-model = "category_name"> 
            <option v-for = "category in categorys">{{category.name}}</option>
        </select>
        </span>
    </div>
    <br>
    <div class = "row">
        <span class = "col-md-3">
            <button class = "btn btn-primary" @click = "updateBook()"> Update Book </button>
        </span>
        <span class = "col-md-3">
            <button class = "btn btn-primary" @click = "ReturnLast()"> Cancel or Return </button>
        </span>
    </div>  
</div>
</template>
<script>
import axios from 'axios'
export default {
    async created() {
        this.id =this.$route.params.id;
        var res = await axios.get('api/category/getall');
        console.log(res);
        this.categorys = res.data
        console.log(this.categorys)
        var book = await axios.post('/api/book/findbook', {
            id: this.id
        });
        console.log(book);
        if(book.data.id == null) {
           this.$Message.error('This Id Error')
        } else {
            this.bookcode = book.data.bookcode;
            this.bookname = book.data.bookname;
            this.description = book.data.description;
            console.log('我喜欢你' +book.data.category_id);
            console.log(this.categorys)
            for (var item of this.categorys) {
                if(book.data.category_id == item.id){
                    this.category_name = item.name
                }  
            }
            console.log('我喜欢你' + this.category_name);
            this.booklocation= book.data.booklocation;
            this.ISBN = book.data.ISBN;
            this.bookauthor = book.data.bookauthor;
            this.bookpublishtime = book.data.bookpublishtime;
        }
    },
    data() {
        return {
            id: '',
            bookcode: '',
            bookname: '',
            description: '',
            category_name:'',
            booklocation: '',
            ISBN: '',
            bookauthor: '',
            bookpublishtime: '',
            books: '',
            categorys: ''
        }
    },
    methods: {
        async updateBook() {
            var category_id = '';
            console.log('11我爱你'+this.categorys);
            for (var item of this.categorys) {
                console.log('11111111111111111111我喜欢你' + item);
                if(this.category_name == item.name) {
                     category_id = item.id;
                }
            }
            console.log(category_id);
            if(this.id&&this.bookcode&&this.bookname&&this.description&&this.category_name&&this.booklocation&&this.ISBN&&this.bookauthor&&this.bookpublishtime)
            {
                var res = await axios.post('/api/book/update', {
                    id: this.id,
                    bookcode: this.bookcode,
                    bookname: this.bookname,
                    description: this.description,
                    category_id: category_id,
                    ISBN: this.ISBN,
                    bookauthor: this.bookauthor,
                    booklocation: this.booklocation,
                    bookpublishtime: this.bookpublishtime
                });
                console.log(res)
                if(res.data.update){
                    alert("Update Success");
                    this.$Message.info("Update Success");
                } else {
                    this.$Message.error(res.data.err)
                }
                
            } else {
                alert("Please Write Full");
                this.$Message.error("Please Write Full");
            }
        },
        async deleteBook(id, index) {
            var res = await axios.post('/api/book/del', {
                id: id
            })
            this.books.splice(index, 1);
            console.log(res)
        },
        ReturnLast() {
            this.$router.push({//你需要接受路由的参数再跳转
                            path: '/admin/bookstore'
                          });
        }
    }   
}
</script>