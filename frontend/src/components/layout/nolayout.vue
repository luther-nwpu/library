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
import '@/assets/js/pages/beetle'
import '@/assets/js/pages/plugins'

import topbar from '@/components/vue/topbar'
export default {
    components: {
        topbar
    },
    async created() {
    }
}
</script>
<style scoped>
  @import '@/assets/css/layers.min.css';
</style>