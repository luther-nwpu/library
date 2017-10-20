<template>
    <div class="box-body">
      <div class="row" style = "margin-top: 20px; height: 50px">
        <span class = "col-md-2">
          <a href = "#/admin/createBook" class = "btn btn-primary" style = "margin-top: 12px"> <h1>addBook</h1> </a>
        </span>
      </div>
      <div class="row" style ="margin-left: 5px; margin-right: 5px">              
        <table class="table table-striped table-bordered" id="mytable">
          <thead>
            <tr>
              <th class="numeric">BookTitle</th>
              <th class="numeric"> BookAuthor </th>
              <th class="numeric"> Category </th>
              <th> ISBN </th>
              <th> Operation </th>             
            </tr>
          </thead>
          <tbody>
            <tr v-for="(info,index) in books" :key="index">
              <td> <router-link :to="{name: 'editBook', params: {isbn: index}}"> {{info[0].title}}</router-link></td>
              <td> {{info[0].author}} </td>
              <td> {{info[0].category}}</td>
              <td> {{index}}</td>
              <td> <button @click = "deleteBook(index)"> Delete This ISBN </button> </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
</template>
<script>
import axios from 'axios'
import '@/assets/js/jquery.dataTables.min'
export default {
    data () {
        return {
            books: []
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
      async deleteBook(index) {
            var res = await axios.post('/api/book/deletebyIsbn', {
                isbn: index
            })
            console.log(res)
            if(res.data.delete){
              alert('delete true') 
              this.books.splice(index, 1);
              this.$forceUpdate()
            } else {
              alert('delete false') 
            }
        }
    }
}
</script>
<style>
</style>