<template>
<div>
    <div>
        email: <input type = "text" v-model = "email"/> <button @click = "search()"> 搜索</button>
    </div>
    <div v-for =  "(item, index) in research" :key = "index">
        {{item}}
        <button @click = "addManager(item.data.user.id)">添加</button>
    </div>
    <div v-for = "(item, index) in libraryManagers" :key = "index"> 
    {{item}}
    <button @click = "deleteManager(item.id, index)">删除</button>
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
            console.log(this.email);
            var res = await axios.post('/api/admin/getuser', {
                email: this.email
            })
            console.log(res)
            this.research.push(res)
        },
        async addManager(id) {
            console.log(id);
            var res = await axios.post('/api/admin/create', {
                user_id: id
            })
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