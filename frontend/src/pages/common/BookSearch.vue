<template>
</template>
<script>
import axios from 'axios'
export default {
    async created() {
        var res = await axios.get('/api/book/getall');
        console.log(res);
    },
    data () {
        return {

        }
    }

}    
</script>
<style>
</style>