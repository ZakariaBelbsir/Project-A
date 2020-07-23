import Vue from "vue";
import VueRouter from "vue-router";
import Home from './components/Home.vue';
import About from './components/About.vue';
import Register from './components/Register.vue';
import Login from './components/Login.vue';
import Checkout from './components/User/Checkout.vue'
import Admin from './components/Admin/Admin.vue'


Vue.use(VueRouter);

const router = new VueRouter({
    mode: "history",
    base: process.env.BASE_URL,
    routes:[
        {
            path: '/',
            name: 'Home',
            component: Home
        },
        {
            path: '/about',
            name: 'About',
            component: About
        },
        {
            path: '/register',
            name: 'Register',
            component: Register
        },
        {
            path: '/login',
            name: 'Login',
            component: Login
        },
        {
            path: '/checkout',
            name: 'Checkout',
            component: Checkout,
            meta: {requiresAuth: true}
        },
        {
            path: '/admin',
            name: 'Admin',
            component: Admin,
            meta: {requiresAuth: true}
        }
     ]
});

router.beforeEach((to, from, next) => {
    const loggedIn = localStorage.getItem('user')

    if(to.matched.some(record => record.meta.requiresAuth) && !loggedIn){
        next('/')
    }
    next()
})

export default router;
