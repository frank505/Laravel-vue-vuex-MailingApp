import Vue from 'vue'
import Router from 'vue-router'
import Login from './pages/auth/child/Login.vue'
import Register from './pages/auth/child/Register.vue'
import Cookies from 'js-cookie'
import Home from "./pages/auth/root/Home";
import Dashboard from "./pages/dashboard/root/Dashboard";
import MailLists from "./pages/dashboard/child/MailLists";
import CreateMail from "./pages/dashboard/child/CreateMail";
import ViewMail from "./pages/dashboard/child/ViewMail";


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
            redirect: '/dashboard/mail-lists',
            component:Dashboard,
            children: [
                {
                    path:'mail-lists',
                    component: MailLists
                },
                {
                    path:'create-mail',
                    component: CreateMail
                },
                {
                    path:'view-mail/:uuid',
                    component: ViewMail
                }
            ]
        }
    ]
});

router.beforeEach((to, from, next) => {

    let cookies = Cookies.get("user-auth");

    if (to.fullPath === '/dashboard')
    {
        if(cookies=='' || cookies == null)
        {
            next('/login');
        }
    }

    if (to.fullPath === '/login') {
        if(cookies!='' && cookies!=null)
        {
            next('/dashboard');
        }
    }

    next();
});


export default router;