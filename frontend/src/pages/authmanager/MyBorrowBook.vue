<template>
    <div>
    6666
    </div>
</template>
<script>
import axios from 'axios'
export default {
    data(){
        return {
            
        }
    },
    async created() {
        var res = await axios.get('/api/order/myallbook');
        console.log(res);
    }
}    
</script>