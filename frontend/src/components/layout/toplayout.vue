<template>
    <div class="skin-blue">
        <div>
            <topbar></topbar>
            <router-view></router-view>
        </div>
    </div>
</template>
<script>
import axios from 'axios'
import topbar from '@/components/vue/topbar'
export default {
    components: {
        topbar
    },
    async created() {

    }
}
</script>