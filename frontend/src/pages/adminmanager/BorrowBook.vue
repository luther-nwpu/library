<template>
    <div>
        <br>
        <div class="row">
            <div class="col-md-4">
                <div class = "col-md-5"><h2>UserCode:</h2></div><div class = "col-md-7"> <input v-model = "usercode" class="form-control" v-on:blur="getUserInfo()"  v-focus-next-on-enter="'input2'"/></div>
            </div>
            <div class="col-md-1">
            </div>
            <div class="col-md-4">
                <div class = "col-md-5"><h2>Bookcode:</h2></div><div class = "col-md-7"><input type = "text" class="form-control" v-model = "book_id" ref = "input2" @keyup.enter = "borrowBook()"/></div>
            </div>
            <button class = "btn btn-primary" @click = "borrowBook()">Borrow Book</button>
        </div>
        <br>
        <div v-if="user">
            <div class="box box-solid">
                <div class="box-body">
                    <h4 style="background-color:#f7f7f7; font-size: 18px; text-align: center; padding: 7px 10px; margin-top: 0;">
                        User Info
                    </h4>
                    <div class="media">
                        <div class="media-body">
                            <div class="clearfix">
                               <div class = "row">
                                <div class = "col-md-4"><h2>email: {{user.email}}</h2></div>
                                <div class = "col-md-4"><h2>username: {{user.username}} </h2></div>
                                <div class = "col-md-4"><h2>  usernumber: {{user.usernumber}}</h2></div>
                               </div>
                               <br>
                               <div class = "row">
                                <div class = "col-md-6"><h2>useruniversity: {{user.useruniversity}}</h2></div>
                                <div class = "col-md-6"><h2>usercollege: {{user.usercollege}}</h2></div>
                               </div>
                            </div>
                        </div>
                        <div class="media-right">
                            <div v-if="user.imageid == 0">
                            <img :src="logo" width="80px" height ="80px" class="img-circle" alt="User Image">
                            </div>
                            <div v-else>
                            <img :src="ImageUrl" width="80px" height ="80px" class="img-circle" alt="User Image">
                            </div>
                        </div>
                        <div>
                            <div class = "box-body">
                                <div class="row" style = "margin-top: 20px">
                                    <div class="col-xs-12">
                                    <div class="box">
                                        <div class="box-header">
                                        <h2>MyBorrowedBook</h2>
                                        </div>
                                        <!-- /.box-header -->
                                        <div class="box-body">
                                        <div class="row" style ="margin-left: 1px; margin-right: 1px">              
                                            <table class="table table-striped table-bordered" id="mytable">
                                            <thead>
                                                <tr>
                                                <th class="numeric"> BookId </th>
                                                <th class="numeric"> BookTitle </th>
                                                <th class="numeric"> BookCategory </th>
                                                <th class="numeric"> BookAuthor </th>
                                                <th class="numeric"> BookLocation </th>
                                                <th> BorrowType </th>
                                                <th class="numeric"> Borrow Time </th>
                                                <th class="numeric"> Return Time </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="(info,index) in books" :key="index">
                                                <td> {{info[1].id}} </td>
                                                <td>  {{info[1].title}} </td>
                                                <td> {{info[1].category}} </td>
                                                <td> {{info[1].author}} </td>
                                                <td> {{info[1].location}} </td>
                                                <td> 
                                                    <div v-if = "info[0].type_id == 0">
                                                    Borrowed
                                                    </div>
                                                    <div v-if = "info[0].type_id == 1">
                                                    Renewed
                                                    </div>
                                                </td>
                                                <td> {{info[0].created_at}} </td>
                                                <td> {{info[0].return_time}}</td>
                                               </tr>
                                            </tbody>
                                            </table>
                                        </div>
                                        </div>
                                        <!-- /.box-body -->
                                    </div>
                                    <!-- /.box -->
                                    <!-- /.box -->
                                    </div>
                                    <!-- /.col -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import axios from 'axios'
import logo from '@/assets/img/user2-160x160.jpg'
export default {
    data() {
        return {
            logo: logo,
            usercode: '',
            book_id: '',
            user: '',
            bookinfo: '',
            books: [],
            ImageUrl: ''
        }
    },
    methods: {
        async borrowBook() {
            if(this.book_id) {
                var res = await axios.post('/api/order/getUserByUserCode', {
                    usercode: this.usercode
                });
                console.log(res)
                if(res.data.get) {
                    this.user = res.data.user
                    this.ImageUrl = `/api/getImage?ImageId=` + this.user.imageid
                    var res0 = await axios.post('/api/order/myborrowbookbyuser', {
                        user_id: this.user.id
                    })
                    console.log('++++++++++++++++++++++++++++++++++++++++++++++++')
                    console.log(res0)
                    this.books = res0.data.book
                    var res1 = await axios.post('/api/order/borrowbook', {
                        book_id: this.book_id,
                        user_id: this.user.id
                    })
                    console.log(res1)
                    if(res1.data.borrow) {
                        alert('Borrow Success')
                        this.books.push(res1.data.book)
                    } else [
                        alert(res1.data.err)
                    ]
                } else {
                    alert('No This User')
                }
            } else {
                alert('Please Input BookID')
            }
        },
        async getUserInfo() {
            var res = await axios.post('/api/order/getUserByUserCode', {
                usercode: this.usercode
            });
            console.log(res)
            if(res.data.get) {
                this.user = res.data.user
                this.ImageUrl = `/api/getImage?ImageId=` + this.user.imageid
                var res0 = await axios.post('/api/order/myborrowbookbyuser', {
                    user_id: this.user.id
                })
                console.log(res0)
                console.log('+++++++++++++++++++++++++++++++++++++++++++++++++++')
                this.books = res0.data.book
                console.log(this.books)
            } else {
                alert('No This User')
            }
        }
    }

}
</script>