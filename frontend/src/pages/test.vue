<template>
</template>
<script>
import axios from 'axios'
export default {
    data () {
        return {
        }
    },
    async created () {
        var res = await axios.get('/api/ISBNInfo')
        console.log(res)
    }
}
</script>
