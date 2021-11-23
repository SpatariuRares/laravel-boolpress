import Vue from 'vue';
import VueRouter from 'vue-router';
Vue.use(VueRouter);

import Home from './pages/Home';
import Contacts from './pages/Contacts';
import AboutUs from './pages/AboutUs';
import Posts from './pages/Posts';
import PostDetail from './pages/PostDetail';


const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home
        },
        {
            path: '/contacts',
            name: 'contacts',
            component: Contacts,
        },
        {
            path: '/about-us',
            name: 'about-us',
            component: AboutUs,
        },
        {
            path: '/posts',
            name: 'posts',
            component: Posts,
        },
        {
            path: '/post/:slug',
            name: 'post',
            component: PostDetail,
        },
    ],
});

export default router;