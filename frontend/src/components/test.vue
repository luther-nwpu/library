<template>
    <div>
        我是张露]\
        dsajdsajkdksa
        <div>
            <input>
        </div>
    </div>
</template>
<script>
import axios from 'axios'
export default {
  name: 'test',
  async created () {
    var res = await axios.get('/api/user')
    console.log(res)
  },
  data () {
    return {
    }
  }
}
</script>
<style scoped>
</style>