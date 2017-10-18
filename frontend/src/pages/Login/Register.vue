<template>
    <body class="hold-transition register-page">
        <div class="register-box">
            <div class="register-logo">
                <a href="../../index2.html"><b>Library</b>System</a>
            </div>
            <div class="register-box-body">
                <p class="login-box-msg">Register a new account</p>
                <form>
                    <div class="form-group has-feedback">
                        <input type="text" class="form-control" placeholder="Full name" v-model = "name">
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="email" class="form-control" placeholder="Email" v-model = "email">
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="password" class="form-control" placeholder="Password" v-model = "password">
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="password" class="form-control" placeholder="Retype password" v-model = "repassword">
                        <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
                    </div>
                    <div class="demo-upload-list">     
                        <img :src="img" width="10%"/>
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
                </form>
                <button type="button" class="btn btn-primary btn-lg btn-block" @click = "register()">Register</button>
                <div style="margin-top:10px">
                    <a href="#/login/authlogin" class="text-center">I already have a account</a>
                </div>
            </div>
        </div>
    </body>
</template>
<script>
import axios from 'axios'
export default {
    async created () {
        this.img = `/api/getImage?ImageId=` + this.ImageId
    },
    data(){
        return {
            name: '',
            email: '',
            password: '',
            repassword: '',
            img: '',
            ImageId: 1
        }
    },
    methods: {
        async register(){
            if(this.name&&this.email&&this.password){
                if(this.repassword == this.password){
                    var res = await axios.post('/api/auth/register', {
                        name: this.name,
                        email: this.email,
                        password: this.passwords,
                        imageid: this.ImageId
                    })
                    console.log(res);
                    if(res.data.registed == false){
                        this.$router.push({//你需要接受路由的参数再跳转
                                    path: '/login/authlogin'
                        });
                    } else {
                        this.$Message.error('Register Failed')
                    }
                } else {
                    this.$Message.error('Two Password Not Same')
                }
            } else {
                this.$Message.error('NotNull')
            }
        },
        async handleSuccess (res, file) {
            // 因为上传过程为实例，这里模拟添加 url
            console.log(res)
            this.ImageId = res.output.ImageId
            console.log(`/api/getImage?ImageId=` + res.output.ImageId)
            this.img = `/api/getImage?ImageId=` + res.output.ImageId
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
<style scoped>
    .demo-upload-list{
        display: inline-block;
        width: 60px;
        height: 60px;
        text-align: center;
        line-height: 60px;
        border: 1px solid transparent;
        border-radius: 4px;
        overflow: hidden;
        background: #fff;
        position: relative;
        box-shadow: 0 1px 1px rgba(0,0,0,.2);
        margin-right: 4px;
    }
    .demo-upload-list img{
        width: 100%;
        height: 100%;
    }
    .demo-upload-list-cover{
        display: none;
        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        background: rgba(0,0,0,.6);
    }
    .demo-upload-list:hover .demo-upload-list-cover{
        display: block;
    }
    .demo-upload-list-cover i{
        color: #fff;
        font-size: 20px;
        cursor: pointer;
        margin: 0 2px;
    }
</style>