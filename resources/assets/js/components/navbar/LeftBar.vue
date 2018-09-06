<template>
    <aside class="left-sidebar">
        <!-- Sidebar scroll-->
        <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 100%;">
            <div class="scroll-sidebar" style="overflow: hidden; width: auto; height: 100%;">
            <!-- Sidebar navigation-->
            <nav class="sidebar-nav active">
                <ul id="sidebarnav">
                    <li>
                        <router-link to="/dashboard" class="waves-effect waves-dark" aria-expanded="false"><i class="mdi mdi-gauge"></i>
                            <span class="hide-menu">Dashboard</span>
                        </router-link>
                    </li>
                    <li v-for="(list, key) in list_chuc_nang">
                        <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false">
                            <i v-bind:class="list.icon"></i>
                            <span class="hide-menu">{{list.ten_nhom}}</span>
                        </a>
                        <ul aria-expanded="false" class="collapse">
                            <li v-for="cn in list_chuc_nang[key].chuc_nang">
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
</template>

<script >
    export default {
        name: 'left-bar',
        mounted() {
            // $(".fix-header .topbar").stick_in_parent({});
            this.get_chuc_nang();
        },
        data () {
            return {
                list_chuc_nang: [],
                activeName: '1'
            }
        },
        methods: {
            get_chuc_nang: function() {
                var cur_user = JSON.parse(localStorage.getItem("user"));
                axios({
                    method: 'POST',
                    url: 'api/chuc-nang',
                    headers: {'Authorization':'Bearer ' + this.$store.state.currentUser.token},
                    data:{ user_id: cur_user.id, id_nhom_nguoi_dung: cur_user.id_nhom_nguoi_dung}
                })
                    .then((response) => {
                        this.list_chuc_nang = response.data;
                        setTimeout(function () {
                            let custom = document.createElement('script');
                            custom.setAttribute('src',"public/template/js/custom.js");
                            custom.setAttribute('id','custom');
                            document.body.appendChild(custom);
                        },2000);

                    })
                    .catch((error) => {
                        this.list_chuc_nang = [];
                        console.log(error);
                    })
            },
            updated () {
                $('#custom').remove();
                setTimeout(function () {
                    let custom = document.createElement('script');
                    custom.setAttribute('src',"public/template/js/custom.js");
                    custom.setAttribute('id','custom');
                    document.body.appendChild(custom);
                },2000);
            },
            beforeDestroy() {

            }
        }
    }
</script>