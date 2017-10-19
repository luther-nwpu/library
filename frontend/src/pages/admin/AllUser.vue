<template>
    <div>

        <div class="box">
            <div class="box-header">
              <h3 class="box-title">AllUser</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row" style ="margin-left: 5px; margin-right: 5px">              
                <table class="table table-striped table-bordered" id="mytable">
                  <thead>
                    <tr>
                    <th class="numeric"> UserEmail </th>
                    <th class="numeric"> UserName </th>
                    <th class="numeric"> UserNumber </th>
                    <th class="numeric"> UserUniversity </th>
                <th class="numeric"> UserCollege </th>
                    <th class="numeric"> Operation </th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(user, index) in users" :key="index">
                      <!-- <td> {{info[0].id}} </td> -->
                      <td> {{user.email}} </td>
                      <td> {{user.username}} </td>
                      <td> {{user.usernumber}}</td>
                      <td> {{user.useruniversity}} </td>
                      <td> {{user.usercollege}} </td>
                      <td> <button @click = "deleteUser(index, user.id)"> 删除用户 </button> <button @click = "resetUserPassword(user.id)"> 重置用户密码</button> </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
          <!-- /.box -->
              <table>
        </table>
    </div>
</template>
<script>
import axios from 'axios'
import '@/assets/js/jquery.dataTables.min'
    export default {
        async created() {
            var res = await axios.get('/api/auth/getAllUser')
            console.log(res)
            this.users = res.data
            this.$nextTick(function() {
                $('#mytable').dataTable();
            })
        },
        data () {
            return {
                users: []
            }
        },
        methods: {
            async deleteUser(index, userid) {
                var res = await axios.post('/api/auth/deleteUser',{
                    id: userid
                });
                if(res.data.delete) {
                    alert('delete True')
                    this.users.splice(index, 1);
                } else {
                    alert('delete False')
                }
                console.log(res)
            },
            async resetUserPassword(userid) {
                var res = await axios.post('/api/auth/resetPassword', {
                    id: userid
                })
                console.log(res)
                if(res.data.reset) {
                    alert('reset True The Password Is 123qwe')
                } else {
                    alert('reset False')
                }
            }
        }
    }
</script>
