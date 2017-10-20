<template>
    <div>
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">AllBook</h3>
              <button class = "btn btn-primary" style ="float: right"  @click ="linktoindex()"> Switch To library</button>
            </div>
            <div class="box-body">
              <div class="row" style ="margin-left: 5px; margin-right: 5px">              
                <table class="table table-striped table-bordered" id="mytable">
                  <thead>
                    <tr>
                      <th class="numeric">BookTitle</th>
                      <th class="numeric"> BookAuthor </th>
                      <th class="numeric"> Category </th>
                      <th> ISBN </th>               
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(info,index) in books" :key="index">
                     <td> <router-link :to="{name: 'bookinfo', params: {isbn: index}}"> {{info[0].title}}</router-link></td>
                      <td> {{info[0].author}} </td>
                      <td> {{info[0].category}}</td>
                      <td> {{index}}</td>
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
      linktoindex(){
        this.$router.push({//你需要接受路由的参数再跳转
          path: '/library/index'
        });
      }
    }
}
</script>
<style>
</style>