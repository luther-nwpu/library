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
              <div class="row" style ="margin-left: 5px; margin-right: 5px">              
                <table class="table table-striped table-bordered" id="mytable">
                  <thead>
                    <tr>
                      <!-- <th class="numeric"> BookId </th> -->
                      <th class="numeric"> BookCode </th>
                      <th class="numeric"> BookName </th>
                      <th class="numeric"> CategoryName </th>
                      <th class="numeric"> Description </th>
                      
                      <th class="numeric"> ISBN </th>
                      <th class="numeric"> BookAuthor </th>
                      <th class="numeric"> BookLocation </th>
                      <!-- <th class="numeric"> BookInfo </th>
                      <th class="numeric"> Operation </th> -->
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(info,index) in books" :key="index">
                      <!-- <td> {{info[0].id}} </td> -->
                      <td> {{info[0].bookcode}} </td>
                      <td> {{info[0].bookname}} </td>
                      <td> {{info[1].name}}</td>
                      <td> {{info[0].description}} </td>
                      
                      <td> {{info[0].ISBN}} </td>
                      <td> {{info[0].bookauthor}} </td>
                      <td> {{info[0].booklocation}}</td>
                      <!-- <td> {{info[3]}}</td>
                      <td>
                      </td> -->
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
    }
}
</script>
<style>
</style>