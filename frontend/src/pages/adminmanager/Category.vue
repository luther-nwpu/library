<template>
    <div>
        <input type="text" v-model = "name"/><button @click = "addcategory()"> 添加 </button>
        <div v-for = "(category, index) in categorys" :key="index">
            {{category.name}}
            <button @click = "deletecategory(category.id, index)"> 删除</button>
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