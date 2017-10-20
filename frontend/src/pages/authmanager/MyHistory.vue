<template>
    <div class = "box-body">
      <div class="row" style = "margin-top: 20px">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h2>History</h2>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row" style ="margin-left: 1px; margin-right: 1px">              
                <table class="table table-striped table-bordered" id="mytable">
                  <thead>
                    <tr>
                      <th class="numeric"> BookID </th>
                      <th class="numeric"> BookTitle </th>
                      <th class="numeric"> ISBN </th>
                      <th class="numeric"> BookAuthor </th>
                      <th class="numeric"> BookLocation </th>
                      <th class="numeric"> Borrow Time </th>
                      <th class="numeric"> Return Time </th>
                      <th> Borrow Type </th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(info,index) in books" :key="index">
                      <td> <router-link :to="{name: 'bookdetail', params: {isbn: info[1].isbn}}">{{info[1].id}}</router-link> </td>
                      <td> <router-link :to="{name: 'bookdetail', params: {isbn: info[1].isbn}}">{{info[1].title}}</router-link> </td>
                      <td> {{info[1].isbn}} </td>
                      <td> {{info[1].author}} </td>
                      <td> {{info[1].location}} </td>
                      <td> {{info[0].created_at}} </td>
                      <td> {{info[0].return_time}}</td>
                      <td> 
                      <div v-if="info[0].type_id == 0">
                        Borrowed
                      </div>
                      <div v-else-if="info[0].type_id == 1">
                        Renewed
                      </div> 
                      <div v-else-if="info[0].type_id == 2">
                        Returned
                      </div> 
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
    data(){
        return {
            books: ''
        }
    },
    async created() {
        var res = await axios.get('/api/order/myhistorybook');
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
