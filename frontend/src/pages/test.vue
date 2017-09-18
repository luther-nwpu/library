<template>
    <div>
    
    </div>
</template>
<script>
import axios from 'axios'
export default {
    name: 'test',
    async created () {
        var res = await axios.get('api');
        console.log(res)
        var res2 = await axios.get('api/test');
        console.log(res2.data)
        var res3 = await axios.post('/api/category/find', {
            name: '张璐'
        });
        console.log(res3)
        console.log('我是最帅的' + res3)
        await axios.post('/api/category/create');
    }
}    
</script>