<template>
<div>
  <div class="skin-blue">
    <!-- Main Header -->
    <topbar></topbar>
    <aside class="main-sidebar">
      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">
          <!-- Sidebar user panel (optional) -->
          <div class="user-panel">
          <div class="pull-left image">
            <div v-if="user.imageid == 0">
              <img :src="logo" width="60px" height ="60px" class="img-circle" alt="User Image">
            </div>
            <div v-else>
              <img :src="ImageUrl" width="60px" height ="60px" class="img-circle" alt="User Image">
            </div>
          </div>
          <div class="pull-left info">
              <p>name:{{user.name}}</p>
              <p>useruniversity:{{user.useruniversity}}</p>
              <!-- Status -->
          </div>
          </div>
          <!-- search form (Optional) -->
          <!-- /.search form -->

          <!-- Sidebar Menu -->
          <ul class="sidebar-menu" data-widget="tree">
            <li class="header">DashBoard</li>
            <!-- Optionally, you can add icons to the links -->
            <li><a href="#/common/allbook"><i class="fa fa-link"></i> <span>AllBook</span></a></li>
          </ul>
          <ul v-if="user.role == 1 || user.role == 2" class="sidebar-menu" data-widget="tree">
            <li class="header">Profile</li>
            <!-- Optionally, you can add icons to the links -->
            <li><a href="#/authmanager/myborrowbook"><i class="fa fa-link"></i> <span>My Borrowed Book</span></a></li>
            <li><a href="#/authmanager/MyHistory"><i class="fa fa-link"></i> <span>My History</span></a></li>            
          </ul>
          <ul v-if="user.role == 2" class="sidebar-menu" data-widget="tree">
            <li class="header">BookManageMent</li>
            <!-- Optionally, you can add icons to the links -->
            <li><a href="#/admin/borrowbook"><i class="fa fa-link"></i> <span>Borrow Book</span></a></li>
            <li><a href="#/admin/returnbook"><i class="fa fa-link"></i> <span>Return Book</span></a></li>
            <li><a href="#/admin/category"><i class="fa fa-link"></i> <span>CategoryManage</span></a></li>
            <li><a href="#/admin/bookstore"><i class="fa fa-link"></i> <span>BookManage</span></a></li>
          </ul>
          <ul v-if="user.role == 3" class="sidebar-menu" data-widget="tree">
            <li class="header">ManagerManagement</li>
            <!-- Optionally, you can add icons to the links -->
            <li><a href="#/admin/alluser"><i class="fa fa-link"></i> <span>AllUser</span></a></li>
            <li><a href="#/admin/manager"><i class="fa fa-link"></i> <span>LibraryManager</span></a></li>
          </ul>
        <!-- /.sidebar-menu -->
      </section>
      <!-- /.sidebar -->
    </aside>
    <div class="content-wrapper">
        <router-view></router-view>
    </div>
  </div>
</div>

</template>
<script>
import '@/assets/js/adminlte.min.js'
import logo from '@/assets/img/user2-160x160.jpg'
import topbar from '@/components/vue/topbar.vue'
import axios from 'axios'
export default {
    data() {
      return {
        logo: logo,
        role: 0,
        user: '',
        ImageUrl: ''
      }
    },
    methods: {
      shutmenu:function() {
        $('[data-toggle="push-menu"]').pushMenu('toggle');
      }
    },
    async created () {
        console.log('当前图片编号')
        var res = await axios.get('/api/auth/admininfo');
        console.log(res.data);
        this.user = res.data
        this.ImageUrl = `/api/getImage?ImageId=` + this.user.imageid
    },
    components: {
      topbar
    }
}    
</script>