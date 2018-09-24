<template>
    <div v-if="is_logined" id="main-wrapper">
        <top-bar></top-bar>
        <!--<left-bar></left-bar>-->
        <router-view></router-view>
    </div>
    <div v-else class="" id="main-wrapper">
        <router-view></router-view>
    </div>
</template>

<script>
    import TopBar from './navbar/Topbar';
    import LeftBar from './navbar/Leftbar';
    export default {
        name: 'main-app',
        components: {LeftBar, TopBar},
        mounted() {

        },
        computed:{
            is_logined: function () {
                return this.$store.state.isLoggedIn;
            }
        },
        methods:{
            getuser() {
                console.log(localStorage.getItem("user"));
            }
        }
    }
</script>
