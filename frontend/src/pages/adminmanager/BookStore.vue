<template>
    <div class="box-body">
      <div class="row" style = "margin-top: 20px; height: 50px">
        <span class = "col-md-2">
          <a href = "#/admin/createBook" class = "btn btn-primary" style = "margin-top: 12px"> <h1>addBook</h1> </a>
        </span>
      </div>
      <div class="row" style = "margin-top: 20px">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h2>AllBook</h2>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row" style ="margin-left: 5px; margin-right: 5px">              
                <table class="table table-striped table-bordered" id="mytable">
                  <thead>
                    <tr>
                      <th class="numeric"> BookId </th>
                      <th class="numeric"> BookName </th>
                      <th class="numeric"> CategoryName </th>
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
                    <tr v-for="(info,index) in books" :key="index">
                      <td> {{info[0].id}} </td>
                      <td> {{info[0].bookname}} </td>
                      <td> {{info[1].name}}</td>
                      <td> {{info[0].description}} </td>
                      <td> {{info[0].bookcode}} </td>
                      <td> {{info[0].ISBN}} </td>
                      <td> {{info[0].bookauthor}} </td>
                      <td> {{info[0].booklocation}}</td>
                      <td> {{info[3]}}</td>
                      <td>
                       <router-link :to="{ name: 'editBook', params: { id: info[0].id }}"> <button class="btn btn-xs blue"> Edit </button> </router-link>
                   <button @click = "deleteBook(info[0].id)">delete</button>
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
    </div>
</template>
<script>
import axios from 'axios'
import '@/assets/js/jquery.dataTables.min'
export default {
    data () {
        return {
            books: ''
        }
    },
    async created () {
        var res = await axios.get('/api/book/getall');
        console.log(res)
        this.books = res.data;
        this.$nextTick(function() {
          $('#mytable').dataTable();
        })
    },
    methods: {
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