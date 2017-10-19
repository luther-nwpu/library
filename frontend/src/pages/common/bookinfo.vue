<template>
    <div>
        <button> 返回 </button>
    </div>
</template>
<script>
import axios from 'axios'
export default {
    async created () {
        this.isbn = this.$route.params.isbn
        console.log(this.isbn)
        var res = await axios.post('/api/book/findbookByISBN', {
            isbn: this.isbn
        });
        console.log(res)
    },
    data () {
        return {
            isbn: ''
        }
    }
}
</script>
<style scoped>

</style>