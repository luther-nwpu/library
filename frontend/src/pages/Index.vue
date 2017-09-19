<template>  
  <div>
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">AllBook</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">              
            <table class="table table-striped table-bordered" id="mytable">
              <thead>
                <tr>
                  <th class="numeric"> BookId </th>
                  <th class="numeric"> BookName </th>
                  <th class="numeric"> Description </th>
                  <th class="numeric"> BookCode </th>
                  <th class="numeric"> ISBN </th>
                  <th class="numeric"> BookLocation </th>
                  <th class="numeric"> BookInfo </th>
                  <th class="numeric"> Operation </th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(info,index) in trainerInfoTables" :key="index">
                  <td> {{info.engName}} </td>
                  <td> {{info.chnName}} </td>
                  <td> {{info.universityName}} </td>
                  <td> {{info.emailAddress}} </td>
                  <td> {{info}} </td>
                  <td> {{info.phoneNumber}} </td>
                  <td>
                    <router-link :to="{ name: 'coachInfo', params: { id: info.id }}"><button class="btn btn-xs green"> 个人信息 </button></router-link>
                    <router-link :to="{ name: 'team', params: { id: info.id }}"> <button class="btn btn-xs blue"> 我的队伍 </button> </router-link>
                  </td>
                </tr>
              </tbody>
            </table>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
  </div>
</template>
<script>
import axios from 'axios'
import '@/assets/js/jquery.dataTables.min'
export default {
  data(){
    return {
       trainerInfoTables: []
    }
  },
  async mounted() {
      var res = await axios.get('/api/book/getall');
      console.log(res);
      $(document).ready(function() {
        $('#mytable').dataTable();
      } );
      this.$nextTick(function() {
      })
    }
  }
</script>
<style scoped>
</style>