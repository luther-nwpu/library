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
                      <th class="numeric"> BookId </th>
                      <th class="numeric"> BookTitle </th>
                      <th class="numeric"> BookCategory </th>
                      <th class="numeric"> BookAuthor </th>
                      <th class="numeric"> BookLocation </th>
                      <th> BorrowType </th>
                      <th class="numeric"> Borrow Time </th>
                      <th class="numeric"> Return Time </th>
                      <th class="numeric"> Operation </th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(info,index) in books" :key="index">
                      <td> <router-link :to="{name: 'bookdetail', params: {isbn: info[1].isbn}}">  {{info[1].id}} </router-link> </td>
                      <td> <router-link :to="{name: 'bookdetail', params: {isbn: info[1].isbn}}">  {{info[1].title}} </router-link> </td>
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
                      <td> <button type="button" class="btn btn-primary" @click = "renewbook(info[1].id, info[0].type_id)">Renew</button></td>
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
    },
    methods: {
      async renewbook(index, type) {
        var res = await axios.post('/api/order/renewbook', {
            book_id: index
        })
        type = 1;
        console.log(res)
        if(res.data.renew) {
          alert("renew Success")
        } else {
          alert("renew Failed")
        }
      }
    }
}    
</script>