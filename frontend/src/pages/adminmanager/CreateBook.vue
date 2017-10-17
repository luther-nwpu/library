<template>
    <div>
        {{bookinfo}}
    </div>
</template>
<script>
import axios from 'axios'
export default {
    data () {
        return {
            bookinfo: ''
        }
    },
    async created () {
        var url = 'https://api.douban.com/v2/book/1220562'
        var book = $.ajax(url, {
            dataType: 'jsonp',
            success: function(data) {
                console.log(data);
            }
        })
    }
}    
</script>
