<template>
    <div class="box-body">
        <div class ="row" style ="margin-top: 10px">
        <span class ="col-md-3"></span>
        <span class ="col-md-2" style ="margin-top: 4px"><h3>Category Name:</h3></span>
        <span class ="col-md-2">
            <input type="text" class = "form-control" v-model = "name"/>
        </span>
        <span class = "col-md-2">
            <button @click = "addcategory()" style ="margin-top: 4px" class = "btn btn-primary">AddCategory</button>
        </span>
        </div>
        <div class="col-xs-12" style = "margin-top: 5px">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Category Management</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive table-border no-padding">
              <table class="table table-bordered table-hover">
                <tbody>
                <tr>
                  <th><h2>Category Name</h2></th>
                  <th><h2>Operator</h2></th>
                </tr>
                <tr v-for = "(category, index) in categorys" :key="index">
                  <td><h2>{{category.name}}</h2></td>
                  <td><button class = "btn btn-primary" @click = "deletecategory(category.id, index)"> 删除</button></td>
                </tr>
              </tbody></table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
    </div>
</template>
<script>
import axios from 'axios'
export default {
    data () {
        return {
            name: '',
            categorys: []
        }
    },
    async created () {
        var res = await axios.get('api/category/getall');
        console.log(res);
        this.categorys = res.data
        console.log(this.categorys)
    },
    methods: {
        async deletecategory(id, index) {
            console.log(id);
            var res = await axios.post('/api/category/del', {
                id: id
            })
            console.log(res)
            this.categorys.splice(index,1);
        },
        async addcategory() {
            var res = await axios.post('/api/category/create', {
                name: this.name
            });
            this.categorys.push(res.data.Category);
            console.log(res);
        }
    }
}
</script>
<style>
    
</style>