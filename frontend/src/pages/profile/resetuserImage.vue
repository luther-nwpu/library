<template>
    <div>
        <h4> Upload Header Icon </h4>

        <div v-if="ImageId == 0">
        </div>
        <div v-else>
            <div class="demo-upload-list">     
                <img :src="img" width="10%"/>
            </div>
        </div>
        <Upload
            name = "photo"
            enctype="multipart/form-data"
            :with-credentials="true"
            :show-upload-list="false"
            :on-success="handleSuccess"
            :format="['jpg','jpeg','png']"
            :max-size="2048"
            :on-format-error="handleFormatError"
            :on-exceeded-size="handleMaxSize"
            type="drag"
            action="/api/upload"
            style="display: inline-block;width:58px;">
            <div style="width: 58px;height:58px;line-height: 58px;">
                <Icon type="camera" size="20"></Icon>
            </div>
        </Upload>
    </div>
</template>
<script>
import axios from 'axios'
export default {
    async created() {
       var res = await axios.get('/api/auth/myuserinfo');
       console.log(res)
       this.ImageId = res.data.user.imageid
       this.img = `/api/getImage?ImageId=` + this.ImageId
    },
    data () {
        return {
            img: '',
            ImageId: 1
        }
    },
    methods: {
        async handleSuccess (res, file) {
            // 因为上传过程为实例，这里模拟添加 url
            console.log(res)
            this.ImageId = res.output.ImageId
            var respo = await axios.post('/api/auth/resetMyImage', {
                imageid: this.ImageId
            })
            console.log(this.ImageId)
            console.log(`/api/getImage?ImageId=` + res.output.ImageId)
            this.img = `/api/getImage?ImageId=` + res.output.ImageId
            alert('Upload Success')
        },
        handleFormatError (file) {
            this.$Notice.warning({
                title: '文件格式不正确',
                desc: '文件 ' + file.name + ' 格式不正确，请上传 jpg 或 png 格式的图片。'
            });
        },
        handleMaxSize (file) {
            this.$Notice.warning({
                title: '超出文件大小限制',
                desc: '文件 ' + file.name + ' 太大，不能超过 2M。'
            });
        }
    }
}
</script>