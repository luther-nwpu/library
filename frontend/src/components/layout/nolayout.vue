<template>
    <!-- <div class="skin-blue">
        <div>
            <topbar></topbar>
            <router-view></router-view>
        </div>
    </div> -->
    <body class="page">
		<div>
            <router-view></router-view>
        </div>
	</body>
</template>

<script>
import axios from 'axios'
import topbar from '@/components/vue/topbar'
export default {
    data() {
        return {
            f1: {
            backgroundImage: "url(" + require("../../assets/img/f1.jpg") + ")",
          },
          f2: {
            backgroundImage: "url(" + require("../../assets/img/f2.jpg") + ")",
          },
          f3: {
            backgroundImage: "url(" + require("../../assets/img/f3.jpg") + ")",
          },
          f4: {
            backgroundImage: "url(" + require("../../assets/img/f4.jpg") + ")",
          },
        
     }
    },
    components: {
        topbar
    },
    async created() {
    }
}
</script>
<style scoped>
/* @import '/static/css/layers.min.css';
@import '/static/css/font-awesome.min.css';
@import '/static/style.css'; */
</style>