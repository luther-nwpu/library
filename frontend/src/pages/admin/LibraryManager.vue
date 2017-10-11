<template>
<div>
    <div class="box-body">
        <div class = "row" style = "margin-top: 10px" >
             <div class ="col-md-3" style="margin-left: 10px"><h1>ADD LIBRARYMANAGER</h1></div>
        </div>
        <br>
        <div class = "row">
            <span class = "col-md-3"><h2> email:</h2> </span> 
            <span class = "col-md-3"><input type = "text" class = "form-control" v-model = "email"/></span>
            <span class = "col-md-2"> <button @click = "search()"> Search</button> </span>
        </div>
        <table class="table table-striped table-bordered" id="mytable">
            <thead>
            <tr>
                <th class="numeric"> UserId </th>
                <th class="numeric"> UserName </th>
                <th class="numeric"> UserEmail </th>
                <th class="numeric"> CreatedTime </th>
                <th class="numeric"> Operation </th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(info,index) in research" :key="index">
                <td> <h2>{{info.user.id}}</h2> </td>
                <td> <h2> {{info.user.name}}</h2> </td>
                <td> <h2>{{info.user.email}} </h2></td>
                <td> <h2>{{info.user.created_at}}</h2> </td>
                <td>
                <button class ="btn btn-primary" @click = "addManager(info.user.id)">AddManager</button>
                </td>
            </tr>
            </tbody>
        </table>
        <br>
        <br>
        <div class = "row" style = "margin-top: 10px" >
           <div class ="col-md-3"><h1>All LIBRARYMANAGER</h1></div>
        </div>
        <br>
        <div class="row" style ="margin-left: 5px; margin-right: 5px">              
        <table class="table table-striped table-bordered" id="mytable">
            <thead>
            <tr>
                <th class="numeric"> UserId </th>
                <th class="numeric"> UserName </th>
                <th class="numeric"> UserEmail </th>
                <th class="numeric"> CreatedTime </th>
                <th class="numeric"> Operation </th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(info,index) in libraryManagers" :key="index">
                <td> <h2>{{info[1].id}}</h2> </td>
                <td> <h2> {{info[1].name}}</h2> </td>
                <td> <h2>{{info[1].email}} </h2></td>
                <td> <h2>{{info[0].created_at}}</h2> </td>
                <td>
                <button class ="btn btn-primary" @click = "deleteManager(info[0].id, index)"> DELETE</button>
                </td>
            </tr>
            </tbody>
        </table>
        </div>
    </div>
</div>
</template>
<script>
import axios from 'axios'
export default {
    data(){
        return {
            libraryManagers: '',
            email: '',
            research: []
        }
    },
    async created(){
        var res = await axios.get('/api/admin/getall')
        console.log(res);
        this.libraryManagers = res.data.libraryManager;
    },
    methods: {
        async search() {
            this.research = [];
            if(this.email == ''){
                alert('Please Input Email');
            } else {
                console.log(this.email);
                var res = await axios.post('/api/admin/getuser', {
                    email: this.email
                })
                console.log('当前用户' + res)
                console.log(res.data)
                if(res.data.search){
                    this.research.push(res.data)
                    this.$Message.info("research success");
                } else {
                    console.log('是')
                    alert('No This User');
                }
            }
        },
        async addManager(id) {
            console.log(id);
            var res = await axios.post('/api/admin/create', {
                user_id: id
            })
            if(!res.data.created){
                alert('THIS USER ALREADY EXIST, PLEASE ADD OTHER USER');
            } else {
                this.libraryManagers.push(res.data.manager);
                this.$Message.info('ADD SUCCESS');
                this.research = []
            }
            console.log(res)
        },
        async deleteManager(id, index) {
            var res = await axios.post('/api/admin/delete', {
                id: id
            })
            this.libraryManagers.splice(index, 1);
            console.log(res)
        }
    }
}
</script>