<template>
    <div>
    <Upload action="/api/upload"
     name="photo"
    enctype="multipart/form-data"
    :on-success="handleSuccess"
    :with-credentials="true">
        <Button type="ghost" icon="ios-cloud-upload-outline">上传文件</Button>
    </Upload>

    </div>
</template>
<script>
import axios from 'axios'
export default {
    name: 'test',
    async created () {
        var res = await axios.get('api');
        console.log(res)
        var res2 = await axios.get('api/test');
        console.log(res2.data)
    },
    methods: {
        handleSuccess (res, file, filelist) {
            // 因为上传过程为实例，这里模拟添加 url
            console.log(res)
            console.log(file)
            console.log(filelist)
        }
    }
}    
</script>