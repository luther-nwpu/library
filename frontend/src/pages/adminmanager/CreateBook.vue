<template>
    <div>
    <br>
    <h3> Add Book (Remarks: You Can Input The ISBN Enter Quickly Fill The Info) </h3>
    <br>
    <div class = "row">
        <span class = "col-md-2"><h1>ISBN:</h1></span>
        <span class = "col-md-2">
            <input type = "text" class = "form-control" v-model = "ISBN" v-on:blur = "searchbook()" v-focus-next-on-enter="'input2'"/>
        </span>
        <span class = "col-md-1">Category:</span>
        <span class = "col-md-2"> 
            <input type = "text" class = "form-control" v-model = "category" ref = "input2" :readonly = "repeat"/></span>
        <span class = "col-md-1"></span>
        <div v-if="image">
            <span class = "col-md-1">
                <h1>Image:</h1>
            </span>
            <span class = "col-md-1">
                <div class="demo-upload-list"> 
                    <img :src="image" width="10%"/>
                </div>
            </span>
        </div>
    </div>
    <br>
    <div class = "row">
        <span class = "col-md-2"><h1> title:</h1></span>
        <span class = "col-md-3">
            <input type = "text" class = "form-control" v-model = "title" :readonly = "repeat"/>
        </span>
        <span class = "col-md-1"></span>
        <span class = "col-md-2"><h1> author:</h1></span>
        <span class = "col-md-3">
            <input type = "text" class = "form-control" v-model = "author" :readonly = "repeat"/>
        </span>
    </div>
    <br>
    <div class = "row">
        <span class = "col-md-2"><h1> translator:</h1></span>
        <span class = "col-md-3">
            <input type = "text" class = "form-control" v-model = " translator" :readonly = "repeat"/>
        </span>
        <span class = "col-md-1"></span>
        <span class = "col-md-2"><h1> publisher:</h1></span>
        <span class = "col-md-3">
            <input type = "text" class = "form-control" v-model = "publisher" :readonly = "repeat"/>
        </span>
    </div>
    <br>
    <div class = "row">
        <span class = "col-md-2"><h1> price:</h1></span>
        <span class = "col-md-3">
            <input type = "text" class = "form-control" v-model = "price" :readonly = "repeat"/>
        </span>
        <span class = "col-md-1"></span>
        <span class = "col-md-2"><h1> pages:</h1></span>
        <span class = "col-md-3">
            <input type = "text" class = "form-control" v-model = "pages" :readonly = "repeat"/>
        </span>
    </div>
    <br>
    <div class = "row">
        <span class = "col-md-2"><h1> pudate:</h1></span>
        <span class = "col-md-3">
            <input type = "text" class = "form-control" v-model = "pudate" :readonly = "repeat"/>
        </span>
        <span class = "col-md-1"></span>
        <span class = "col-md-2"><h1>summary:</h1></span>
        <span class = "col-md-3">
             <Input v-model="summary" type="textarea" :autosize="{minRows: 1,maxRows: 5}" placeholder="Please Input..." :readonly = "repeat"></Input>
        </span>
    </div>
    <br>
    <div class = "row">
        <span class = "col-md-2"><h1> catalog:</h1></span>
        <span class = "col-md-3">
           <Input v-model="catalog" type="textarea" :autosize="{minRows: 1,maxRows: 5}" placeholder="Please Input..." :readonly = "repeat"></Input>
        </span>
        <span class = "col-md-1"></span>
        <span class = "col-md-2"><h1>authorintro:</h1></span>
        <span class = "col-md-3">
             <Input v-model="authorintro" type="textarea" :autosize="{minRows: 1,maxRows: 5}" placeholder="Please Input..." :readonly = "repeat"></Input>
        </span>
    </div>
    <br>
    <br>
    <div class = "row">
        <span class = "col-md-2"><h1> location:</h1></span>
        <span class = "col-md-3">
            <input type = "text" class = "form-control" v-model = "location"/>
        </span>
        <span class = "col-md-1"></span>
        <span class = "col-md-2"><h1> booknum:</h1></span>
        <span class = "col-md-3">
            <input type = "number" class = "form-control" v-model = "booknum"/>
        </span>
    </div>
    <br>
    <div class = "row">
        <span class = "col-md-3">
            <button class = "btn btn-primary" @click = "createBook()"> Create Book </button>
        </span>
        <span class = "col-md-3">
            <button class = "btn btn-primary"  @click = "ReturnLast()"> Cancel </button>
        </span>
    </div>  
    </div> 
</template>
<script>
import axios from 'axios'
export default {
    data () {
        return {
            ISBN: '',
            title: '',
            image: '',
            author: '',            
            translator: '',
            publisher: '',
            pudate: '',
            authorintro: '',
            summary: '',
            catalog: '',
            price: '',
            pages: '',
            category: '',
            location: '',
            booknum: 1,
            repeat: false
        }
    },
    methods: {
        async searchbook(){
            var res = await axios.post('/api/book/findAllBookByISBN', {
                isbn: this.ISBN
            })
            console.log(res)
            if(res.data.find && res.data.book.length != 0){       
                var cx = res.data.book[0][0]
                console.log(res.data.book[0][0])
                this.title = cx.title
                this.image = cx.image
                this.author = cx.author
                this.translator = cx.translator
                this.publisher = cx.publisher
                this.pudate = cx.pudate
                this.authorintro = cx.authorintro
                this.summary = cx.summary
                this.catalog = cx.catalog
                this.pages = cx.pages
                this.category = cx.category
                this.price = cx.price
                this.repeat = true;
            }else {
                this.repeat = false;
                var url = 'https://api.douban.com/v2/book/isbn/' + this.ISBN
                var self = this
                $.ajax(url, {
                    dataType: 'jsonp',
                    success: function(data) {
                        console.log(data);
                        self.title = data.title               
                        self.image = data.image
                        self.author = ''
                        for(var authora of data.author){
                            self.author = self.author + authora + ','
                        }
                        for(var translatora of data.translator){
                            self.translator = self.translator + translatora + ','
                        }
                        self.publisher = data.publisher
                        self.pudate = data.pubdate
                        self.authorintro = data.author_intro
                        self.summary = data.summary
                        self.catalog = data.catalog
                        self.price = data.price
                        self.pages = data.pages
                    },
                    error: function(error) {
                        alert('From DouBan Api Error, Please Input Information Or Input ISBN Again')
                    }
                })
            }

        },
        async createBook(){
            if(this.ISBN&&this.category&&this.author&&this.title){
                console.log('zhanglu')
                var res = await axios.post('/api/book/createbook', {
                    category: this.category,
                    isbn: this.ISBN,
                    title: this.title,
                    image: this.image,
                    author: this.author,
                    translator: this.translator,
                    publisher: this.publisher,
                    pudate: this.pudate,
                    authorintro: this.authorintro,
                    summary: this.summary,
                    catalog: this.catalog,
                    price: this.price,
                    pages: this.pages,
                    location: this.location,
                    booknum: this.booknum
                }) 
                console.log(res)
                if(res.data.create) {
                    alert('Create Success')
                } else {
                    alert('Create False')
                }
            } else {
                alert('Please Input ISBN Category Title Author')
            }
        },
        ReturnLast() {
            this.$router.push({//你需要接受路由的参数再跳转
                path: '/admin/bookstore'
            });
        }
    }
}    
</script>
<style scoped>
    .demo-upload-list{
        display: inline-block;
        width: 60px;
        height: 60px;
        text-align: center;
        line-height: 60px;
        border: 1px solid transparent;
        border-radius: 4px;
        overflow: hidden;
        background: #fff;
        position: relative;
        box-shadow: 0 1px 1px rgba(0,0,0,.2);
        margin-right: 4px;
    }
    .demo-upload-list img{
        width: 100%;
        height: 100%;
    }
    .demo-upload-list-cover{
        display: none;
        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        background: rgba(0,0,0,.6);
    }
    .demo-upload-list:hover .demo-upload-list-cover{
        display: block;
    }
    .demo-upload-list-cover i{
        color: #fff;
        font-size: 20px;
        cursor: pointer;
        margin: 0 2px;
    }
</style>