<template>
    <header class="topbar">
        <nav class="navbar top-navbar navbar-expand-md navbar-light">
            <!-- ============================================================== -->
            <!-- Logo -->
            <!-- ============================================================== -->
            <div class="navbar-header">
                <router-link to="/dashboard" class="navbar-brand" >
                    <!-- Logo icon -->
                    <b>
                        <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                        <!-- Dark Logo icon -->
                        <!--<img src="public/assets/images/logo-icon.png" alt="homepage" class="dark-logo">-->
                        <!-- Light Logo icon -->
                        <img id="large-icon" src="public/assets/images/logokh.png" alt="homepage" class="light-logo hidden-sm-down">
                        <img id="small-icon" src="public/assets/images/logokh_small.png" alt="homepage" class="light-logo hidden-md-up">
                    </b>
                    <!--End Logo icon -->
                    <!-- Logo text -->
                    <span>
                         <!-- dark Logo text -->
                         <!--<img src="public/assets/images/logokh.png" alt="homepage" class="dark-logo">-->
                         <!-- Light Logo text -->
                         <!--<img src="public/assets/images/logo-light-text.png" class="light-logo" alt="homepage">-->
                    </span>
                </router-link>
            </div>
            <!-- ============================================================== -->
            <!-- End Logo -->
            <!-- ============================================================== -->
            <div class="navbar-collapse">
                <!-- ============================================================== -->
                <!-- toggle and nav items -->
                <!-- ============================================================== -->
                <ul class="navbar-nav mr-auto mt-md-0">
                    <!-- This is  -->
                    <li class="nav-item"> <a @click="toggle_leftbar_small" class="nav-link nav-toggler hidden-md-up text-muted waves-effect waves-dark" ><i class="mdi mdi-menu"></i></a> </li>
                    <li class="nav-item m-l-10"> <a @click="toggle_leftbar" class="nav-link sidebartoggler hidden-sm-down text-muted waves-effect waves-dark"><i class="ti-menu"></i></a> </li>

                </ul>
                <!-- ============================================================== -->
                <!-- User profile and search -->
                <!-- ============================================================== -->
                <ul class="navbar-nav my-lg-0">
                    <!-- ============================================================== -->
                    <!-- Search -->
                    <!-- ============================================================== -->
                    <li class="nav-item hidden-sm-down search-box"> <a class="nav-link hidden-sm-down text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="ti-search"></i></a>
                        <form class="app-search">
                            <input type="text" class="form-control" placeholder="Search &amp; enter"> <a class="srh-btn"><i class="ti-close"></i></a> </form>
                    </li>
                    <!-- Profile -->
                    <!-- ============================================================== -->
                    <li class="nav-item dropdown" id="lidropdown_6">
                        <a class="nav-link dropdown-toggle text-muted text-muted waves-effect waves-dark" href="" @click="dropdown('dropdown_6')"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="public/assets/images/users/1.jpg" alt="user" class="profile-pic" />
                            <!-- <div class="notify"> <span class="heartbit"></span> <span class="point"></span> </div> -->
                        </a>
                        <div class="dropdown-menu dropdown-menu-right mailbox slideInUp" id="dropdown_6">
                            <ul class="dropdown-user">
                                <li>
                                    <div class="dw-user-box">
                                        <div class="u-img"><img src="public/assets/images/users/1.jpg" alt="user"></div>
                                        <div class="u-text">
                                            <h4>{{user.username}}</h4>
                                            <p class="text-muted">{{user.email}}</p>
                                            <!--<a href="pages-profile.html" class="btn btn-rounded btn-danger btn-sm">Xem thông tin</a>-->
                                        </div>
                                    </div>
                                </li>
                                <li role="separator" class="divider"></li>
                                <li><a href="#"><i class="ti-user"></i> Thông tin tài khoản</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="" @click="logout"><i class="fa fa-power-off"></i> Đăng xuất</a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
</template>

<script>
    export default {
        name: 'top-bar',
        mounted(){
            //===== load user =====
            this.user = this.$store.state.currentUser;
        },
        updated(){
            // $(".fix-header .topbar").stick_in_parent({});
        },
        data(){
            return {
                user: []
            }
        },
        methods: {
            dropdown: function(id){
                $('#lidropdown_6').toggleClass("show");
                $('#' + id).toggleClass("show");
            },
            hidden_avatar: function () {
                $('#large-icon').toggle("hidden-icon");
                $('#small-icon').toggle("hidden-icon-small");
            },
            logout: function () {
                this.$store.commit("logout");
                this.$route.push({ path: '/'});
            },
            toggle_leftbar: function () {
                $('body').toggleClass('mini-sidebar');
                console.log("dasdsad");
            },
            toggle_leftbar_small: function () {
                $('body').toggleClass('show-sidebar');
            }
        }
    }
</script>
