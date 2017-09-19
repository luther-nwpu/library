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
              <img :src="logo" class="img-circle" alt="User Image">
          </div>
          <div class="pull-left info">
              <p>Alexander Pierce</p>
              <!-- Status -->
              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
          </div>
          </div>
          <!-- search form (Optional) -->
          <!-- /.search form -->

          <!-- Sidebar Menu -->
          <ul class="sidebar-menu" data-widget="tree">
            <li class="header">个人管理中心</li>
            <!-- Optionally, you can add icons to the links -->
            <li class="active"><a href="#"><i class="fa fa-link"></i> <span>我借的书</span></a></li>
            <li><a href="#"><i class="fa fa-link"></i> <span>图书管理系统</span></a></li>
          </ul>

          <ul v-if="role == 0" class="sidebar-menu" data-widget="tree">
            <li class="header">图书管理中心</li>
            <!-- Optionally, you can add icons to the links -->
            <li class="active"><a href="#"><i class="fa fa-link"></i> <span>我借的书</span></a></li>
            <li><a href="#"><i class="fa fa-link"></i> <span>图书管理系统</span></a></li>
          </ul>

          <li v-if = "role == 0" class="active"><a href="#"><i class="fa fa-link"></i> <span>我借的书</span></a></li>
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
export default {
    data() {
      return {
        logo: logo,
        role: 0,
        user: {}
      }
    },
    methods: {
      shutmenu:function() {
        $('[data-toggle="push-menu"]').pushMenu('toggle');
      }
    },
    components: {
      topbar
    }
}    
</script>