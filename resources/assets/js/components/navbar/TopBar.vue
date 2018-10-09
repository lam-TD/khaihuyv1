<template>
    <div class="">
        <header class="topbar" style="position: fixed;width: 100%">
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

        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 100%;">
                <div class="scroll-sidebar" style="overflow: hidden; width: auto; height: 100%;">
                    <!-- Sidebar navigation-->
                    <nav class="sidebar-nav active">
                        <ul id="sidebarnav">
                            <li>
                                <router-link to="/dashboard" class="waves-effect waves-dark" aria-expanded="false"><i class="mdi mdi-gauge row-nhom-cn"></i>
                                    <span class="hide-menu">Dashboard</span>
                                </router-link>
                            </li>
                            <li v-for="(list, key) in list_chuc_nang" @click="active_nhom(key)" :id="'mcn' + key" class="row-nhom-cn">
                                <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false">
                                    <i v-bind:class="list.icon"></i>
                                    <span class="hide-menu">{{list.ten_nhom}}</span>
                                </a>
                                <ul aria-expanded="false" class="ul-chuc-nang collapse" :id="'ul' + key">
                                    <li v-for="cn in list_chuc_nang[key].chuc_nang" @click="active_chuc_nang(cn.id_chuc_nang)" :id="'cn' + cn.id_chuc_nang" class="row-chuc-nang">
                                        <router-link :to="cn.link">{{cn.ten_chuc_nang}}</router-link>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                    <!-- End Sidebar navigation -->
                </div><div class="slimScrollBar" style="background: rgb(220, 220, 220); width: 5px; position: absolute; top: 30px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; left: 1px; height: 48.789px;"></div><div class="slimScrollRail" style="width: 5px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51); opacity: 0.2; z-index: 90; left: 1px;"></div></div>
            <!-- End Sidebar scroll-->
        </aside>
    </div>

</template>
<style>
    .ul-chuc-nang .active
    {
        color: #000000;
        font-weight: 500;
    }
</style>
<script>
    export default {
        name: 'top-bar',
        mounted(){
            //===== load user =====
            this.user = this.$store.state.currentUser;
        },
        updated(){
            // $('#custom').remove();
            // setTimeout(function () {
            //     let custom = document.createElement('script');
            //     custom.setAttribute('src',"public/template/js/custom.js");
            //     custom.setAttribute('id','custom');
            //     document.body.appendChild(custom);
            // },2000);
            // $(".fix-header .topbar").stick_in_parent({});
        },
        computed: {
            list_chuc_nang: function () {
                return this.$store.state.currentUser.chuc_nang;
            }
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
                this.$router.push({ path: '/'});
            },
            toggle_leftbar: function () {
                if ($("body").hasClass("mini-sidebar")) {
                    $("body").trigger("resize");
                    $(".scroll-sidebar, .slimScrollDiv").css("overflow", "hidden").parent().css("overflow", "visible");
                    $("body").removeClass("mini-sidebar");
                    $('.navbar-brand span').show();
                    $('#large-icon').attr('src','public/assets/images/logokh.png');
                }
                else {
                    $("body").trigger("resize");
                    $(".scroll-sidebar, .slimScrollDiv").css("overflow-x", "visible").parent().css("overflow", "visible");
                    $("body").addClass("mini-sidebar");
                    $('.navbar-brand span').hide();
                    $('#large-icon').attr('src','public/assets/images/logokh_small.png');
                }
            },
            toggle_leftbar_small: function () {
                $("body").toggleClass("show-sidebar");
                $(".nav-toggler i").toggleClass("mdi mdi-menu");
                $(".nav-toggler i").addClass("mdi mdi-close");
            },
            active_nhom: function (key) {
                // $('.row-nhom-cn').removeClass("active");
                // $('.ul-chuc-nang').removeClass("in");
                // $('#mcn' + key).addClass("active");
                // $('#ul' + key).addClass("in");
                if($('#mcn' + key).hasClass("active") && $('#ul' + key).hasClass("in"))
                {
                    $('#mcn' + key).removeClass("active");
                    $('#ul' + key).removeClass("in");
                }else {
                    //check element
                    $(".row-nhom-cn").removeClass("active");
                    $(".ul-chuc-nang").removeClass("in");
                    //
                    $('#mcn' + key).toggleClass("active");
                    $('#ul' + key).toggleClass("in");
                }
            },
            active_chuc_nang: function (key) {
                $(".row-chuc-nang").removeClass('active');
                $('#cn'+key).addClass('active');
                $('#cn'+key).parent().toggleClass("in");
                $('#cn'+key).parent().parent().toggleClass("active");
            }
        }
    }
    // import '../../../../../public/template/js/custom';
</script>
