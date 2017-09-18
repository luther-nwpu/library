<template>
<div>
用户id: <input type="text" v-model = "user_id"/>
</div>
</template>
<script>
import axios from 'axios'
export default {
    async created() {
        var res = await axios.post('/api/order/borrowbook', {
            user_id: this.user_id
        });
        console.log(res);
    },
    data () {
        return {
            user_id: ''
        }
    }

}    
</script>
<style>
</style>