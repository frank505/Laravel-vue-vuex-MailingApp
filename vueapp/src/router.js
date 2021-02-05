import Vue from 'vue'
import Router from 'vue-router'
import Login from './pages/auth/child/Login.vue'
import Register from './pages/auth/child/Register.vue'
// import Cookies from 'js-cookie'
import Home from "./pages/auth/root/Home";
import Dashboard from "./pages/dashboard/root/Dashboard";

Vue.use(Router)

const router =  new Router({
    mode: 'history',
    base: process.env.BASE_URL,
    routes: [
        {
            path: '/',
            redirect: '/login',
            component: Home,
            children: [
                {
                    path: 'login',
                    component: Login,
                },
                {
                    path: 'register',
                    component: Register,
                }
            ],
        },
        {
            path:'/dashboard',
            component:Dashboard,
        }
    ]
});

// router.beforeEach((to, from, next) => {
//
//     let cookies = Cookies.get("user-auth");
//
//     if (to.fullPath === '/dashboard')
//     {
//         if(cookies=='' || cookies == null)
//         {
//             next('/login');
//         }
//     }
//
//     if (to.fullPath === '/login') {
//         if(cookies!='' && cookies!=null)
//         {
//             next('/dashboard');
//         }
//     }
//
//     next();
// });


export default router;