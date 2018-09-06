import NProgress from "nprogress";

export function initialize(store, router) {
    router.beforeEach((to, from, next) => {
        if ((!store.state.isLoggedIn || !store.state.currentUser) && to.path != '/') {
            NProgress.start();
            NProgress.set(0.1);
            next('/')
        } else if(to.path == '/' && store.state.currentUser){
            NProgress.start();
            NProgress.set(0.1);
            next('/dashboard');
        }
        else {
            NProgress.start();
            NProgress.set(0.1);
            next();
        }
    });

    router.afterEach((to,from) => {
        setTimeout(() => NProgress.done(), 500)
    })


    // axios.interceptors.response.use(null, (error) => {
    //     if(error.response.status == 401){
    //         store.commit('logout');
    //         router.push('/');
    //     }
    // });
}