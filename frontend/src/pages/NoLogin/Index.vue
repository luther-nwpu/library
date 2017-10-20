<template>
    <div>
    <br>
     <button class = "btn btn-primary" style ="float: right; margin-right: 10px"  @click ="linktowebsite()"> Switch To website</button>
        <h1>Lirary Managerment System </h1>
        <br>
          <!-- Info Boxes Style 2 -->
          <div class="info-box bg-yellow" @click = "linkmybook()">
            <span class="info-box-icon"><i class="ion ion-ios-pricetag-outline"></i></span>
            <div class="info-box-content">
                <div style="font-size: 50px">My Book</div>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
          <div class="info-box bg-green" @click = "linkborrowbook()">
            <span class="info-box-icon"><i class="ion ion-ios-heart-outline"></i></span>

            <div class="info-box-content">
                <div style="font-size: 50px">Borrow Book</div>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
          <div class="info-box bg-red" @click = "linkreturnbook()">
            <span class="info-box-icon"><i class="ion ion-ios-cloud-download-outline"></i></span>

            <div class="info-box-content">
              <div style="font-size: 50px">Return Book</div>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
          <div class="info-box bg-aqua" @click = "linkrenewbook()">
            <span class="info-box-icon"><i class="ion-ios-chatbubble-outline"></i></span>
            <div class="info-box-content">
                <div style="font-size: 50px">Renew Book</div>
            </div>
            <!-- /.info-box-content -->
          </div>

    </div>
</template>
<script>
export default {
    data () {
        return {
        }
    },
    methods: {
        linkborrowbook() {
            this.$router.push({//你需要接受路由的参数再跳转
                path: '/library/borrowbook'
            });
        },
        linkmybook() {
            this.$router.push({//你需要接受路由的参数再跳转
                path: '/library/mybook'
            });
        },
        linkreturnbook() {
            this.$router.push({//你需要接受路由的参数再跳转
                path: '/library/returnbook'
            });
        },
        linkrenewbook() {
            this.$router.push({//你需要接受路由的参数再跳转
                path: '/library/renewbook'
            });
        },
        linktowebsite() {
            this.$router.push({//你需要接受路由的参数再跳转
                path: '/index'
            });
        }
    }
}
</script>
<style>
</style>