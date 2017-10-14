<template>
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
                      <!-- <th class="numeric"> BookId </th> -->
                      <th class="numeric"> BookName </th>
                      <!-- <th class="numeric"> CategoryName </th> -->
                      <th class="numeric"> Description </th>
                      <th class="numeric"> BookCode </th>
                      <th class="numeric"> ISBN </th>
                      <th class="numeric"> BookAuthor </th>
                      <th class="numeric"> BookLocation </th>
                      <th class="numeric"> Borrow Time </th>
                      <th class="numeric"> Return Time </th>
                      <!-- <th class="numeric"> BookInfo </th> -->
                      <th class="numeric"> Operation </th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(info,index) in books" :key="index">
                      <!-- <td> {{info[0].id}} </td> -->
                      <td> {{info[1].bookname}} </td>
                      <!-- <td> {{info[1].name}}</td> -->
                      <td> {{info[1].description}} </td>
                      <td> {{info[1].bookcode}} </td>
                      <td> {{info[1].ISBN}} </td>
                      <td> {{info[1].bookauthor}} </td>
                      <td> {{info[1].booklocation}}</td>
                      <td> {{info[0].created_at}} </td>
                      <td> {{info[0].return_time}}</td>
                      <td> <button type="button" class="btn btn-primary">Renew</button></td>
                      <!-- <td> -->
                       <!-- <router-link :to="{ name: 'editBook', params: { id: info[0].id }}"> <button class="btn btn-xs blue"> Edit </button> </router-link> -->
                   <!-- <button @click = "deleteBook(info[0].id)">delete</button> -->
                      <!-- </td> -->
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
    data(){
        return {
            books: []
        }
    },
    async created() {
        var res = await axios.get('/api/order/myallbook');
        console.log(res);
        if(res.data != null) {
          this.books = res.data;
        }
        this.$nextTick(function() {
          $('#mytable').dataTable();
        })
    }
}    
</script>