<template>
    <div>
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">AllBook</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">              
            <table class="table table-striped table-bordered" id="mytable">
              <thead>
                <tr>
                  <th class="numeric"> BookId </th>
                  <th class="numeric"> BookName </th>
                  <th class="numeric"> Description </th>
                  <th class="numeric"> BookCode </th>
                  <th class="numeric"> ISBN </th>
                  <th class="numeric"> BookAuthor </th>
                  <th class="numeric"> BookLocation </th>
                  <th class="numeric"> BookInfo </th>
                  <th class="numeric"> Operation </th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(info,index) in trainerInfoTables" :key="index">
                  <td> {{info.engName}} </td>
                  <td> {{info.chnName}} </td>
                  <td> {{info.universityName}} </td>
                  <td> {{info.emailAddress}} </td>
                  <td> {{info}} </td>
                  <td> {{info.phoneNumber}} </td>
                  <td>
                    <router-link :to="{ name: 'coachInfo', params: { id: info.id }}"><button class="btn btn-xs green"> 个人信息 </button></router-link>
                    <router-link :to="{ name: 'team', params: { id: info.id }}"> <button class="btn btn-xs blue"> 我的队伍 </button> </router-link>
                  </td>
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



    <div> 导入excel </div>
    书名:<input type = "text" class = "form-control" v-model = "bookname"/>
    书的标识:<input type = "text" class = "form-control" v-model = "bookcode"/>
    书的描述:<input type = "text" class = "form-control" v-model = "description"/>
    书的目录:<input type = "text" class = "form-control" v-model = "category_id"/>
    <Select v-model="model1" style="width:200px">
        <Option v-for="item in categorys" :value="item.name" :key="item.id">{{ item.name }}</Option>
    </Select>
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
            books: '',
            categorys: [],
            model1: '',
            trainerInfoTables
        }
    },
    async created () {
        var res = await axios.get('/api/book/getall');
        console.log(res)
        this.books = res.data;
        var category = await axios.get('api/category/getall');
        console.log(category);
        this.categorys = category.data
        console.log(this.categorys)
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