<template>
    <div content-wrapper>
    <br>
    <br>
    <div>
        <div class = "col-md-2">
            <button class = "btn btn-primary" @click = "ReturnLast()"> Return Last</button>
        </div>
        <h3> Book Detail </h3>
    </div>
    <br>
    <br>
    <div class = "row">
        <span class = "col-md-2"><h1> title:</h1></span>
        <span class = "col-md-3">
            {{title}}
        </span>
        <span class = "col-md-1"><h1> author:</h1></span>
        <span class = "col-md-1">
            {{author}}
        </span>
        <span class = "col-md-5">  
        <div v-if="image">
            <span class = "col-md-6">
                <h1>Image:</h1>
            </span>
            <span class = "col-md-6">
                <div class="demo-upload-list"> 
                    <img :src="image" width="10%"/>
                </div>
            </span>
        </div>
        </span>

    </div>
    <br>
    <div class = "row">
        <span class = "col-md-2"><h1> translator:</h1></span>
        <span class = "col-md-3">
            {{translator}}
        </span>
        <span class = "col-md-1"></span>
        <span class = "col-md-2"><h1> publisher:</h1></span>
        <span class = "col-md-3">
            {{publisher}}
        </span>
    </div>
    <br>
    <div class = "row">
        <span class = "col-md-2"><h1> price:</h1></span>
        <span class = "col-md-3">
            {{price}}
        </span>
        <span class = "col-md-1"></span>
        <span class = "col-md-2"><h1> pages:</h1></span>
        <span class = "col-md-3">
            {{pages}}
        </span>
    </div>
    <br>
    <div class = "row">
        <span class = "col-md-2"><h1> pudate:</h1></span>
        <span class = "col-md-3">
            {{pudate}}
        </span>
        <span class = "col-md-1"></span>
        <span class = "col-md-2"><h1>summary:</h1></span>
        <span class = "col-md-3">
             {{summary}}
        </span>
    </div>
    <br>
    <div class = "row">
        <span class = "col-md-2"><h1> catalog:</h1></span>
        <span class = "col-md-3">
           {{catalog}}
        </span>
        <span class = "col-md-1"></span>
        <span class = "col-md-2"><h1>authorintro:</h1></span>
        <span class = "col-md-3">
                {{authorintro}}
        </span>
    </div>
    <br>
    <div style = "float: left; margin-left: 10px">
        <h2>Picture Collection</h2>
    </div>
    <div class="demo-upload-list" v-for="(item,index) in imgs" :key="index">
        <img :src="item.imgurl"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    </div>
    <br>
        <div class = "row" style = "margin-left: 10px">
            <div class="box">
                <div class="box-header">
                    <h3 style = "float: left"> Borrow Detail </h3>
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
                                <th width = "20%">BookLocation</th>
                                <th>BookInfo</th>
                            </tr>
                            <tr v-for = "(content,index) in contents" :key = "index">
                                <td>{{content[0].id}}</td>
                                <td>{{content[0].location}}</td>
                                <td> 
                                <div v-if ="!content[1]">
                                    avaliable
                                </div>
                                <div v-if ="content[1]">
                                    <div v-if = "content[1].type_id == 0">
                                        Borrow;;;;
                                        Borrowed Time {{content[1].created_at}}
                                        Should Borrow Time {{content[1].return_time}}
                                    </div>
                                    <div v-if = "content[1].type_id == 1">
                                        Renew;;;;
                                        Borrowed Time {{content[1].created_at}}
                                        Should Borrow Time {{content[1].return_time}}
                                    </div>
                                    <div v-if = "content[1].type_id == 2">
                                        Avaliable
                                    </div>
                                </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
            <br>
        </div>
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
        var res0 = await axios.post('/api/book/getBookAllImage', {
            isbn: this.ISBN
        })
        console.log(res0)
        for(var ims of res0.data.images){
            this.imgs.push({
                imgid: ims.image_id,
                imgurl: `/api/getImage?ImageId=` + ims.image_id
            })
        }
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
            category: '',
            imgs: []
        }
    },
    methods: {
        ReturnLast() {
            this.$router.go(-1)
        }
    }
}    
</script>
<style scoped>
    .demo-upload-list{
        display: inline-block;
        width: 150px;
        height: 150px;
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