<template>
    <div>
    <br>
    <h3> Add Book (Remarks: You Can Input The ISBN Enter Quickly Fill The Info) </h3>
    <br>
    <div class = "row">
        <span class = "col-md-2"><h1> title:</h1></span>
        <span class = "col-md-3">
            <input type = "text" class = "form-control" v-model = "title"/>
        </span>
        <span class = "col-md-1"></span>
        <span class = "col-md-2"><h1> author:</h1></span>
        <span class = "col-md-3">
            <input type = "text" class = "form-control" v-model = "author"/>
        </span>
    </div>
    <br>
    <div class = "row">
        <span class = "col-md-2"><h1> translator:</h1></span>
        <span class = "col-md-3">
            <input type = "text" class = "form-control" v-model = " translator"/>
        </span>
        <span class = "col-md-1"></span>
        <span class = "col-md-2"><h1> publisher:</h1></span>
        <span class = "col-md-3">
            <input type = "text" class = "form-control" v-model = "publisher"/>
        </span>
    </div>
    <br>
    <div class = "row">
        <span class = "col-md-2"><h1> price:</h1></span>
        <span class = "col-md-3">
            <input type = "text" class = "form-control" v-model = "price"/>
        </span>
        <span class = "col-md-1"></span>
        <span class = "col-md-2"><h1> pages:</h1></span>
        <span class = "col-md-3">
            <input type = "text" class = "form-control" v-model = "pages"/>
        </span>
    </div>
    <br>
    <div class = "row">
        <span class = "col-md-2"><h1> pudate:</h1></span>
        <span class = "col-md-3">
            <input type = "text" class = "form-control" v-model = "pudate"/>
        </span>
        <span class = "col-md-1"></span>
        <span class = "col-md-2"><h1>summary:</h1></span>
        <span class = "col-md-3">
             <Input v-model="summary" type="textarea" :autosize="{minRows: 1,maxRows: 5}" placeholder="please Input..."></Input>
        </span>
    </div>
    <br>
    <div class = "row">
        <span class = "col-md-2"><h1> catalog:</h1></span>
        <span class = "col-md-3">
           <Input v-model="catalog" type="textarea" :autosize="{minRows: 1,maxRows: 5}" placeholder="please Input..."></Input>
        </span>
        <span class = "col-md-1"></span>
        <span class = "col-md-2"><h1>authorintro:</h1></span>
        <span class = "col-md-3">
             <Input v-model="authorintro" type="textarea" :autosize="{minRows: 1,maxRows: 5}" placeholder="please Input..."></Input>
        </span>
    </div>
    <br>
    <div class = "row">
        <span class = "col-md-3">
            <button class = "btn btn-primary" @click = "updateBook()"> Update Book </button>
        </span>
        <span class = "col-md-3">
            <button class = "btn btn-primary"  @click = "ReturnLast()"> Cancel </button>
        </span>
    </div>  
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">This ISBN Book</h3>
        </div>
        <!-- /.box-header -->
        <div class="box">
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tbody>
                    <tr>
                        <th>BookID</th>
                        <th>BookTitle</th>
                        <th width = "20%">BookLocation</th>
                        <th>BookInfo</th>
                        <th>Operation</th>
                    </tr>
                    <tr v-for = "(content,index) in contents" :key = "index">
                        <td>{{content[0].id}}</td>
                        <td>{{content[0].title}}</td>
                        <td><input type = "text" v-model = "content[0].location" class = "form-control" width="60px"/></td>
                        <td> {{content[1]}}</td>
                        <td> <button @click = "updatelocation(content[0].location,content[0].id)">Update Book </button> <button @click = "deletebook(content[0].id, index)">Delete Book </button> </td>
                    </tr>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
            <!-- /.box-body -->
    </div>
    <br>

    </div> 
</template>
<script>
import axios from 'axios'
export default {
    async created(){
        this.ISBN = this.$route.params.isbn
        var res = await axios.post('/api/book/findAllBookByISBN', {
            isbn: this.ISBN
        })
        this.contents = res.data.book
        console.log(this.contents)
        var cx = res.data.book[0][0]
        console.log(res.data.book[0][0])
        this.title = cx.title
        this.image = cx.image
        this.author = cx.author
        this.translator = cx.translator
        this.publisher = cx.publisher
        this.pubdate = cx.pubdate
        this.authorintro = cx.authorintro
        this.summary = cx.summary
        this.catalog = cx.catalog
        this.pages = cx.pages
        this.category = cx.category
        this.price = cx.price
    },
    data () {
        return {
            contents: [],
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
            category: ''
        }
    },
    methods: {
        async updateBook(){
            if(this.ISBN&&this.category&&this.author&&this.title){
                console.log('zhanglu')
                var res = await axios.post('/api/book/createbook', {
                    category: this.category,
                    title: this.title,
                    author: this.author,
                    translator: this.translator,
                    publisher: this.publisher,
                    pudate: this.pubdate,
                    authorintro: this.authorintro,
                    summary: this.summary,
                    catalog: this.catalog,
                    price: this.price,
                    pages: this.pages
                }) 
                console.log(res)
                if(res.data.create) {
                    alert('Update Success')
                } else {
                    alert('Update False')
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