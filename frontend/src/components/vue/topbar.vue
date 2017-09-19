<template>
    <div>
        <header class="main-header">
        <!-- Logo -->
        <a href="index2.html" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>L</b>Ma</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>Lirary</b>Management</span>
        </a>
        <!-- Header Navbar -->
        <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="push-menu"  role="button">
            <span class="sr-only" @click ="shutmenu()">Toggle navigation</span>
            </a>
            <div class ="col-md-3">
            <div class="input-group" style ="margin-top: 10px">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                    </button>
                </span>
            </div>
            </div>
            <!-- Navbar Right Menu -->
            <div class="navbar-custom-menu">
                <div v-if="logined">
                    <ul class="nav navbar-nav">
                        <li><a href = "#">
                            <div class="pull-left">
                            Center
                            </div>
                            </a>
                        </li>
                        <!-- User Account Menu -->
                        <li class="dropdown user user-menu">
                        <!-- Menu Toggle Button -->
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <!-- The user image in the navbar-->
                            <img src="https://almsaeedstudio.com/themes/AdminLTE/dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
                            <!-- hidden-xs hides the username on small devices so only the image appears. -->
                            <span class="hidden-xs">Alexander Pierce</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="user-header">
                                <img :src="logo" class="img-circle" alt="User Image">
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                            <div class="pull-left">
                                <a href="#" class="btn btn-default btn-flat">Profile</a>
                            </div>
                            <div class="pull-right">
                                <a href="#" class="btn btn-default btn-flat">Sign out</a>
                            </div>
                            </li>
                        </ul>
                        </li>
                    </ul>
                </div>
                <div v-else>
                    <ul class="nav navbar-nav">
                        <li class="dropdown user user-menu">
                            <a href = "#/login/authlogin" >
                                <!-- Menu Toggle Button -->
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <!-- The user image in the navbar-->
                                    <!-- hidden-xs hides the username on small devices so only the image appears. -->
                                    <span class="hidden-xs" style ="color: white">Admin</span>
                                </a>
                            </a>
                        </li>
                        <!-- User Account Menu -->
                        <li class="dropdown user user-menu">
                            <a href = "#/login/authregister" >
                                <!-- Menu Toggle Button -->
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <!-- The user image in the navbar-->
                                    <!-- hidden-xs hides the username on small devices so only the image appears. -->
                                    <span class="hidden-xs" style ="color: white">register</span>
                                </a>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        </header>
    </div> 
</template>
<script>
import axios from 'axios'
export default{
    async created() {

    },
    data() {
        return {
            logined: false,
            logo: '@/assets/img/user2-160x160.jpg'
        }
    }
}
</script>
<style>
</style>